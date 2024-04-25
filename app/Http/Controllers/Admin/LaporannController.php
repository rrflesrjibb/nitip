<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class LaporannController extends Controller
{
    public function index()
    {
        // Pastikan pengguna telah login sebelum mengakses laporan
        if (Auth::check()) {
            // Mengambil data transaksi dari semua kasir
            $transaksis = Transaksi::all();

            // Mengirim data transaksi ke view
            return view('admin.page.laporan.index', compact('transaksis'));
        } else {
            // Redirect atau lakukan penanganan sesuai kebijakan aplikasi jika pengguna belum login
            return redirect()->route('login');
        }
    }

    public function printPDF(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        // Ambil data transaksi berdasarkan rentang tanggal
        $transaksis = Transaksi::whereBetween('tgl_transaksi', [$start_date, $end_date])->get();

        // Check if transactions are found
        if ($transaksis->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data laporan penjualan untuk rentang tanggal yang dipilih.');
        }

        // Load view ke dalam variabel
        $pdf = PDF::loadView('admin.page.laporan.pdf', compact('transaksis', 'start_date', 'end_date'));

        // Set nama file PDF yang akan di-generate
        $fileName = 'laporan_penjualan_'.$start_date.'_to_'.$end_date.'.pdf';

        // Menghasilkan output file PDF untuk diunduh
        return $pdf->download($fileName);
    }
}
