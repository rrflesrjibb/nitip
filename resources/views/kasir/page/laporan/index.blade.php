@extends('kasir.layout.app')
@section('main')

<div class="container-fluid">
    <div class="row justify-content-center align-items-center">
         <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Laporan Penjualan</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Pendapatan</th>
                                    <th>Tanggal Transaksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksis as $index => $transaksi)
                                @foreach ($transaksi->detail_transaksi as $detail)
                                    <tr>
                                        <td>{{ $index + 1 }}</td><!-- Kasir yang melakukan transaksi -->
                                        <td>{{ $detail->barang->nama_barang }}</td> <!-- Nama barang -->
                                        <td>{{ $detail->harga }}</td> <!-- Harga barang -->
                                        <td>{{ $detail->jumlah }}</td> <!-- Jumlah barang -->
                                        <td>{{ $transaksi->total_bayar }}</td> <!-- Pendapatan -->
                                        <td>{{ \Carbon\Carbon::parse($transaksi->tgl_transaksi)->isoFormat('D MMMM YYYY') }}</td> <!-- Tanggal transaksi -->
                                    </tr>
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <!-- Footer content here -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
