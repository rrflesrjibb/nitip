<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Diskon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DiskonController extends Controller
{
    public function index(){
        $data = array(
            'title'  =>  'Setting Diskon',
            'data_diskon' => Diskon::all()
        );

        return view('admin.page.diskon.index', $data);
    }

    public function update(Request $request, $id){
        Diskon::where('id', $id)
            ->update([
                'total_belanja' => $request->total_belanja,
                'diskon' => $request->diskon,
            ]);

        return redirect('/admin/setdiskon')->with('success', 'Data Berhasil DiUbah');
    }
}
