<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\KasirController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\MemberrController;
use App\Http\Controllers\Admin\LaporannController;
use App\Http\Controllers\Kasir\KasirrController;
use App\Http\Controllers\Kasir\BaranggController;
use App\Http\Controllers\Kasir\MemberController;
use App\Http\Controllers\Kasir\TransaksiController;
use App\Http\Controllers\Kasir\LaporanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and assigned to the "web" middleware group.
| Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'actionLogin'])->name('actionLogin');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Route untuk dashboard admin
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/datakategori', [KategoriController::class, 'kategori'])->name('kategori.index');
    Route::post('/datakategori/store', [KategoriController::class, 'store'])->name('kategori.store');
    Route::post('/datakategori/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::get('/datakategori/destroy/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

    Route::get('/admin/databarang', [BarangController::class, 'index'])->name('barang.index');
    Route::post('/databarang/store', [BarangController::class, 'store'])->name('barang.store');
    Route::post('/databarang/update/{id}', [BarangController::class, 'update'])->name('barang.update');
    Route::get('/databarang/destroy/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
    Route::get('/databarang/generatekode', 'DataBarangController@generateKode')->name('databarang.generateKode');


    Route::get('/admin/datakasir', [KasirController::class, 'index'])->name('datakasir');
    Route::post('/datakasir/store', [KasirController::class, 'store'])->name('datakasir.store');
    Route::post('/datakasir/update/{id}', [KasirController::class, 'update'])->name('datakasir.update');
    Route::get('/datakasir/destroy/{id}', [KasirController::class, 'destroy'])->name('datakasir.destroy');

    Route::get('/admin/datamember', [MemberrController::class, 'index'])->name('datamember');

    Route::get('admin/laporan', [LaporannController::class, 'index'])->name('laporanpenjualan.index');
    Route::get('/print-pdf', [LaporannController::class, 'printPDF'])->name('print.pdf');

});



// Route untuk dashboard kasir
Route::middleware(['auth:kasir'])->group(function () {
    Route::get('/kasir/dashboard', [KasirrController::class, 'index'])->name('kasir.dashboard');

    Route::get('/kasir/databarang', [BaranggController::class, 'barangg'])->name('databarang.index');
    Route::get('/kasir/datamember', [MemberController::class, 'member'])->name('member.index');
    Route::post('/datamember/store', [MemberController::class, 'store'])->name('datamember.store');
    Route::post('/datamember/update/{id}', [MemberController::class, 'update'])->name('datamember.update');
    Route::get('/datamember/destroy/{id}', [MemberController::class, 'destroy'])->name('datamember.destroy');


    Route::get('/kasir/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');
    Route::post('/transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::post('/transaksi/addBarang', [TransaksiController::class, 'addBarang'])->name('transaksi.addBarang');
    Route::get('/hapusTransaksi/{id}', [TransaksiController::class, 'hapusBarang'])->name('transaksi.hapusBarang');
    Route::post('/transaksi/addtransaksi', [TransaksiController::class, 'transaksi'])->name('transaksi.addtransaksi');
    Route::get('/transaksi/{id}/cetak', [TransaksiController::class, 'cetak'])->name('transaksi.cetak');
    Route::get('transaksi/{id}/detail', [TransaksiController::class, 'detail'])->name('transaksi.detail');
    Route::get('/laporan-penjualan', [LaporanController::class, 'index'])->name('laporan.index');


});
