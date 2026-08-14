<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td, th {
            border: 1px solid black;
            padding: 8px;
        }

        h2, h4 {
            text-align: center;
            margin: 0;
        }
    </style>
</head>

<body>

<h2>SMAN 1 TANJUNGSIANG</h2>
<h4>DATA INVENTARIS BARANG</h4>

<br>

<table>
    <tr>
        <th width="35%">Kode Barang</th>
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
    {{ $commodity->getConditionName() }}
</td>
    </tr>
</table>

</body>
</html>