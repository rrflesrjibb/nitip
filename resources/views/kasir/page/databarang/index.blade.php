@extends('kasir.layout.app')
@section('main')
    <div class="container">
        <div class="row justify-content-center align-items-center mt-5">
             <div class="col-lg-10">
              <div class="card mx-auto float-right mt-5" style="max-width: 100%;">
                <div class="card-header">
                <div class="box-header with-border">
                 <div class="d-flex align-item-center ">
                     <h3 class="card-title">Data Barang</h3>

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
