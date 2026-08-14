<x-layout>
    <x-slot name="title">Detail Barang</x-slot>
    <x-slot name="page_heading">Hasil Scan QR Code</x-slot>

    <div class="card">
        <div class="card-body">

    

   <div class="text-center mb-4">

    <h4 class="font-weight-bold mb-3">
        QR Code Barang
    </h4>

    <div class="d-inline-block p-3 border rounded shadow-sm bg-white">
        {!! QrCode::size(220)->generate(route('barang.scan', $commodity->id)) !!}
    </div>
<hr class="my-4">
    <h5 class="mt-3 mb-1 font-weight-bold">
        {{ $commodity->item_code }}
    </h5>

    <p class="text-muted mb-0">
        {{ $commodity->name }}
    </p>

    <small class="text-secondary">
        Scan QR Code untuk melihat informasi lengkap barang.
    </small>
    <hr>

<div class="alert alert-info text-left mt-3 mb-4">
    <i class="fas fa-info-circle"></i>
    Scan QR Code untuk melihat informasi aset sekolah secara cepat.
</div>

</div>
<div class="mt-3">

    

</div>
<hr class="my-4">
    <table class="table table-bordered">
<h5 class="mb-3">
    Informasi Barang
</h5>
            <table class="table table-bordered">
                <tr>
                    <th width="30%">Kode Barang</th>
                    <td>{{ $commodity->item_code }}</td>
                </tr>

                <tr>
                    <th>Nama Barang</th>
                    <td>{{ $commodity->name }}</td>
                </tr>

                <tr>
                    <th>Ruangan</th>
                    <td>{{ $commodity->commodity_location->name }}</td>
                </tr>

               

                <tr>
                    <th>Tahun Pembelian</th>
                    <td>{{ $commodity->year_of_purchase }}</td>
                </tr>

                

                <tr>
    <th>Kondisi</th>
    <td>

        @switch($commodity->getConditionName())

    @case('Baik')
        <span class="badge badge-success px-3 py-2">
            <i class="fas fa-check-circle mr-1"></i>
            Baik
        </span>
        @break

    @case('Kurang Baik')
        <span class="badge badge-warning px-3 py-2">
            <i class="fas fa-exclamation-circle mr-1"></i>
            Kurang Baik
        </span>
        @break

    @case('Dalam Perbaikan')
        <span class="badge badge-info px-3 py-2">
            <i class="fas fa-tools mr-1"></i>
            Dalam Perbaikan
        </span>
        @break

    @case('Rusak Berat')
        <span class="badge badge-danger px-3 py-2">
            <i class="fas fa-times-circle mr-1"></i>
            Rusak Berat
        </span>
        @break

    @default
        <span class="badge badge-secondary px-3 py-2">
            Tidak Diketahui
        </span>

@endswitch

    </td>
</tr>

            </table>

        </div>
        <hr>

<div class="d-flex justify-content-between align-items-center">

    <small class="text-muted">
        Scan QR Code berhasil.
    </small>

    <a href="{{ route('barang.index') }}" class="btn btn-primary">
        <i class="fas fa-arrow-left mr-1"></i>
        Kembali ke Data Barang
    </a>

</div>
<hr>

<h5 class="mb-3 text-center">
    <i class="fas fa-tools"></i>
    Aksi Admin
</h5>

<div class="text-center">

   <a href="{{ route('barang.edit', $commodity) }}"
   class="btn btn-success m-1">
    <i class="fas fa-edit"></i>
    Edit Barang
</a>

    <form action="{{ route('barang.print-individual',$commodity->id) }}"
          method="POST"
          class="d-inline">

        @csrf

        <button class="btn btn-primary m-1">
            <i class="fas fa-print"></i>
            Cetak Detail
        </button>

    </form>

    <form action="{{ route('barang.destroy',$commodity) }}"
          method="POST"
          class="d-inline">

        @csrf
        @method('DELETE')

        <button class="btn btn-danger m-1"
                onclick="return confirm('Yakin ingin menghapus barang ini?')">

            <i class="fas fa-trash"></i>
            Hapus

        </button>

    </form>

    <br><br>

    

</div>
    </div>
</x-layout>