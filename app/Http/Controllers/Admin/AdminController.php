<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){
        // $data_member = DB::table('users')->where('role', 'member')->count();
        $jumlah_kategori = DB::table('tbl_kategori')->count();
        $jumlah_kasir = DB::table('kasir')->count();
        // dd($usersWithOrdersCount);
        return view('admin.page.dashboard.index', compact('jumlah_kategori', 'jumlah_kasir'));
    }
}
