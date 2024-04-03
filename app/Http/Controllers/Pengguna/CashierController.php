<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class CashierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data = DB::table('cashiers')->get();

        return view('dashboard.pengguna.cashier.index', compact('data'));
    }

    public function store(Request $request)
    {
        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $check = DB::table('users')->where('username',$request->number)->first();
        if($check)
        {
            return redirect()->back()->with('error','number '.$request->number.' sudah digunakan kasir lain, mohon isi kode yang belum digunakan oleh kasir lain');
        }
        $userId = DB::table('users')->insertGetId([
            'username'=> $request->number,
            'password'=> bcrypt($request->number),
            'name'=>$request->name,
            'role'=>'cashier',
            'created_at'=>$createdAt
        ]);
        DB::table('cashiers')->insert([
            'user_id' => $userId,
            'number' => $request->number,
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'created_at' => $createdAt,
        ]);

        return redirect()->back()->with('success', 'Berhasil menambahkan data');
    }

    public function update(Request $request, $id)
    {
        $updatedAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $check = DB::table('users')->where('username',$request->number)->first();
        if($check)
        {
            if($check->id != $id)
            {
                return redirect()->back()->with('error','number '.$request->number.' sudah digunakan kasir lain, mohon isi kode yang belum digunakan oleh kasir lain');
            }
        }
        DB::table('users')->where('username',$request->number)->update([
            'name'=>$request->name,
            'updated_at'=>$updatedAt
        ]);
        DB::table('cashiers')->where('id', $id)->update([
            'number' => $request->number,
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'updated_at' => $updatedAt,
        ]);

        return redirect()->back()->with('success', 'Berhasil mengubah data');
    }

    public function delete($id)
    {
        DB::table('cashiers')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}
