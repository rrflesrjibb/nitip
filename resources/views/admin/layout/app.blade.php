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
    <link rel="stylesheet" href="{{ asset('assets/DataTable/dattable.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/DataTables/datatables.min.css')}}">

    <link rel="shortcut icon" href="{{ asset('assets/image/logo.png') }}" />
    @stack('style')
</head>
<body>


@include('admin.layout.sidebar')
@include('admin.layout.navbar')

<main>
    @yield('main')
</main>



<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/DataTables/datatables.js')}}"></script>
<script src="{{ asset('assets/DataTables/datatables.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@stack('script')

@if($message = Session::get('success'))
<script>
    Swal.fire({
        icon: "success",
        text: "{{ $message }}",
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
