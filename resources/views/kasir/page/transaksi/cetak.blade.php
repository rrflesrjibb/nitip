<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Transaksi</title>
    <style>
        /* Atur gaya cetak */
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .info-left {
            text-align: left;
        }
        .info-right {
            text-align: right;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .text-center {
            text-align: center;
        }

        /* Responsif untuk mencetak */
        @media print {
            .container {
                max-width: 100%;
                margin: 0;
                padding: 0;
            }
            .header {
                margin-bottom: 10px;
            }
            .info {
                margin-bottom: 5px;
            }
            .table th, .table td {
                padding: 6px;
            }
            .footer {
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Market Fless</h1>
            <h4>-</h4>
            <h4></h4>
            <h3>SMKN 1 Katapang</h3>
            <h4>Jln.Ceuri Jalan Terusan Kopo No.KM 13.5, Katapang, Kec. Katapang</h4>
            <h3>===================================================================================</h3>
            <div class="info" style="display: flex; justify-content: space-between;">
                <div class="info-left">
                    <h4 style="margin: 0; vertical-align: middle;">Tanggal: {{ date('d F Y', strtotime($transaksi->tgl_transaksi)) }}
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No Transaksi: {{ $transaksi->no_transaksi }}
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kasir: {{ $kasir }}</h4>
                </div>
            </div>
            <h3>===================================================================================</h3>


        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Daftar Barang</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @if($transaksi->detail_transaksi)
                        @foreach($transaksi->detail_transaksi as $detail)
                            <tr class="text-center">
                                <td>{{ $detail->barang->nama_barang }}</td>
                                <td>Rp. {{ number_format($detail->harga) }}</td>
                                <td>{{ $detail->jumlah }}</td>
                                <td>Rp. {{ number_format($detail->subtotal) }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>

                <tfoot class="text-center">
                    <tr>
                        <th colspan="3" class="text-right">Diskon</th>
                        <td>Rp. {{ number_format($diskon) }}</td> <!-- Tampilkan diskon -->
                    </tr>
                    <tr>
                        <th colspan="3" class="text-right">Total Bayar</th>
                        <td>Rp. {{ number_format($transaksi->total_bayar) }}</td>
                    </tr>
                    <tr>
                        <th colspan="3" class="text-right">Cash</th>
                        <td>Rp. {{ number_format($uang_pembeli) }}</td> <!-- Tampilkan uang pembeli -->
                    </tr>
                    <tr>
                        <th colspan="3" class="text-right">Kembalian</th>
                        <td>Rp. {{ number_format($kembalian) }}</td> <!-- Tampilkan kembalian -->
                    </tr>
                </tfoot>
            </table>
    </div>
    <br>
        <div class="footer">
            <h3>=================================================================================</h3>
            <h1 class="text-center">*****Terimakasih*****</h1>
        </div>
    </div>
</body>
</html>
