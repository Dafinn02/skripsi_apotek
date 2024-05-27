<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Auth;
use Session;
class StockOpnameController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$get = DB::table('opname as ope');
    	$get->join('products as pd','pd.id','=','ope.product_id');
        $get->join('warehouses as whs','whs.id','=','ope.warehouse_id');
    	$get->join('racks as racks','racks.id','=','ope.rack_id');
        $get->join('users as us','us.id','=','ope.user_id');
    	$get->select('pd.name as product_name','pd.code as product_code','ope.id'
    				,'ope.qty','ope.type','us.name as pic','ope.created_at','ope.info'
    				,'ope.kadaluarsa','whs.name as warehouse_name','racks.name as rack_name');
    	$data = $get->get();
    	$data = json_decode(json_encode($data),true);
		// return response()->json($data);
    	$products = DB::table('products')->get();
    	$warehouses = DB::table('warehouses')->get();
    	$racks = DB::table('racks')->get();
    	return view('dashboard.persediaan.stock_opname', compact('data','warehouses','racks','products'));
    }

    public function store(Request $request)
    {
		$kadaluarsa = $request->has('kadaluarsa') ? 1 : 0;
    	$date = Carbon::now('Asia/Jakarta')->format('Y-m-d');
    	$dateTime = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
    	DB::table('opname')->insert([
    		'product_id'=> $request->product_id,
    		'warehouse_id'=> $request->warehouse_id,
    		'rack_id'=> $request->rack_id,
    		'user_id'=> Auth::user()->id,
    		'qty' => $request->qty,
    		'type' => $request->type,
    		'date'=> $date,
			'kadaluarsa'=> $kadaluarsa,
            'info'=>$request->info,
    		'created_at' => $dateTime
    	]);

    	$qty = $request->qty;
    	if($request->type == 'addition')
    	{
    		$product = DB::table('products')->where('id',$request->product_id)->select('stock')->first();
    		if($product)
    		{
    			$stock = $product->stock;
    			$stock += $qty;
    			DB::table('products')->where('id',$request->product_id)->update(['stock'=>$stock]);
    		}
    	}else
    	{
    		$product = DB::table('products')->where('id',$request->product_id)->select('stock')->first();
    		if($product)
    		{
    			$stock = $product->stock;
    			$stock -= $qty;
    			DB::table('products')->where('id',$request->product_id)->update(['stock'=>$stock]);
    		}
    	}
    	return redirect()->back()->with('success','Berhasil menambahkan data');
    }

    public function delete($id)
    {
    	$data = DB::table('opname')->where('id',$id)->first();
    	if($data)
    	{
    		$qty = $data->qty;
    		if($data->type == 'addition')
    		{
    			$product = DB::table('products')->where('id',$data->product_id)->select('stock')->first();
	    		if($product)
	    		{
	    			$stock = $product->stock;
	    			$stock -= $qty;
	    			DB::table('products')->where('id',$data->product_id)->update(['stock'=>$stock]);
	    		}
    		}else
    		{
    			$product = DB::table('products')->where('id',$data->product_id)->select('stock')->first();
	    		if($product)
	    		{
	    			$stock = $product->stock;
	    			$stock += $qty;
	    			DB::table('products')->where('id',$data->product_id)->update(['stock'=>$stock]);
	    		}
    		}
    		DB::table('opname')->where('id',$id)->delete();
    		return redirect()->back()->with('success','Berhasil menghapus data');
    	}
    	return redirect()->back()->with('error','Gagal menghapus data');
    }
}