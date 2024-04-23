<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Market Fless</title>
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
</head>
<body>
  <div class="container">
    <div class="row justify-content-center align-items-center" style="height: 95vh;">
        <div class="col-lg-5">
            <div class="card"> <!-- Menambahkan kelas shadow -->
                <div class="card-body pt-5">
                    <div class="text-center mb-3">
                        <img src="../../assets/image/logo.png" alt="Market Fless" width="180">
                    </div>
                    <form action="{{route('actionLogin')}}" class="login-input" method="post">
                        @csrf
                        <div class="form-group mb-4">
                            <input type="email" class="form-control p_input" placeholder="Masukkan Username" name="email">
                            @error('email')
                            <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group mb-5">
                            <input type="password" class="form-control p_input" placeholder="Masukkan Password" name="password">
                            @error('password')
                            <small>{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-sm-5">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


  <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
  <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('assets/js/misc.js') }}"></script>
  <script src="{{ asset('assets/js/settings.js') }}"></script>
  <script src="{{ asset('assets/js/todolist.js') }}"></script>

  @if($message = Session::get('success'))
    <script>
      Swal.fire({
        icon: "success",
        text: "{{ $message }}",
      });
    </script>
  @endif
  @if($message = Session::get('error'))
    <script>
      Swal.fire({
        icon: "error",
        text: "{{ $message }}",
      });
    </script>
  @endif
</body>
</html>
