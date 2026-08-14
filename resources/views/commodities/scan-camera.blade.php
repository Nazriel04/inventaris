<x-layout>

    <x-slot name="title">Scan QR Code</x-slot>

    <x-slot name="page_heading">Scan QR Code Barang</x-slot>

    <div class="card">

        <div class="card-body text-center">

            <h4 class="mb-3">
                Scan QR Code Barang
            </h4>

            <p class="text-muted">
                Arahkan QR Code ke kamera laptop untuk melihat informasi barang.
            </p>

            <div id="reader" style="width:500px; margin:auto;"></div>

        </div>

    </div>
    <style>
#reader video{
    transform: scaleX(-1) !important;
}
</style>
@push('js')

<script src="https://unpkg.com/html5-qrcode"></script>

<script>

function onScanSuccess(decodedText){

    html5QrCode.stop().then(() => {

        setTimeout(function(){

            window.location.href = decodedText;

        },300);

    });

}

function onScanFailure(error){}

const html5QrCode = new Html5Qrcode("reader");

Html5Qrcode.getCameras().then(devices => {

    if(devices.length){

        html5QrCode.start(
            devices[0].id,
            {
                fps:10,
                qrbox:250
            },
            onScanSuccess,
            onScanFailure
        );

    }

});

</script>

@endpush
</x-layout>