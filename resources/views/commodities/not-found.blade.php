<x-layout>

    <x-slot name="title">Barang Tidak Ditemukan</x-slot>

    <x-slot name="page_heading">Hasil Scan QR Code</x-slot>

    <div class="card">

        <div class="card-body text-center py-5">

            <i class="fas fa-exclamation-triangle fa-5x text-warning mb-4"></i>

            <h2 class="font-weight-bold">
                Barang Tidak Ditemukan
            </h2>

            <p class="text-muted mt-3">
                QR Code berhasil dipindai, namun data barang sudah dihapus
                atau tidak tersedia.
            </p>

             <a href="{{ route('barang.scan-camera') }}"
       class="btn btn-primary btn-lg mr-2">

        <i class="fas fa-qrcode"></i>
        Scan Lagi

    </a>

             <a href="{{ route('barang.index') }}"
       class="btn btn-success btn-lg">

        <i class="fas fa-box-open"></i>
        Data Barang

    </a>

        </div>

    </div>

</x-layout>