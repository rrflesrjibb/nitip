<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BaranggController extends Controller
{
    public function barangg(){
        $data = array(
            'title' => 'Data Barang',
            'data_kategori' => Kategori::all(),
            'data_barang' => Barang::join('tbl_kategori', 'tbl_kategori.id', '=', 'tbl_barang.id_kategori')
                            ->select('tbl_barang.*', 'tbl_kategori.kategori')
                            ->get(),
        );

        return view('kasir.page.databarang.index', $data);
    }

//     public function store(Request $request){
//         Barang::create([
//             'id_kategori' => $request->id_kategori,
//             'kode_brg' => $request->kode_brg,
//             'nama_barang' => $request->nama_barang,
//             'harga' => $request->harga,
//             'stok' => $request->stok,
//         ]);

//         return redirect('/databarang')->with('success', 'Data Berhasil Disimpan');
//     }

//     public function update(Request $request, $id){
//         Barang::where('id', $id)
//             ->update([
//                 'id_kategori' => $request->id_kategori,
//                 'kode_brg' => $request->kode_brg,
//                 'nama_barang' => $request->nama_barang,
//                 'harga' => $request->harga,
//                 'stok' => $request->stok,
//             ]);

//         return redirect('/databarang')->with('success', 'Data Berhasil Diubah');
//     }

//     public function destroy($id){
//         Barang::where('id', $id)->delete();
//         return redirect('/databarang')->with('success', 'Data Berhasil Dihapus');
//     }
 }
