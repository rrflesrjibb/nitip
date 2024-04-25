<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\Barang;
use App\Models\Member;
use App\Models\cek;
use App\Models\DetailTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PDF;

class TransaksiController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Transaksi',
        ];

        // Mendapatkan ID kasir yang sedang masuk
        $kasirId = Auth::id();

        // Mengambil transaksi yang dilakukan oleh kasir yang sedang masuk
        $transaksi = Transaksi::where('id_kasir', $kasirId)->get();

        return view('kasir.page.transaksi.index', $data, compact('transaksi'));
    }


    public function create()
    {
        $data_barang = Barang::all();
        $data_member = Member::all();

        $detail = DetailTransaksi::where('id_transaksi',null)->get();

        return view('kasir.page.transaksi.add', compact('data_member', 'data_barang','detail'));
    }

    public function transaksi(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = new Transaksi;

            $data->id_member = $request->member;
            $data->bayar = $request->uang_pembeli;
            $data->diskon = $request->diskon;
            $data->tgl_transaksi = Carbon::now(); // or now()
            $data->total_bayar = $request->total_bayar;
            $data->uang_kembalian = $request->kembalian;
            $data->no_transaksi = $this->generateNomorTransaksi(); // Menambahkan nomor transaksi

            // Mendapatkan ID kasir yang sedang masuk
            $kasirId = Auth::id();
            $data->id_kasir = $kasirId;

            $data->save();

            // Memperbarui detail transaksi yang belum terhubung dengan transaksi
            if ($data->exists) {
                $data_terbaru = Transaksi::latest()->first();
                DetailTransaksi::whereNull('id_transaksi')->update(['id_transaksi' => $data_terbaru->id]);
            }

            // Mengurangi stok barang yang terlibat dalam transaksi
            $detailTransaksi = DetailTransaksi::where('id_transaksi', $data->id)->get();
            foreach ($detailTransaksi as $detail) {
                $barang = Barang::find($detail->id_barang);
                if ($barang) {
                    // Kurangi stok barang sesuai dengan jumlah pembelian pada detail transaksi
                    $barang->stok -= $detail->jumlah;
                    $barang->save();
                }
            }

            DB::commit();

            // Mengambil transaksi yang dilakukan oleh kasir yang sedang masuk
            $transaksi = Transaksi::where('id_kasir', $kasirId)->get();

            return view('kasir.page.transaksi.index', compact('transaksi'));
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }
    }

    // Method untuk menghasilkan nomor transaksi dengan awalan "NT-"
    private function generateNomorTransaksi() {
        // Format nomor transaksi: NT-TGL-BLN-THN-JAM-MENIT-DETIK
        return 'NT-' . date('ymdHis');
    }



    public function addBarang(Request $request)
    {
        try {
            $data_barang = Barang::findOrFail($request->id_barang);
            $jumlah = $request->jumlah;

            // Periksa apakah stok barang cukup untuk ditambahkan ke transaksi
            if ($data_barang->stok <= 0 || $jumlah > $data_barang->stok) {
                return redirect()->back()->with('error', 'Stok barang habis atau tidak mencukupi.');
            }

            // Tambahkan barang ke detail transaksi tanpa mengurangi stok
            $detail_transaksi = new DetailTransaksi;

            if ($data_barang) {
                $detail_transaksi->id_barang = $data_barang->id;
                $detail_transaksi->harga = $data_barang->harga;
                $detail_transaksi->jumlah = $jumlah;
                $detail_transaksi->subtotal = $data_barang->harga * $jumlah;

                $detail_transaksi->save();

                return redirect()->back()->with('success', 'Barang berhasil ditambahkan ke transaksi.');
            } else {
                return redirect()->back()->with('error', 'Barang tidak ditemukan.');
            }
        } catch (\Throwable $th) {
            // Tangani kesalahan jika terjadi
            return redirect()->back()->with('error', 'Gagal menambahkan barang ke transaksi. Silakan coba lagi.');
        }
    }


  public function hapusBarang($id)
{
    try {
        // Ambil detail transaksi yang akan dihapus
        $detailTransaksi = DetailTransaksi::findOrFail($id);

        // Ambil jumlah barang yang dibatalkan
        $jumlahDibatalkan = $detailTransaksi->jumlah;

        // Hapus detail transaksi dari database
        $detailTransaksi->delete();

        // Kembalikan jumlah barang yang dibatalkan ke stok
        $barang = $detailTransaksi->barang;
        $barang->stok += $jumlahDibatalkan;
        $barang->save();

        return redirect()->back()->with('success', 'Barang berhasil dibatalkan dan stok telah diperbarui.');
    } catch (\Throwable $th) {
        // Tangani kesalahan jika terjadi
        return redirect()->back()->with('error', 'Gagal membatalkan barang. Silakan coba lagi.');
    }
}


    public function cetak($id)
    {
        // Dapatkan transaksi dengan relasi detail_transaksi
        $transaksi = Transaksi::with('detail_transaksi')->findOrFail($id);

        // Dapatkan nama pengguna yang saat ini masuk (authenticated user)
        $kasir = Auth::user()->name;

        // Ambil informasi lain dari transaksi
        $diskon = $transaksi->diskon;
        $uang_pembeli = $transaksi->bayar;
        $kembalian = $transaksi->uang_kembalian;

        // Generate PDF
        $pdf = PDF::loadView('kasir.page.transaksi.cetak', compact('transaksi', 'kasir', 'diskon', 'uang_pembeli', 'kembalian'));

        // Tampilkan PDF di browser
        return $pdf->stream('laporan_transaksi.pdf');
    }

    public function detail($id)
    {
        try {
            // Mengambil detail transaksi berdasarkan ID transaksi
            $detailTransaksi = DetailTransaksi::where('id_transaksi', $id)->get();

            // Ambil informasi tambahan dari transaksi pertama (asumsi semua transaksi memiliki informasi yang sama)
            $diskon = $detailTransaksi->first()->transaksi->diskon ?? null;
            $total_bayar = isset($detailTransaksi->first()->transaksi->total_bayar) ? $detailTransaksi->first()->transaksi->total_bayar : null;
            $uang_pembeli = $detailTransaksi->first()->transaksi->bayar ?? null;
            $kembalian = $detailTransaksi->first()->transaksi->uang_kembalian ?? null;

            // Mengembalikan hasil dalam bentuk view
            return view('kasir.page.transaksi.detail', compact('detailTransaksi', 'diskon', 'uang_pembeli', 'kembalian'));
        } catch (\Throwable $th) {
            // Tangani kesalahan jika detail transaksi tidak ditemukan
            return redirect()->route('transaksi.index')->with('error', 'Detail transaksi tidak ditemukan.');
        }
    }


}

