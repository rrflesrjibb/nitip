<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <style>
        /* CSS untuk tampilan PDF */
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>
    <h1>Laporan Penjualan</h1>
    <p><strong>Periode:</strong> {{ \Carbon\Carbon::parse($start_date)->translatedFormat('d F Y') }} - {{ \Carbon\Carbon::parse($end_date)->translatedFormat('d F Y') }}</p>

    <div class="table-responsive">
        <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Kasir</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Pendapatan</th>
                <th>No Transaksi</th>
                <th>Tanggal Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @php $totalPendapatan = 0; @endphp
            @foreach ($transaksis as $index => $transaksi)
                @php $rowSpan = count($transaksi->detail_transaksi); @endphp
                @foreach ($transaksi->detail_transaksi as $detailIndex => $detail)
                    <tr>
                        @if ($detailIndex === 0)
                            <td rowspan="{{ $rowSpan }}">{{ $index + 0 }}</td>
                            <td rowspan="{{ $rowSpan }}">{{ $transaksi->kasir ? $transaksi->kasir->name : 'Kasir Tidak Diketahui' }}</td>
                        @endif
                        <td>{{ $detail->barang->nama_barang }}</td>
                        <td>Rp. {{ $detail->harga }}</td>
                        <td>{{ $detail->jumlah }} Pcs</td>
                        <td>Rp. {{ $detail->subtotal }}</td>
                        <td>{{ $transaksi->no_transaksi }}</td>
                        @if ($detailIndex === 0)
                            <td rowspan="{{ $rowSpan }}">{{ \Carbon\Carbon::parse($transaksi->tgl_transaksi)->translatedFormat('d F Y') }}</td>
                        @endif
                    </tr>
                @endforeach
                @php $totalPendapatan += $transaksi->total_bayar; @endphp
            @endforeach
            <tr>
                <td colspan="6" class="text-right"><strong>Total Pendapatan:</strong></td>
                <td colspan="2">Rp. {{ $totalPendapatan }}</td>
            </tr>
        </tbody>
    </table>
    </div>
</body>
</html>
