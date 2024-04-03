<?php

namespace App\Http\Controllers\Pembelian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Auth;
class PesananPembelianController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$data = DB::table('purchase_orders')->where('status','order')->get();
    	$data = json_decode(json_encode($data),true);
    	foreach ($data as $key => $value) 
    	{
    		$item = DB::table('purchase_order_items as poi')
    				->join('products as pd','pd.id','=','poi.product_id')
    				->where('purchase_order_id',$value->id)
    				->select('poi.*','pd.name as product_name')
    				->get();
    		$item = json_decode(json_encode($item),true);
    		$data[$key]['item'] = $item;
    	}

    	return view('pembelian.pesanan.index',compact('data'));
    }

    public function distribution($id)
    {
        $data = DB::table('purchase_orders')->where('id',$id)->first();
        $item = DB::table('purchase_order_items as poi')
                ->join('suppliers as sp','sp.id','=','poi.supplier_id')
                ->join('units as un','un.id','=','poi.unit_id')
                ->join('products as pd','pd.id','=','poi.product_id')
                ->where('poi.purchase_order_id',$id)
                ->select('poi.*','sp.name as supplier_name','un.name as unit_name','pd.name as product_name')
                ->get();
        return view('pembelian.pesanan.distribution',compact('data','item'));
    }

    public function transferToWarehouse(Request $request)
    {
        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');

        $product_id = array_unique($request->product_id);
        foreach ($product_id as $key => $value) 
        {
           $qty = DB::table('purchase_order_items')
                ->where('purchase_order_id',$request->purchase_order_id)
                ->where('product_id',$value)
                ->sum('qty');

            DB::table('warehouse_rack_products')->insert([
                'purchase_order_id'=>$request->purchase_order_id,
                'warehouse_id'=> $request->warehouse_id,
                'rack_id'=>$request->rack_id,
                'product_id'=>$value,
                'qty'=>$qty,
                'created_at'=>$createdAt
            ]);

            DB::table('purchase_order_items')
                ->where('purchase_order_id',$request->purchase_order_id)
                ->where('product_id',$value)
                ->update(['distribution'=>true]);
        }
        
        $check = DB::table('purchase_order_items')
                    ->where('purchase_order_id',$request->purchase_order_id)
                    ->where('distribution',false)
                    ->count();
        if($check > 0)
        {
            DB::table('purchase_orders')->where('id',$request->purchase_order_id)->update(['distribution'=>true]);
        }

        return redirect()->back()->with('success','Berhasil mendsitribusikan produk');
    }
}