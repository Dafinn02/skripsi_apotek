<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanShift;
use Session;
class LaporanShiftController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
    	$get = DB::table('user_shift_sessions as uss');
    	$get->join('shifts as sh','sh.id','=','uss.shift_id');
    	$get->join('users as us','us.id','=','uss.user_id');

    	if($request->user != null)
    	{
    		$get->where('uss.user_id',$request->user);
    	}

    	if($request->shift != null)
    	{
    		$get->where('uss.shift_id',$request->shift);
    	}

    	if($request->start_date != null && $request->end_date != null)
    	{
    		$get->whereBetween('uss.date_start',[$request->start_date,$request->end_date]);
    	}

    	if($request->start_date != null && $request->end_date == null)
    	{
    		$get->where('uss.date_start',$request->start_date);
    	}

    	if($request->end_date != null && $request->start_date == null)
    	{
    		$get->where('uss.date_start',$request->end_date);
    	}

    	$get->select('uss.*','us.name as user_name','sh.name as shift_name','sh.start_time','sh.end_time');
    	$data = $get->get();
    	$data = json_decode(json_encode($data),true);
    	Session::put('laporan_shift',$data);
    	$user = DB::table('users')->where('role','cashier')->get();
    	$shift = DB::table('shifts')->where('id','!=',0)->get();
    	return view('dashboard.laporan.shift.index',compact('data','user','shift','request'));
    }

    public function export()
    {
    	return Excel::download(new LaporanShift, 'lapoaran_shift_apotek_pd_sumekar.xlsx');
    }
}