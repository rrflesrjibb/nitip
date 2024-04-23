 @extends('admin.layout.app')

 <div class="container">
  <div class="row justify-content-center align-items-center" style="height: 90vh;">
       <div class="col-lg-10">
        <div class="card mx-auto" style="max-width: 100%;">
          <div class="card-header">
                  <div class="box-header with-border">
                   <div class="d-flex align-item-center ">
                       <h3 class="card-title">Data Kasir</h3>
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
                                    <th><b><center>Nama</center></b></th>
                                    <th><b><center>Email</center></b></th>
                                    <th><b><center>Aksi</center></b></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($data_kasir) && count($data_kasir) > 0)
                                    @php $no = 1; @endphp
                                    @foreach ($data_kasir as $row)
                                        <tr>
                                            <td><center>{{ $no++ }}</center></td>
                                            <td><center>{{ $row->name }}</center></td>
                                            <td><center>{{ $row->email }}</center></td>
                                            <td><center>
                                              <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="#modalEdit{{ $row->id }}" data-toggle="modal" class="btn btn-primary btn-sm mr-1"><i class="fa fa-edit"></i></a>
                                                <a href="#modalHapus{{ $row->id }}" data-toggle="modal" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                            </div></center>
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
    </div>
</div>
</div>

  <div class="modal fade" id="modalCreate" tabindex="1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Create Data Kasir</h5>
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
          </div>
          <form action="/datakasir/store" method="POST">
            @csrf
            <div class="modal-body">
              <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" class="form-control" name="name" placeholder="Nama Lengkap ..." required>
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" placeholder="Email ..." required>
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password ..." required>
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

    @if(isset($data_kasir) && count($data_kasir) > 0)
    @foreach ($data_kasir as $d)
    <div class="modal fade" id="modalEdit{{ $d->id }}" tabindex="1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Update Data Kasir</h5>
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
          </div>
          <form action="/datakasir/update/{{ $d->id }}" method="POST">
            @csrf
            <div class="modal-body">
              <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" value="{{ $d->name }}" class="form-control" name="name" placeholder="Nama Lengkap ..." required>
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="email" value="{{ $d->email }}"  class="form-control" name="email" placeholder="Email ..." required>
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password ..." required>
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

@if(isset($data_kasir) && count($data_kasir) > 0)
@foreach ($data_kasir as $c)
    <div class="modal fade" id="modalHapus{{ $c->id }}" tabindex="1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Hapus Data Kasir</h5>
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
          </div>
          <form action="/datakasir/destroy/{{ $c->id }}" method="GET">
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
