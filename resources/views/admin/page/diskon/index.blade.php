@extends('admin.layout.app')
@section('main')

<div class="container">
  <div class="row justify-content-center align-items-center" style="height: 90vh;">
       <div class="col-lg-10">
        <div class="card mx-auto" style="max-width: 100%;">
            @if(isset($data_diskon) && count($data_diskon) > 0)
            @foreach ($data_diskon as $d)
              <form action="/setdiskon/update/{{ $d->id }}" method="post">
                @csrf
                <div class="card-body">
                <div class="d-flex align-item-center ">
                    <h3 class="card-title">Data Kategori</h3>
                </div>
              <hr/>
                <div class="row">
                  <div class="col-md-6">
                    <label>Total Belanja</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                      </div>
                      <input type="number" name="total_belanja" value="{{ $d->total_belanja }}" placeholder="Total Belanja ..." class="form-control" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label>Diskon</label>
                    <div class="input-group mb-3">
                      <input type="number" name="diskon" value="{{ $d->diskon }}" placeholder="Diskon ..." class="form-control" required>
                      <div class="input-group-prepend">
                        <span class="input-group-text">%</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Save Changes
                    </button>
                  </div>
                </form>
                @endforeach
                @endif
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


@if($message = Session::get('success'))
<script> swal({
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
<script>Swal.fire({
    icon: "error",
    text: "{{ $message }}",});
</script>
@endif
@endsection
