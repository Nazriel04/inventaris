<?php

namespace App\Http\Controllers;

use App\Repositories\CommodityConditionRepository;
use Illuminate\Http\Request;
use App\CommodityCondition;

class CommodityConditionController extends Controller
{
    public function __construct(
        public CommodityConditionRepository $commodityConditionRepository
    ) {
        $this->middleware('auth');
    }

    public function index()
    {
        $commodity_conditions = $this->commodityConditionRepository->getAll();

        return view('commodity_conditions.index', compact('commodity_conditions'));
    }

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|unique:commodity_conditions,name',
        'badge_color' => 'required|string|max:20',
    ]);

    CommodityCondition::create([
        'name' => $request->name,
        'badge_color' => $request->badge_color,
    ]);

    return redirect()
        ->route('kondisi.index')
        ->with('success', 'Data kondisi berhasil ditambahkan.');
}
public function update(Request $request, CommodityCondition $commodityCondition)
{
    $request->validate([
        'name' => 'required|unique:commodity_conditions,name,' . $commodityCondition->id,
        'badge_color' => 'required|string|max:20',
    ]);

    $commodityCondition->update([
        'name' => $request->name,
        'badge_color' => $request->badge_color,
    ]);

    return redirect()
        ->route('kondisi.index')
        ->with('success', 'Data kondisi berhasil diubah.');
}

public function destroy(CommodityCondition $commodityCondition)
{
    $commodityCondition->delete();

    return redirect()
        ->route('kondisi.index')
        ->with('success', 'Data kondisi berhasil dihapus.');
}
}
