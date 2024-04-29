<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Auth;
use Session;
class StockKeluarController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$get = DB::table('transaction_items as trsi');
    	$get->join('transactions as trs','trs.id','=','trsi.transaction_id');
    	$get->join('users as us','us.id','=','trs.user_id');
    	$get->select('trsi.*','us.name as pic');
        $get->orderBy('trsi.created_at','DESC');
    	$data = $get->get();
    	$data = json_decode(json_encode($data),true);
    	return view('dashboard.persediaan.stock_keluar', compact('data'));
    }
}