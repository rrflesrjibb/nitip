<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class KasirrController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard Kasir',
        ];

        // Mendapatkan ID kasir yang sedang masuk
        $kasirId = Auth::id();

        // Mengambil jumlah transaksi yang dilakukan oleh kasir yang sedang masuk
        $jumlah_transaksi = Transaksi::where('id_kasir', $kasirId)->count();

        // Mengambil jumlah member dari tabel member
        $jumlah_member = DB::table('tbl_member')->count();

        return view('kasir.page.dashboard.index', compact('jumlah_member', 'jumlah_transaksi'));
    }

}
