@extends('kasir.layout.app')

@section('main')
<div class="container">
    <div class="row justify-content-center align-items-center" style="height: 95vh;">
        <div class="col-lg-9 mt-5">
            <div class="card mt-3">
                <div class="card-header">
                    <div class="box-header with-border">
                        <div class="d-flex align-item-center ">
                            <h3 class="card-title">Data Transaksi</h3>
                            <a class="btn btn-primary btn-round ml-auto" href="/transaksi/create">
                                <i class="fa fa-plus"></i> Tambah Transaksi
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th><b><center>No</center></b></th>
                                    <th><b><center>Tanggal</center></b></th>
                                    <th><b><center>Total Bayar</center></b></th>
                                    <th><b><center>Aksi</center></b></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($transaksi) && count($transaksi) > 0)
                                    @php $no = 1; @endphp
                                    @foreach ($transaksi as $row)
                                        <tr>
                                            <td><center>{{ $no++ }}</center></td>
                                            <td><center>{{ strftime('%d %B %Y', strtotime($row->tgl_transaksi)) }}</center></td>
                                            <td><center>Rp. {{ number_format( $row->total_bayar) }}</center></td>
                                            <td>
                                                <center>
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <a href="{{ route('transaksi.detail', $row->id) }}" class="btn btn-success btn-sm"><i class="fa fa-bars"></i> Detail</a>
                                                        <span style="margin: 0 5px;"></span> <!-- Menambahkan sedikit jarak -->
                                                        <a href="{{ route('transaksi.cetak', $row->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-print"></i> Cetak</a>
                                                    </div>
                                                </center>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>

@endsection
