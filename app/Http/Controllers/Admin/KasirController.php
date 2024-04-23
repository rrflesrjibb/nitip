<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kasir;
use Illuminate\Support\Facades\Hash;

class KasirController extends Controller
{
    public function index(){
        $data = array(
            'title'  =>  'Data Kasir',
            'data_kasir' => Kasir::all()
        );

         return view('admin.page.kasir.index',$data);
    }

    public function store(Request $request){
        Kasir::create([
            'name'       =>    $request->name,
            'email'      =>    $request->email,
            'password'   =>    Hash::make($request->password),
        ]);

        return redirect('/admin/datakasir')->with('success','Data Berhasil Disimpan');
    }

    public function update(Request $request, $id){
        Kasir::where('id',$id)
        ->where('id',$id)
        ->update([
            'name'       =>    $request->name,
            'email'      =>    $request->email,
            'password'   =>    Hash::make($request->password),
        ]);

        return redirect('/admin/datakasir')->with('success','Data Berhasil DiUbah');
    }

    public function destroy($id){
        $kasir = Kasir::where('id',$id)->delete();
        return redirect('/admin/datakasir')->with('success','Data Berhasil Dihapus');
    }
}
