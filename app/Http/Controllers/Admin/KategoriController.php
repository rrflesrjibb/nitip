<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    public function kategori(){
        $data = array(
            'title'  =>  'Data Kategori',
            'data_kategori' => Kategori::all()
        );

        return view('admin.page.category.list', $data);
    }

    public function store(Request $request){
        Kategori::create([
            'kategori' => $request->kategori,
        ]);

        return redirect('/datakategori')->with('success', 'Data Berhasil Disimpan');
    }

    public function update(Request $request, $id){
        Kategori::where('id', $id)
            ->update([
                'kategori' => $request->kategori,
            ]);

        return redirect('/datakategori')->with('success', 'Data Berhasil DiUbah');
    }

    public function destroy($id){
        Kategori::where('id', $id)->delete();
        return redirect('/datakategori')->with('success', 'Data Berhasil Dihapus');
    }
}
