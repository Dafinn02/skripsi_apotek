<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Auth;
use Session;
class StockMasukController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
    	$get = DB::table('warehouse_rack_products as wrp');
    	$get->join('products as pd','pd.id','=','wrp.product_id');
        $get->join('warehouses as whs','whs.id','=','wrp.warehouse_id');
    	$get->join('racks as racks','racks.id','=','wrp.rack_id');
    	$get->join('purchase_order_items as poi','poi.id','=','wrp.purchase_order_item_id');
    	$get->join('purchase_orders as po','po.id','=','poi.purchase_order_id');
        $get->join('users as us','us.id','=','po.user_id');

		if($request->produk != null)
        {
			$get->where('wrp.product_id',$request->produk);
        }

        if($request->warehouse != null)
        {
			$get->where('wrp.warehouse_id',$request->warehouse);
        }

        if($request->rack != null)
        {
			$get->where('wrp.rack_id',$request->rack);
        }

		if($request->kadaluarsa)
		{
			$get->where('wrp.kadaluarsa',$request->kadaluarsa);
		}

    	$get->select('pd.name as product_name','pd.code as product_code','wrp.kadaluarsa','wrp.created_at'
    					,'wrp.qty','whs.name as warehouse_name','racks.name as rack_name'
    					,'poi.purchase_order_id','po.number_letter','us.name as pic');
    	$data = $get->get();
		// return response()->json($data);
    	$data = json_decode(json_encode($data),true);
		$products =  DB::table('products')->get();
    	$warehouses = DB::table('warehouses')->get();
    	$racks = DB::table('racks')->get();
    	return view('dashboard.persediaan.stock_masuk', compact('data','products','warehouses','racks','request'));
    }
}