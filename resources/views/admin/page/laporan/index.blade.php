@extends('admin.layout.app')
@section('main')

<div class="container-fluid">
    <div class="row justify-content-center align-items-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Laporan Penjualan</h3>
                    <!-- Form Filter Tanggal -->
                    <form action="{{ route('print.pdf') }}" method="GET" class="mb-3">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="start_date">Tanggal Mulai</label>
                                <input type="date" class="form-control" name="start_date" id="start_date">
                            </div>
                            <div class="col-md-4">
                                <label for="end_date">Tanggal Selesai</label>
                                <input type="date" class="form-control" name="end_date" id="end_date">
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary mt-4">Cetak Laporan</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body">
                    <!-- Tabel Laporan -->
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
                                                <td rowspan="{{ $rowSpan }}">{{ \Carbon\Carbon::parse($transaksi->tgl_transaksi)->translatedFormat('d F Y ') }}</td>
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
                </div>
                <div class="card-footer">
                    <!-- Footer content here -->
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


@if(session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{{ session('error') }}',
        });
    </script>
@endif

@endsection
