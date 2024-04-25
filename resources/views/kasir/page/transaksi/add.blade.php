@extends('kasir.layout.app')
@section('main')
<div class="container-fluid">
    <div class="row justify-content-center align-items-center">
         <div class="col-lg-10">
          <div class="card">
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
                                <td class="text-center">
                                    <input type="number" name="harga" class="form-control text-center" value="{{ $item->harga }}" readonly>
                                </td>
                                <td>
                                    <input type="number" name="harga" class="form-control text-center" value="{{ $item->jumlah }}" readonly>
                                </td>
                                <td>
                                    <input type="number" name="subtotal" class="form-control text-center" value="{{ $item->subtotal }}" readonly>
                                 </td>
                                 <td class="text-center">
                                    <a href="{{route('transaksi.hapusBarang', $item->id)}}" class="btn btn-danger btn-delete">hapus</a>
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
                                                <option value="">Non Member</option>
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
                                        <input type="text" id="total_bayar" name='total_bayar' readonly value="Rp." class="form-control">
                                    </td>
                                </tr>
                            </table>
                            <hr/>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>No Transaksi</label>
                                        <input type="text" id="no_transaksi" class="form-control" readonly required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Uang Pembeli</label>
                                        <input type="text" class="form-control" name="uang_pembeli" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tanggal Transaksi</label>
                                        <input type="text" class="form-control" value="{{ date('d F Y') }}" readonly required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kembalian</label>
                                        <input type="text" class="form-control" name="kembalian" required>
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

 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
@if(session('error'))
    <script>
        Swal.fire({
            title: 'Error!',
            text: '{{ session('error') }}',
            icon: 'error',
            confirmButtonText: 'OK'
        });
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
    // Fungsi untuk menghasilkan nomor transaksi otomatis
    function generateNomorTransaksi() {
    // Mendapatkan tanggal saat ini
    var today = new Date();
    var year = today.getFullYear();
    var month = today.getMonth() + 1;
    var day = today.getDate();
    var hour = today.getHours();
    var minute = today.getMinutes();
    var second = today.getSeconds();

    // Format tanggal menjadi string YYMMDDHHmmss
    var dateStr = year.toString().slice(-2) + ('0' + month).slice(-2) + ('0' + day).slice(-2) +
        ('0' + hour).slice(-2) + ('0' + minute).slice(-2) + ('0' + second).slice(-2);

    // Nomor transaksi akan terdiri dari "NT-" dan tanggal
    var nomorTransaksi = "NT-" + dateStr;

    // Masukkan nomor transaksi ke dalam input tersembunyi
    document.getElementById("no_transaksi").value = nomorTransaksi;
}

// Panggil fungsi generateNomorTransaksi saat halaman dimuat
window.onload = generateNomorTransaksi;

</script>

<script>
    function hitungDiskon() {
        var memberSelect = document.getElementById('member');
        var diskonInput = document.getElementsByName('diskon')[0];
        var totalBayarInput = document.getElementsByName('total_bayar')[0];
        var totalBayar = parseFloat(totalBayarInput.value);

        // Mengubah diskon menjadi persentase
        var diskonPercentage = 5; // Persentase diskon

        // Periksa apakah total belanja mencapai atau melebihi 50000
        if (totalBayar >= 50000) {
            // Jika total belanja mencapai atau melebihi 50000, periksa pemilihan member
            var selectedMemberValue = parseFloat(memberSelect.value);
            if (selectedMemberValue) {
                // Jika member dipilih, hitung diskon berdasarkan persentase
                var diskon = diskonPercentage;
                totalBayar -= totalBayar * (diskon / 100); // Menghitung diskon berdasarkan persentase
                diskonInput.value = diskon + "%"; // Menampilkan persentase diskon
            } else {
                // Jika member tidak dipilih, kosongkan input diskon
                diskonInput.value = "";
            }
            // Aktifkan pilihan member
            memberSelect.disabled = false;
        } else {
            // Jika total belanja kurang dari 50000, diskon diatur ke nol dan input diskon dikosongkan
            diskonInput.value = "";
            // Nonaktifkan pilihan member
            memberSelect.disabled = true;
        }

        totalBayarInput.value = parseInt(totalBayar);
    }

    document.addEventListener('DOMContentLoaded', function() {
        hitungDiskon();

        var memberSelect = document.getElementById('member');
        memberSelect.addEventListener('change', hitungDiskon);

        // Panggil hitungDiskon saat halaman dimuat
        window.onload = function() {
            hitungDiskon();
        };
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

            // Menampilkan pesan jika uang yang dibayarkan kurang dari total bayar
            if (kembalian < 0) {
                kembalianInput.value = "";
                // Tambahkan pesan ke dalam input kembalian
                kembalianInput.placeholder = "Uang kurang!";
            } else {
                kembalianInput.value = kembalian.toFixed(0);
            }
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

        // Panggil fungsi generateNomorTransaksi untuk memperbarui nomor transaksi setiap kali total bayar dihitung ulang
        generateNomorTransaksi();
    }

    document.addEventListener('DOMContentLoaded', function() {
        hitungTotalBayar();
        var jumlahInputs = document.getElementsByName('jumlah');

        for (var i = 0; i < jumlahInputs.length; i++) {
            jumlahInputs[i].addEventListener('input', hitungTotalBayar);
        }
    });
</script>

<script>
    $(document).on('click', '.btn-delete', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data transaksi akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus data!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });
</script>



@endsection
