<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $data = Auth::user();

        return view('dashboard.profile.index', compact('data'));
    }

    public function uploadFoto(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $user = Auth::user();
        $foto = $request->file('profile_image');
        $foto_name = time() . '.' . $foto->getClientOriginalExtension();
        $foto->move(public_path('storage/public/uploads/foto'), $foto_name);

        $user->foto = $foto_name;
        $user->save();

        return redirect()->back()->with('success', 'Foto berhasil diupload');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = DB::table('users')->where('id', Auth::user()->id)->first();

        if(Hash::check($request->old_password, $user->password)){
            $new_password = Hash::make($request->password);
            DB::table('users')->where('id', Auth::user()->id)->update(['password' => $new_password]);

            session()->flash('success', 'Password berhasil diubah, silahkan login kembali');
            Auth::logout();
            return redirect('/login');
        }else{
            return redirect()->back()->with('error', 'Password lama tidak sesuai');
        }
    }
}
