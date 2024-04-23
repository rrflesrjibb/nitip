<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function actionLogin(Request $request)
    {
        try {
            $validated = $request->validate([
                'email'    => 'required|email',
                'password' => 'required',
            ]);

            if (Auth::guard('admin')->attempt($validated)) {
                return redirect()->route('admin.dashboard')->with('success', 'Selamat datang, Admin!');

            }

            if (Auth::guard('kasir')->attempt($validated)) {
                return redirect()->route('kasir.dashboard')->with('success', 'Selamat datang, Kasir!');

            }

            else throw ValidationException::withMessages(['failed' => 'Cek kembali email dan password Anda.']);
        } catch (ValidationException $ex) {
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Anda berhasil keluar.');
    }
}
