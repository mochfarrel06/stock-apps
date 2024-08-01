<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data Barang</title>
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
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            color: #fff;
            font-weight: normal;
            background-color: #4e73df;
        }
    </style>
</head>

<body>
    <div style="text-align: center; margin-bottom: 3em">
        <h2>{{ $titlePdf }} PT. codeFa Technology</h2>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jenis Barang</th>
                <th>Stok</th>
                <th>Satuan</th>
            </tr>
        </thead>
        <tbody>
            @if ($items->isEmpty())
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data yang tersedia</td>
                </tr>
            @else
                @foreach ($items as $item)
                    <tr>
                        <td class="index">{{ $loop->index + 1 }}</td>
                        <td>{{ $item->item_code ?? '' }}</td>
                        <td>{{ $item->name ?? '' }}</td>
                        <td>{{ $item->itemType->name ?? '' }}</td>
                        <td>{{ $item->stock }}</td>
                        <td>{{ $item->unitType->name }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</body>

</html>
