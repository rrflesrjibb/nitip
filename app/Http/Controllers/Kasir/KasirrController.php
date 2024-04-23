<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KasirrController extends Controller
{
    public function index(){
        // $data_member = DB::table('users')->where('role', 'member')->count();
        $jumlah_member = DB::table('tbl_member')->count();
        $jumlah_transaksi = DB::table('tbl_transaksi')->count();
        // dd($usersWithOrdersCount);
        return view('kasir.page.dashboard.index', compact('jumlah_member', 'jumlah_transaksi'));
    }
    
}
