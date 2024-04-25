@extends('admin.layout.app')
@section('main')

<div class="container-fluid">
  <div class="row justify-content-center align-items-center">
       <div class="col-lg-10">
        <div class="card">
          <div class="card-header">
                <div class="box-header with-border">
                 <div class="d-flex align-item-center ">
                     <h3 class="card-title">Data Barang</h3>
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
                                   <th><b><center>Kode Barang</center></b></th>
                                   <th><b><center>Nama Barang</center></b></th>
                                   <th><b><center>Kategori</center></b></th>
                                   <th><b><center>Stok</center></b></th>
                                   <th><b><center>Harga</center></b></th>
                                   <th><b><center>Aksi</center></b></th>
                               </tr>
                           </thead>
                           <tbody>
                               @if(isset($data_barang) && count($data_barang) > 0)
                                   @php $no = 1; @endphp
                                   @foreach ($data_barang as $row)
                                       <tr>
                                           <td><center>{{ $no++ }}</center></td>
                                           <td><center>{{ $row->kode_brg }}</center></td>
                                           <td><center>{{ $row->nama_barang }}</center></td>
                                           <td><center>{{ $row->kategori }}</center></td>
                                           <td><center>{{ $row->stok }}Pcs</center></td>
                                           <td><center>Rp.{{ number_format($row->harga) }}</center></td>
                                           <td><center>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <a href="#modalEdit{{ $row->id }}" data-toggle="modal" class="btn btn-primary btn-sm mr-1"><i class="fa fa-edit"></i></a>
                                                <a href="#modalHapus{{ $row->id }}" data-toggle="modal" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
   </div>
</div>
</div>

<div class="modal fade" id="modalCreate" tabindex="1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Create Data Barang</h5>
          <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <form action="/databarang/store" method="POST">
          @csrf
          <div class="modal-body">
           <div class="form-group">
             <label class="text-black">Kode Barang</label>
             <input type="text" class="form-control" name="kode_brg" id="kode_brg" readonly>
           </div>
            <div class="form-group">
              <label class="text-black">Nama Barang</label>
              <input type="text" class="form-control" name="nama_barang" placeholder="Nama Barang ..." required>
            </div>
             <div class="form-group">
               <label class="text-black">Kategori</label>
               <select class="form-control" name="id_kategori" required>
                 <option value="" hidden>-- Pilih Kategori --</option>
                 @foreach($data_kategori as $b)
                   <option value="{{ $b->id }}">{{ $b->kategori }}</option>
                 @endforeach
               </select>
             </div>
             <div class="form-group">
             <label class="text-black">Stok</label>
             <div class="input-group">
               <input type="number" name="stok" placeholder="Stok ..." class="form-control" required>
               <div class="input-group-prepend">
                 <span class="input-group-text">Pcs</span>
               </div>
             </div>
             </div>
             <div class="form-group">
             <label class="text-black">Harga</label>
             <div class="input-group">
               <div class="input-group-prepend">
                 <span class="input-group-text">Rp</span>
             </div>
             <input type="number" name="harga" class="form-control" placeholder="Harga ..." required>
           </div>
          </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i>Close</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Save</button>
          </div>
          </div>
        </form>
      </div>
    </div>
</div>
  <!-- Bagian loop foreach untuk menampilkan modalEdit -->
@if(isset($data_barang) && count($data_barang) > 0)
@foreach ($data_barang as $d)
   <div class="modal fade" id="modalEdit{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="modalEdit{{ $d->id }}" aria-hidden="true">
     <div class="modal-dialog modal-lg">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="modalEdit{{ $d->id }}">Update Data Barang</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <form action="/databarang/update/{{ $d->id }}" method="POST">
           @csrf
           <div class="modal-body">
            <div class="form-group">
              <label class="text-black">Kode Barang</label>
              <input type="text" class="form-control" name="kode_brg" value="{{ $d->kode_brg }}" placeholder="Kode Barang ..." required readonly>
            </div>
             <div class="form-group">
               <label class="text-black">Nama Barang</label>
               <input type="text" class="form-control" name="nama_barang" value="{{ $d->nama_barang }}" placeholder="Nama Barang ..." required>
             </div>
              <div class="form-group">
                <label class="text-black">Kategori</label>
                <select class="form-control" name="id_kategori" required>
                  <option value="{{ $d->id_kategori }}"> {{ $d->kategori }} </option>
                  @foreach($data_kategori as $b)
                    <option value="{{ $b->id }}" hidden>{{ $b->kategori }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
              <label class="text-black">Stok</label>
              <div class="input-group">
                <input type="number" name="stok" value="{{ $d->stok }}" placeholder="Stok ..." class="form-control" required>
                <div class="input-group-prepend">
                  <span class="input-group-text">Pcs</span>
                </div>
              </div>
              </div>
              <div class="form-group">
              <label class="text-black">Harga</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">Rp</span>
              </div>
              <input type="number" name="harga" value="{{ $d->harga }}" class="form-control" placeholder="Harga ..." required>
            </div>
           </div>
         <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i>Close</button>
             <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i>Save</button>
           </div>
           </div>
         </form>
       </div>
     </div>
   </div>
@endforeach
@endif

@if(isset($data_barang) && count($data_barang) > 0)
@foreach ($data_barang as $c)
   <div class="modal fade" id="modalHapus{{ $c->id }}" tabindex="-1" role="dialog" aria-labelledby="modalHapus{{ $c->id }}" aria-hidden="true">
     <div class="modal-dialog modal-lg">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title" id="modalHapus{{ $c->id }}">Hapus Data Barang</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <form action="/databarang/destroy/{{ $c->id }}" method="GET">
           @csrf
           <div class="modal-body">
             <div class="form-group">
              <h5>Apakah Anda Ingin Menghapus Data ini ?</h5>
           </div>
         </div>
           <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-undo"></i>Close</button>
             <button type="submit" class="btn btn-danger"><i class="mdi mdi-delete"></i>Hapus</button>
           </div>
         </form>
       </div>
     </div>
   </div>
@endforeach
@endif

<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script>
    function generateKode() {
      var kode = "BRG-" + Date.now(); // Menggunakan timestamp

      document.getElementById("kode_brg").value = kode;
    }

    window.onload = generateKode;
</script>

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
