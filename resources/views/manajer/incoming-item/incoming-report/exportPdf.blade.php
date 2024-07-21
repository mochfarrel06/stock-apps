<!DOCTYPE html>
<html>

<head>
    <title>Laporan Barang Masuk</title>
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
        <h2>PT. codeFa Technology</h2>
        <h4>Periode: {{ \Carbon\Carbon::parse($startDate)->locale('id')->isoFormat('D MMMM YYYY') }} -
            {{ \Carbon\Carbon::parse($endDate)->locale('id')->isoFormat('D MMMM YYYY') }}</h4>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Tanggal Barang Masuk</th>
                <th>Jumlah Barang Masuk</th>
            </tr>
        </thead>
        <tbody>
            @if ($incomingItems->isEmpty())
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data yang tersedia</td>
                </tr>
            @else
                @foreach ($incomingItems as $incomingItem)
                    <tr>
                        <td class="index">{{ $loop->index + 1 }}</td>
                        <td>{{ $incomingItem->item->item_code ?? '' }}</td>
                        <td>{{ $incomingItem->item->name ?? '' }}</td>
                        <td>{{ \Carbon\Carbon::parse($incomingItem->created_at)->locale('id')->isoFormat('D MMMM YYYY') }}
                        </td>
                        <td>{{ $incomingItem->quantity }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</body>

</html>