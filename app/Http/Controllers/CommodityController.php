<?php

namespace App\Http\Controllers;

use App\Commodity;
use App\CommodityLocation;
use App\CommodityCondition;
use App\Exports\CommoditiesExport;
use App\Http\Requests\CommodityExportRequest;
use App\Http\Requests\CommodityImportRequest;
use App\Http\Requests\StoreCommodityRequest;
use App\Http\Requests\UpdateCommodityRequest;
use App\Imports\CommoditiesImport;
use App\Repositories\CommodityRepository;
use App\ActivityLog;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CommodityController extends Controller
{
    public function __construct(
        private CommodityRepository $commodityRepository,
    ) {
        $this->authorizeResource(Commodity::class, 'commodity');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Commodity::query()->with('commodity_location');
       $query->when(request()->filled('commodity_condition_id'), function ($q) {
    return $q->where('commodity_condition_id', request('commodity_condition_id'));
});

        $query->when(request()->filled('commodity_location_id'), function ($q) {
            return $q->where('commodity_location_id', request('commodity_location_id'));
        });

       

        $query->when(request()->filled('year_of_purchase'), function ($q) {
            return $q->where('year_of_purchase', request('year_of_purchase'));
        });

        

        $commodities = $query->latest()->get();
        $year_of_purchases = Commodity::pluck('year_of_purchase')->unique()->sort();
        $commodity_locations = CommodityLocation::orderBy('name', 'ASC')->get();
        $commodity_conditions = CommodityCondition::orderBy('name', 'ASC')->get();

        $commodity_condition_count = $this->commodityRepository->countCommodityCondition()->map(function ($commodity) {
            return collect([
                'condition_name' => $commodity->getConditionName(),
                'count' => $commodity->count,
            ]);
        });

        $commodity_counts = [
            'commodity_in_total' => $commodity_condition_count->sum('count') ?? 0,
            'commodity_in_good_condition' => $commodity_condition_count->firstWhere('condition_name', 'Baik')['count'] ?? 0,
            'commodity_in_not_good_condition' => $commodity_condition_count->firstWhere('condition_name', 'Kurang Baik')['count'] ?? 0,
            'commodity_in_repair' => $commodity_condition_count->firstWhere('condition_name', 'Dalam Perbaikan')['count'] ?? 0,
            'commodity_in_heavily_damage_condition' => $commodity_condition_count->firstWhere('condition_name', 'Rusak Berat')['count'] ?? 0,
        ];

        $lastCommodity = Commodity::latest()->first();

if ($lastCommodity) {
    $lastNumber = (int) substr($lastCommodity->item_code, 3);
    $nextNumber = $lastNumber + 1;
} else {
    $nextNumber = 1;
}

$item_code = 'BRG' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        return view(
            'commodities.index',
            compact(
                'commodities',
                'commodity_locations',
                'commodity_conditions',
                'year_of_purchases',
                'commodity_counts',
                'item_code'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
 public function store(StoreCommodityRequest $request)
{
    $commodity = Commodity::create($request->validated());

    // Load relasi lokasi
    $commodity->load('commodity_location');

    ActivityLog::create([
        'commodity_id' => $commodity->id,
        'activity' => 'Tambah Barang',
        'description' =>
            "Nama Barang : {$commodity->name}\n" .
            "Kode Barang : {$commodity->item_code}\n" .
            "Lokasi : {$commodity->commodity_location->name}\n" .
            "Kondisi : {$commodity->getConditionName()}\n" .
            "Kuantitas : {$commodity->quantity}",
        'user_name' => auth()->user()->name,
    ]);

    return to_route('barang.index')->with('success', 'Data berhasil ditambahkan!');
}
/**
 * Show edit page.
 */
public function edit(Commodity $commodity)
{
    $commodity_locations = CommodityLocation::orderBy('name')->get();
    $commodity_conditions = CommodityCondition::orderBy('name')->get();

    return view(
        'commodities.edit',
        compact(
            'commodity',
            'commodity_locations',
            'commodity_conditions'
        )
    );
}
    /**
     * Update the specified resource in storage.
     */
  public function update(UpdateCommodityRequest $request, Commodity $commodity)
{
   // Simpan data lama
$oldCommodity = $commodity->replicate();

// Update data
$commodity->update($request->validated());



    $changes = [];

if ($oldCommodity->name != $commodity->name) {
    $changes[] =
        'Nama Barang: ' .
        $oldCommodity->name .
        ' → ' .
        $commodity->name;
}

if ($oldCommodity->commodity_location_id != $commodity->commodity_location_id) {

    $oldLocation = CommodityLocation::find($oldCommodity->commodity_location_id);
    $newLocation = CommodityLocation::find($commodity->commodity_location_id);

    $changes[] =
        'Lokasi: ' .
        ($oldLocation->name ?? '-') .
        ' → ' .
        ($newLocation->name ?? '-');
}

if ($oldCommodity->commodity_condition_id != $commodity->commodity_condition_id) {

    $oldCommodity->load('commodityCondition');
    $commodity->load('commodityCondition');

    $changes[] =
        'Kondisi: ' .
        $oldCommodity->getConditionName() .
        ' → ' .
        $commodity->getConditionName();
}

if ($oldCommodity->year_of_purchase != $commodity->year_of_purchase) {

    $changes[] =
        'Tahun: ' .
        $oldCommodity->year_of_purchase .
        ' → ' .
        $commodity->year_of_purchase;
}

if ($oldCommodity->quantity != $commodity->quantity) {

    $changes[] =
        'Kuantitas: ' .
        $oldCommodity->quantity .
        ' → ' .
        $commodity->quantity;
}

if ($oldCommodity->price != $commodity->price) {

    $changes[] =
        'Harga: Rp ' .
        number_format($oldCommodity->price, 0, ',', '.') .
        ' → Rp ' .
        number_format($commodity->price, 0, ',', '.');
}

if ($oldCommodity->price_per_item != $commodity->price_per_item) {

    $changes[] =
        'Harga Satuan: Rp ' .
        number_format($oldCommodity->price_per_item, 0, ',', '.') .
        ' → Rp ' .
        number_format($commodity->price_per_item, 0, ',', '.');
}
if ($oldCommodity->note != $commodity->note) {

    $changes[] =
        'Keterangan: ' .
        ($oldCommodity->note ?: '-') .
        ' → ' .
        ($commodity->note ?: '-');
}

    ActivityLog::create([
    'commodity_id' => $commodity->id,
    'activity' => 'Update Barang',
    'description' => $commodity->name . "\n" . implode("\n", $changes),
    'user_name' => auth()->user()->name,
]);

    return to_route('barang.index')->with('success', 'Data berhasil diubah!');
}
    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Commodity $commodity)
{
    ActivityLog::create([
        'commodity_id' => $commodity->id,
        'activity' => 'Hapus Barang',
        'description' => 'Menghapus barang "' . $commodity->name . '"',
        'user_name' => auth()->user()->name,
    ]);

    $commodity->delete();

    return to_route('barang.index')->with('success', 'Data berhasil dihapus!');
}
    /**
     * Generate PDF for all commodities.
     */
    public function generatePDF()
    {
        $this->authorize('print barang');

        $commodities = Commodity::all();
        $sekolah = env('NAMA_SEKOLAH', 'Barang Milik Sekolah');
        $pdf = Pdf::loadView('commodities.pdf', compact(['commodities', 'sekolah']))->setPaper('a4');

        return $pdf->download('print.pdf');
    }

    /**
     * Generate PDF for a specific commodity.
     */
    public function generatePDFIndividually($id)
    {
        $this->authorize('print individual barang');

        $commodity = Commodity::find($id);
        $sekolah = env('NAMA_SEKOLAH', 'Barang Milik Sekolah');
        $pdf = Pdf::loadView('commodities.pdfone', compact(['commodity', 'sekolah']))->setPaper('a4');

        return $pdf->download('print.pdf');
    }
public function scan($id)
{
    $commodity = Commodity::find($id);

    if (!$commodity) {
        return view('commodities.not-found');
    }

    return view('commodities.scan', compact('commodity'));
}

public function downloadQR(Commodity $commodity)
{
    $qr = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('svg')
        ->size(500)
        ->generate(route('barang.scan', $commodity->id));

    return response($qr)
        ->header('Content-Type', 'image/svg+xml')
        ->header(
            'Content-Disposition',
            'attachment; filename="QR-'.$commodity->item_code.'.svg"'
        );
}
public function labelQR($id)
{
    $commodity = Commodity::findOrFail($id);

    $qr = base64_encode(
        \SimpleSoftwareIO\QrCode\Facades\QrCode::format('png')
            ->size(250)
            ->generate(route('barang.scan', $commodity->id))
    );

    $pdf = Pdf::loadView(
    'commodities.qr-label',
    compact('commodity','qr')
)->setPaper([0,0,250,480]);

    return $pdf->download('Label-'.$commodity->item_code.'.pdf');
}
}