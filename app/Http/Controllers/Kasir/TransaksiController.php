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
use PDF;

class TransaksiController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Transaksi',
        ];

        $transaksi = Transaksi::all();

        return view('kasir.page.transaksi.index', $data, compact('transaksi'));
    }

    public function create()
    {
        $data_barang = Barang::all();
        $data_member = Member::all();

        $detail = DetailTransaksi::where('id_transaksi',null)->get();

        return view('kasir.page.transaksi.add', compact('data_member', 'data_barang','detail'));
    }

    public function transaksi(request $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $data = new Transaksi;

            $data->id_member = $request->member;
            $data->bayar = $request->uang_pembeli;
            $data->diskon = $request->diskon;
            $data->tgl_transaksi = now();
            $data->total_bayar = $request->total_bayar;
            $data->uang_kembalian = $request->kembalian;

            $data->save();
            db::commit();

            if ($data->exists) {
                $data_terbaru = Transaksi::latest()->first();

                DetailTransaksi::whereNull('id_transaksi')->update(['id_transaksi' => $data_terbaru->id]);
            }

            $transaksi = Transaksi::all();

            return view('kasir.page.transaksi.index', compact('transaksi'));

            // $update->update();
            // db::commit();

        //  return redirect()->back();
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public function addBarang(Request $request)
{
    try {
        $data_barang = Barang::findOrFail($request->id_barang);
        $jumlah = $request->jumlah;
        $detail_transaksi = new DetailTransaksi;

        if ($data_barang) {
            $detail_transaksi->id_barang = $data_barang->id;
            $detail_transaksi->harga = $data_barang->harga;
            $detail_transaksi->jumlah = $jumlah;
            $detail_transaksi->subtotal = $data_barang->harga * $jumlah;

            $detail_transaksi->save();

            DB::commit();

            return redirect()->back()->with('success', 'Barang berhasil ditambahkan ke transaksi.');
        } else {
            return redirect()->back()->with('error', 'Barang tidak ditemukan.');
        }
    } catch (\Throwable $th) {

        DB::rollback();

        return redirect()->back()->with('error', 'Gagal menambahkan barang ke transaksi. Silakan coba lagi.');
    }
}




    public function hapusBarang($id)
    {

        try {
            $data_barang = DetailTransaksi::where('id',$id)->first();

            $data_barang->delete();
            db::commit();

            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
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

