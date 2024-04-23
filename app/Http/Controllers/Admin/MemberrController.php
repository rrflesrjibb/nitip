<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class MemberrController extends Controller
{
    public function index(){
        $data = array(
            'title'  =>  'Data Member',
            'data_member' => Member::all()
        );

        return view('admin.page.member.datamember', $data);
    }

    // public function store(Request $request){
    //    Member::create([
    //     'kode_member'  =>    $request->kode_member,
    //     'name'         =>    $request->name,
    //     'email'        =>    $request->email,
    //     'telepon'      =>    $request->telepon,
    //     'alamat'       =>    $request->alamat,
    //     'password'     =>    Hash::make($request->password),
    //     ]);

    //     return redirect('/kasir/datamember')->with('success', 'Data Berhasil Disimpan');
    // }

    // public function update(Request $request, $id){
    //    Member::where('id', $id)
    //         ->update([
    //             'kode_member'  =>    $request->kode_member,
    //             'name'         =>    $request->name,
    //             'email'        =>    $request->email,
    //             'telepon'      =>    $request->telepon,
    //             'alamat'       =>    $request->alamat,
    //             'password'     =>    Hash::make($request->password),
    //         ]);

    //     return redirect('/kasir/datamember')->with('success', 'Data Berhasil DiUbah');
    // }

    // public function destroy($id){
    //     Member::where('id', $id)->delete();
    //     return redirect('/kasir/datamember')->with('success', 'Data Berhasil Dihapus');
    // }
}
