<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanController extends Controller
{
    public function index()
    {
        // Mengambil ID kasir yang saat ini masuk
        $kasirId = Auth::id();

        // Mengambil data transaksi yang dilakukan oleh kasir dengan ID tertentu
        $transaksis = Transaksi::where('id_kasir', $kasirId)->get();

        // Mengirim data transaksi ke view
        return view('kasir.page.laporan.index', compact('transaksis'));
    }
}


