<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">

<style>

body{
    font-family: DejaVu Sans, sans-serif;
    margin:0;
    padding:8px;
}

.label{
    width:100%;
    border:2px solid #222;
    border-radius:10px;
    padding:8px;
    box-sizing:border-box;
}

.header{
    text-align:center;
    border-bottom:2px solid #222;
    padding-bottom:8px;
    margin-bottom:10px;
}

.header h2{
    margin:0;
    font-size:18px;
}

.header h4{
    margin:2px 0;
    font-size:13px;
}

.header p{
    margin:0;
    font-size:10px;
}

.qr{
    text-align:center;
    margin:12px 0;
}

.info{
    border-top:1px solid #999;
    padding-top:10px;
}

.info table{
    width:100%;
    border-collapse:collapse;
}

.info td{
    padding:4px 0;
    font-size:11px;
}

.footer{

    margin-top:10px;
    border-top:1px solid #999;
    text-align:center;
    padding-top:8px;
    font-size:10px;
    color:#555;

}

</style>

</head>

<body>

<div class="label">

    <div class="header">

    <img src="{{ public_path('assets/img/unsplash/logo-sman.png') }}"
         width="55"
         style="margin-bottom:6px;">

    <h2>SIMASET</h2>

    <h4>SMAN 1 TANJUNGSIANG</h4>

   

</div>

    <div class="qr">

        <img src="data:image/png;base64,{{ $qr }}" width="150">

    </div>
<div style="text-align:center;margin-top:8px;">

    <div style="
        font-size:18px;
        font-weight:bold;
        letter-spacing:1px;
    ">
        {{ $commodity->item_code }}
    </div>

</div>
    <div class="info">

        <table>
            <tr>
    <td><strong>Nama</strong></td>
    <td>{{ strtoupper($commodity->name) }}</td>
</tr>

<tr>
    <td><strong>Ruangan</strong></td>
    <td>{{ $commodity->commodity_location->name }}</td>
</tr>

<tr>
    <td><strong>Kondisi</strong></td>
    <td>

<span style="
background:
@switch($commodity->commodityCondition->badge_color)
    @case('success') #28a745; @break
    @case('warning') #ffc107; @break
    @case('danger') #dc3545; @break
    @case('info') #17a2b8; @break
    @case('primary') #007bff; @break
    @case('dark') #343a40; @break
    @default #6c757d;
@endswitch

color:white;
padding:4px 10px;
border-radius:5px;
font-weight:bold;
">

{{ $commodity->commodityCondition->name }}

</span>

    </td>
</tr>

        </table>

    </div>

    <div class="footer">

    <strong>Label Inventaris Aset</strong><br>

    Scan QR Code untuk melihat informasi lengkap barang.

</div>

</div>

</body>

</html>