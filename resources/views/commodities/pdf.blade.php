<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2,
        .header h3,
        .header p {
            margin: 0;
        }

        .tanggal {
            text-align: right;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th {
            background-color: #f2f2f2;
        }

        th,
        td {
            padding: 6px;
            text-align: center;
        }
    </style>
</head>

<body>

<div class="header">
    <h2>SMAN 1 TANJUNGSIANG</h2>
    <h3>LAPORAN DATA INVENTARIS BARANG</h3>
    <p>{{ $sekolah }}</p>
</div>

<hr>

<div class="tanggal">
    Tanggal Cetak: {{ date('d-m-Y') }}
</div>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Nama Barang</th>
            <th>Ruangan</th>
            <th>Tahun</th>
            <th>Kondisi</th>
        </tr>
    </thead>

    <tbody>
        @foreach($commodities as $commodity)
        <tr>
            <td>{{ $loop->iteration }}</td>

            <td>
                {{ $commodity->item_code }}
            </td>

            <td>
                {{ $commodity->name }}
            </td>

            <td>
    {{ optional($commodity->commodity_location)->name ?? '-' }}
</td>



            <td>
                {{ $commodity->year_of_purchase }}
            </td>

            

            <td>
    {{ $commodity->getConditionName() }}
</td>
        </tr>
        @endforeach
    </tbody>

</table>

<br><br>

<div style="width:250px;float:right;text-align:center;">
    <p>Tanjungsiang, {{ date('d-m-Y') }}</p>

    <br><br><br>

    <p>_____________________</p>
    <p>Petugas Inventaris</p>
</div>

</body>
</html>