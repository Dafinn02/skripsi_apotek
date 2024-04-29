<?php

namespace App\Http\Controllers\Penjualan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Auth;
use Session;
class PelangganController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$get = DB::table('transactions')->select('customer_name','customer_phone')->groupBy('customer_phone','customer_name')->get();
    	$data = json_decode(json_encode($get),true);
    	foreach ($data as $key => $value) 
    	{
    		$total = DB::table('transactions')
    					->where('customer_name',$value['customer_name'])
    					->where('customer_phone',$value['customer_phone'])
    					->count();
    		$data[$key]['total'] = $total;
    	}
    	return view('dashboard.penjualan.pelanggan.index', compact('data'));
    }
}