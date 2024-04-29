<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class ShiftController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $data = DB::table('shifts')->where('id','!=',0)->get();
        return view('dashboard.pengguna.shift.index',compact('data'));
    }

    public function store(Request $request)
    {
        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        DB::table('shifts')->insert([
            'name'=>$request->name,
            'start_time'=>$request->start_time,
            'end_time'=>$request->end_time,
            'created_at'=>$createdAt,
        ]);

        return redirect()->back()->with('success','Berhasil menambahkan data');
    }

    public function update(Request $request,$id)
    {
        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        DB::table('shifts')->where('id',$id)->update([
            'name'=>$request->name,
            'start_time'=>$request->start_time,
            'end_time'=>$request->end_time,
            'updated_at'=>$createdAt,
        ]);

        return redirect()->back()->with('success','Berhasil mengubah data');
    }

    public function delete($id)
    {
        DB::table('shifts')->where('id',$id)->delete();
        return redirect()->back()->with('success','Berhasil menghapus data');
    }
}