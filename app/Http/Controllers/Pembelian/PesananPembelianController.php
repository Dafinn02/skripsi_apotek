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

    public function index(Request $request)
    {
    	$get = DB::table('purchase_orders');
        $get->join('users', 'purchase_orders.user_id', '=', 'users.id');
        $get->where('purchase_orders.status', 'order');
        if($request->number_letter != null)
        {
            $get->where('number_letter',$request->number_letter);
        }
        $get->select('purchase_orders.*', 'users.name as user_name');
        $get->orderBy('purchase_orders.created_at','DESC');
        $get->get();
        $data = $get->get();
    	$data = json_decode(json_encode($data),true);
        // return response()->json($data);
    	foreach ($data as $key => $value) 
    	{
    		$item = DB::table('purchase_order_items as poi')
                    ->join('products as pd','pd.id','=','poi.product_id')
                    ->join('suppliers as sp','sp.id','=','poi.supplier_id')
                    ->join('units as un','un.id','=','poi.unit_id')
                    ->where('purchase_order_id',$value['id'])
                    ->select('poi.*','pd.name as product_name', 'sp.name as supplier_name', 'un.name as unit_name')
                    ->get();
            $item = json_decode(json_encode($item),true);
            // return response()->json($item);
            foreach ($item as $iKey => $iValue) 
            {
                // return response()->json($iValue);
                $checkDistribution = DB::table('warehouse_rack_products')->where('purchase_order_item_id',$iValue['id'])->first();
                if($checkDistribution)
                {
                    $item[$iKey]['distribution_date'] = $checkDistribution->created_at;
                    $gudang = DB::table('warehouses')->where('id',$checkDistribution->warehouse_id)->first();
                    $item[$iKey]['gudang'] = $gudang->name;
                    $rak = DB::table('racks')->where('id',$checkDistribution->rack_id)->first();
                    $item[$iKey]['rak'] = $rak->name;
                }
            }
            $data[$key]['item'] = $item;
    	}
        // return response()->json($data);
        $gudang = DB::table('warehouses')->get();
        $rak = DB::table('racks')->get();
    	return view('dashboard.pembelian.pesanan.index',compact('data','gudang','rak'));
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
        return response()->json($item);
        return view('pembelian.pesanan.distribution',compact('data','item'));
    }

    public function transferToWarehouse(Request $request)
    {
        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');

        DB::table('warehouse_rack_products')->insert([
            'purchase_order_item_id'=>$request->purchase_order_item_id,
            'warehouse_id'=> $request->warehouse_id,
            'rack_id'=>$request->rack_id,
            'product_id'=>$request->product_id,
            'qty'=>$request->qty,
            'kadaluarsa'=>$request->kadaluarsa,
            'created_at'=>$createdAt
        ]);

        DB::table('purchase_orders')->where('id',$request->purchase_order_id)->update(['distribution'=>1]);
        DB::table('purchase_order_items')
            ->where('id',$request->purchase_order_item_id)
            ->update(['distribution'=>1]);

        //update stock
        $qtyExist = DB::table('products')->where('id',$request->product_id)->first();
        if($qtyExist)
        {
            $stock = $request->qty + $qtyExist->stock;
            DB::table('products')->where('id',$request->product_id)->update(['stock'=>$stock]);
        }
        return redirect()->back()->with('success','Berhasil mendsitribusikan produk ke gudang');
    }
}