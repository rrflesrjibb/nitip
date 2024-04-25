@extends('admin.layout.app')
@section('main')

<div class="container-fluid">
    <div class="row justify-content-center align-items-center">
         <div class="col-lg-10">
          <div class="card">
              <div class="card-header">
                  <div class="box-header with-border">
                      <div class="d-flex align-item-center ">
                          <h3 class="card-title">Data Kategori</h3>
                          <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#modalCreate">
                              <i class="fa fa-plus"></i> Tambah Data
                          </button>
                      </div>
                  </div>
              </div>
              <div class="card-body">
                  <div class="table-responsive">
                      <table id="myTable" class="table table-striped">
                          <thead>
                              <tr>
                                  <th><b><center>No</center></b></th>
                                  <th><b><center>Nama Kategori</center></b></th>
                                  <th><b><center>Aksi</center></b></th>
                              </tr>
                          </thead>
                          <tbody>
                              @if(isset($data_kategori) && count($data_kategori) > 0)
                                  @php $no = 1; @endphp
                                  @foreach ($data_kategori as $row)
                                      <tr>
                                          <td><center>{{ $no++ }}</center></td>
                                          <td><center>{{ $row->kategori }}</center></td>
                                          <td><center>
                                              <a href="#modalEdit{{ $row->id }}" data-toggle="modal" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                                              <a href="#modalHapus{{ $row->id }}" data-toggle="modal" class="btn btn-danger"><i class="fa fa-trash"></i></a></center>
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



<div class="modal fade" id="modalCreate" tabindex="1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create Data Kategori</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <form action="/datakategori/store" method="POST">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label>Nama Kategori</label>
            <input type="text" class="form-control" name="kategori" placeholder="Nama Kategori ..." required>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i>Close</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

@if(isset($data_kategori) && count($data_kategori) > 0)
@foreach ($data_kategori as $d)
<div class="modal fade" id="modalEdit{{ $d->id }}" tabindex="1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Data Kategori</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <form action="/datakategori/update/{{ $d->id }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label>Nama Kategori</label>
            <input type="text" value="{{ $d->kategori }}" class="form-control" name="kategori" placeholder="Nama Kategori ..." required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i>Close</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach
@endif

@if(isset($data_kategori) && count($data_kategori) > 0)
@foreach ($data_kategori as $c)
<div class="modal fade" id="modalHapus{{ $c->id }}" tabindex="1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Data Kategori</h5>
        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
      </div>
      <form action="/datakategori/destroy/{{ $c->id }}" method="GET">
        @csrf
        <div class="modal-body">
          <div class="form-group">
           <h5>Apakah Anda Ingin Menghapus Data ini ?</h5>
        </div>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i>Close</button>
          <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>Hapus</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach
@endif
<script>
   $(document).ready(function() {
      $('#myTable').DataTable();
  });
</script>


@if($message = Session::get('success'))
<script>Swal.fire({
    icon: "success",
    text: "{{ $message }}",});
</script>
@endif
@if($message = Session::get('failed'))
<script>Swal.fire({
    icon: "error",
    text: "{{ $message }}",});
</script>
@endif

@endsection
