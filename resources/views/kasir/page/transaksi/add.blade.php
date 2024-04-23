@extends('kasir.layout.app')
@section('main')
<div class="container">
    <div class="row justify-content-center align-items-center mt-5">
         <div class="col-lg-10">
          <div class="card mx-auto float-right mt-5" style="max-width: 100%;">
            <div class="card-header">
             <div class="d-flex align-item-center ">
                <h3 class="card-title">Data Transaksi</h3>
                <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#modalCreate">
                    <i class="fa fa-plus"></i> Tambah Data
                </button>
            </div>
        </div>
             <div class="card-body">
                 <hr/>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th><b><center>No</center></b></th>
                            <th><b><center>Nama Barang</center></b></th>
                            <th><b><center>Harga</center></b></th>
                            <th><b><center>Qty</center></b></th>
                            <th><b><center>subtotal</center></b></th>
                            <th><b><center>Aksi</center></b></th>
                        </tr>
                        @foreach ($detail as $item)
                            <tr class="text-center">
                                <td>
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    {{ $item->barang->nama_barang }}
                                </td>
                                <td>
                                    <input type="number" name="harga" class="form-control" value="{{ $item->harga }}" readonly>
                                </td>
                                <td>
                                    <input type="number" name="harga" class="form-control" value="{{ $item->jumlah }}" readonly>
                                </td>
                                <td>
                                    <input type="number" name="subtotal" class="form-control" value="{{ $item->subtotal }}" readonly>
                                 </td>
                                 <td class="text-center">
                                    <a href="{{route('transaksi.hapusBarang', $item->id)}}" class="btn btn-danger">hapus</a>
                                 </td>
                            </tr>
                        @endforeach
                        <form id="transactionForm" action="{{ route('transaksi.addtransaksi') }}" method="post">
                            @csrf
                                <tr>
                                    <tr>
                                        <td colspan="5">Member</td>
                                        <td>
                                            <select class="form-control" name="member" id="member" required>
                                                <option value="" hidden>-- Pilih Member --</option>
                                                @foreach($data_member as $member)
                                                    <option value="{{ $member->id }}">{{ $member->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                <tr>
                                    <td colspan="5">Diskon</td>
                                    <td>
                                        <input type="text"name='diskon' readonly value="" class="form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5">Total Bayar</td>
                                    <td>
                                        <input type="text" id="total_bayar" name='total_bayar' readonly value="" class="form-control">
                                    </td>
                                </tr>
                            </table>
                            <hr/>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Uang Pembeli</label>
                                        <input type="text" class="form-control" name="uang_pembeli" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kembalian</label>
                                        <input type="text" class="form-control" name="kembalian" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Tanggal Transaksi</label>
                                        <input type="text" class="form-control" value="{{ date('d F Y') }}" readonly required>
                                    </div>
                                </div>

                                </div>
                            </div>
                        </div>
                     <div class="card-footer">
                  <button type="submit" class="btn btn-primary float-right"><i class="fa fa-save"></i>Save Changes
              </button>
           </div>
       </form>
    </div>
</div>
 </div>
</div>


 <div class="modal fade" id="modalCreate" tabindex="1" role="dialog" aria-hidden="true">
     <div class="modal-dialog modal-lg">
       <div class="modal-content">
         <div class="modal-header">
           <h5 class="modal-title">Create Data Transaksi</h5>
           <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
         </div>
         <form action="{{ route('transaksi.addBarang')}}" method="POST">
           @csrf
           <div class="modal-body">
            <div class="form-group">
                <label class="text-black">Nama Barang</label>
                <select class="form-control" name="id_barang" id="id_barang" required>
                    <option value="" hidden>-- Pilih Barang --</option>
                    @foreach($data_barang as $barang)
                        <option value="{{ $barang->id }}" data-stok="{{ $barang->stok }}" data-harga="{{ $barang->harga }}">{{ $barang->nama_barang }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="text-black">Stok</label>
                <input type="text" class="form-control" id="tampil_stok" readonly>
            </div>
            <div class="form-group">
                <label class="text-black">Harga</label>
                <input type="text" class="form-control" id="tampil_harga" readonly>
            </div>
            <div class="form-group">
                <label class="text-black">Qty</label>
                <input type="number" name="jumlah" class="form-control">
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

 <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
   <script>
      $(document).ready(function() {
         $('#myTable').DataTable();
     });
   </script>

<script>
    var jumlahInputs = document.getElementsByName('jumlah');
    var subtotalInputs = document.getElementsByName('subtotal');
    var hargaInputs = document.getElementsByName('harga');

    jumlahInputs.forEach(function(input, index) {
        input.addEventListener('input', function() {

            var jumlah = parseInt(input.value);

            if (isNaN(jumlah)) {
                jumlah = 1;
            }

            var harga = parseInt(hargaInputs[index].value);

            if (isNaN(harga)) {
                harga = 0;
            }

            var subtotal = jumlah * harga;

            subtotalInputs[index].value = subtotal;
        });
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

<script>
    $(document).on('change', '#id_barang', function() {
        var stok = $(this).find(':selected').data('stok');
        var harga = $(this).find(':selected').data('harga');

        $('#tampil_stok').val(stok);
        $('#tampil_harga').val(harga);
    });
</script>


<script>
    function hitungDiskon() {
        var memberSelect = document.getElementById('member');
        var diskonInput = document.getElementsByName('diskon')[0];
        var totalBayarInput = document.getElementsByName('total_bayar')[0];
        var totalBayar = parseFloat(totalBayarInput.value);
        var selectedMemberValue = parseFloat(memberSelect.value);

        if (selectedMemberValue && totalBayar >= 50000) {
            memberSelect.disabled = true;

            var diskon = 0.05 * totalBayar;
            totalBayar -= diskon;
            diskonInput.value = parseInt(diskon);
        } else {

            diskonInput.value = "";
        }

        totalBayarInput.value = parseInt(totalBayar);
    }

    document.addEventListener('DOMContentLoaded', function() {
        hitungDiskon();

        var memberSelect = document.getElementById('member');
        memberSelect.addEventListener('change', hitungDiskon);
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        function hitungKembalian() {
            var uangPembeliInput = document.getElementsByName('uang_pembeli')[0];
            var totalBayarInput = document.getElementsByName('total_bayar')[0];
            var kembalianInput = document.getElementsByName('kembalian')[0];
            var uangPembeli = parseFloat(uangPembeliInput.value);
            var totalBayar = parseFloat(totalBayarInput.value);

            var kembalian = uangPembeli - totalBayar;
            kembalianInput.value = kembalian.toFixed(0);
        }

        var uangPembeliInput = document.getElementsByName('uang_pembeli')[0];
        uangPembeliInput.addEventListener('input', hitungKembalian);
    });
</script>



<script>
    function hitungTotalBayar() {
        var subtotalInputs = document.getElementsByName('subtotal');
        var totalBayarInput = document.getElementsByName('total_bayar')[0];
        var totalBayar = 0;

        for (var i = 0; i < subtotalInputs.length; i++) {
            var subtotal = parseInt(subtotalInputs[i].value);
            totalBayar += subtotal;
        }

        totalBayar = Math.round(totalBayar);
        totalBayarInput.value = totalBayar;
    }

    document.addEventListener('DOMContentLoaded', function() {
        hitungTotalBayar();
        var jumlahInputs = document.getElementsByName('jumlah');

        for (var i = 0; i < jumlahInputs.length; i++) {
            jumlahInputs[i].addEventListener('input', hitungTotalBayar);
        }
    });
</script>
@endsection
