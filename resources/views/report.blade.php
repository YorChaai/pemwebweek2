<!DOCTYPE html>
<html>

<head>
    <title>Laporan Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
        }

        .date {
            text-align: right;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="date">
        Tanggal: {{ now()->format('d-m-Y H:i') }}
    </div>
    <h2>Laporan Produk</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Jumlah Produk</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $key => $product)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $product->nama_produk }}</td>
                    <td>{{ $product->deskripsi }}</td>
                    <td>Rp{{ number_format($product->harga, 0, ',', '.') }}</td>
                    <td>{{ $product->jumlah_produk }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
