<?php 
namespace App\Http\Controllers\System;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use DB;
class RoleController extends Controller
{
	public function __construct()
    {
        $this->middleware('validate_user_first');
    }
	public function index()
	{
		$data = DB::table('roles')->where('id','!=',0)->get();
		$path = Session::get('resultPath');
		return view('dashboard.system.role.index',compact('data','path'));
	}

	public function update(Request $request,$id)
	{
		$createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
		$update = DB::table('roles')->where('id',$id)->update([
			'name'=>$request->name,
			'route'=>$request->route,
			'updated_at'=>$createdAt
		]);

		if(!$update){
			return redirect()->back()->with('error','Gagal melakukan update data');
		}
		return redirect()->back()->with('success','Berhasil melakukan update data');
	}
}