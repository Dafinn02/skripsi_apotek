<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanPenjualan;
use Session;
class LaporanPenjualanController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
    	$get = DB::table('transaction_items as trsi');
    	$get->join('transactions as trs','trs.id','=','trsi.transaction_id');
    	$get->join('users as us','us.id','=','trs.user_id');

    	if($request->produk != null)
    	{
    		$get->where('trsi.product_name', 'like', $request->produk.'%');
    	}

    	if($request->customer_name != null)
    	{
    		$get->where('trs.customer_name', 'like', $request->customer_name.'%');
    	}

    	if($request->customer_phone != null)
    	{
    		$get->where('trs.customer_phone', 'like', $request->customer_phone.'%');
    	}

    	if($request->shift != null)
    	{
    		$get->where('trs.shift_id', '=', $request->shift);
    	}

    	if($request->user != null)
    	{
    		$get->where('trs.user_id', '=', $request->user);
    	}

    	if($request->start_date != null && $request->end_date != null)
    	{
    		$get->whereBetween('trs.date',[$request->start_date,$request->end_date]);
    	}

    	if($request->start_date != null && $request->end_date == null)
    	{
    		$get->where('trs.date',$request->start_date);
    	}

    	if($request->end_date != null && $request->start_date == null)
    	{
    		$get->where('trs.date',$request->end_date);
    	}

    	$get->select('trsi.*','us.name as pic');
        $get->orderBy('trsi.created_at','DESC');
    	$data = $get->get();
    	$data = json_decode(json_encode($data),true);
    	Session::put('laporan_penjualan',$data);
    	$user = DB::table('users')->where('role','!=','head_office')->get();
    	$shift = DB::table('shifts')->get();
    	return view('dashboard.laporan.penjualan.index',compact('data','user','shift','request'));
    }

    public function export()
    {
    	return Excel::download(new LaporanPenjualan, 'lapoaran_penjualan_apotek_pd_sumekar.xlsx');
    }
}