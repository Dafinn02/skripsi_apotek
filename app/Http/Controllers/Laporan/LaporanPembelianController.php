<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanPembelian;
use Session;
class LaporanPembelianController extends Controller
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

        if($request->user != null)
        {
        	$get->where('po.user_id',$request->rack);
        }

        if($request->supplier != null)
        {
        	$get->where('poi.supplier_id',$request->supplier);
        }

        if($request->payment != null)
        {
        	$get->where('po.payment_method',$request->payment);
        }

        if($request->start_date != null && $request->end_date != null)
    	{
    		$get->whereBetween('po.date',[$request->start_date,$request->end_date]);
    	}

    	if($request->start_date != null && $request->end_date == null)
    	{
    		$get->where('po.date',$request->start_date);
    	}

    	if($request->end_date != null && $request->start_date == null)
    	{
    		$get->where('po.date',$request->end_date);
    	}

    	$get->select('pd.name as product_name','pd.code as product_code','wrp.created_at'
    					,'wrp.qty','whs.name as warehouse_name','racks.name as rack_name'
    					,'poi.purchase_order_id','po.number_letter','us.name as pic');
    	$data = $get->get();
    	$data = json_decode(json_encode($data),true);
    	Session::put('laporan_pembelian',$data);
    	$products =  DB::table('products')->get();
    	$warehouses = DB::table('warehouses')->get();
    	$racks = DB::table('racks')->get();
    	$users = DB::table('users')->where('role','admin')->get();
    	$suppliers  = DB::table('suppliers')->get();
    	return view('dashboard.laporan.pembelian.index',
    		   compact('data','products','warehouses','racks','users','suppliers','request'));
    }

    public function export()
    {
    	return Excel::download(new LaporanPembelian, 'lapoaran_pembelian_apotek_pd_sumekar.xlsx');
    }
}