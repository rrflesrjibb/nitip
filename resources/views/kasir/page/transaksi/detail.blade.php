<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Market Fless</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/DataTables/datatables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/DataTables/datatables.min.css')}}">

    <link rel="shortcut icon" href="{{ asset('assets/image/logo.png') }}" />
    @stack('style')
</head>
<body>
<nav class="navbar navbar-expand fixed-top flex-row navbar-white bg-white">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Market Fless</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::guard('kasir')->user()->name }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
  </nav>
<div class="container">
    <div class="row justify-content-center align-items-center" style="height: 95vh;">
         <div class="col-lg-10">
            <div class="card mx-auto mt-5" style="max-width: 100%;">
                <div class="card-header">
                    <h3 class="card-title">Detail Transaksi</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detailTransaksi as $index => $detail)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $detail->barang->nama_barang }}</td>
                                    <td>{{ $detail->harga }}</td>
                                    <td>{{ $detail->jumlah }}</td>
                                    <td>{{ $detail->subtotal }}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    @if ($detailTransaksi->isNotEmpty())
                        @php
                            $transaksi = $detailTransaksi->first()->transaksi;
                            $total_bayar = $transaksi->total_bayar ?? null;
                        @endphp
                        {{-- <p><b>Member:</b> {{ optional($transaksi->member)->nama }}</p> --}}
                        <p><b>Diskon:</b> {{ $diskon }}</p>
                        <p><b>Total Bayar:</b> {{ $total_bayar }}</p>
                        <p><b>Uang Pembeli:</b> {{ $uang_pembeli }}</p>
                        <p><b>Kembalian:</b> {{ $kembalian }}</p>
                    @endif
                    <a href="{{ route('transaksi.index') }}" class="btn btn-primary">Kembali</a>
                </div>


            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/alerts.js') }}"></script>
<script src="{{ asset('assets/DataTables/datatables.js')}}"></script>
<script src="{{ asset('assets/DataTables/datatables.min.js')}}"></script>

@stack('script')

@if($message = Session::get('success'))


<script>
     swal({
        title: 'Congratulations!',
        text: 'You entered the correct answer',
        icon: 'success',
        button: {
          text: "{{ $message }}",
          value: true,
          visible: true,
          className: "btn btn-primary"
        }
      });
</script>
@endif
@if($message = Session::get('failed'))
<script>
    Swal.fire({
        icon: "error",
        text: "{{ $message }}",
    });
</script>
@endif

<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>

</body>
</html>

