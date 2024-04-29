<?php

namespace App\Http\Controllers\Pembelian;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Auth;
class RencanaPembelianController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$data = DB::table('purchase_orders')
					->join('users', 'purchase_orders.user_id', '=', 'users.id')
					->select('purchase_orders.*', 'users.name as user_name')
                    ->orderBy('purchase_orders.created_at','DESC')
					->get();
    	$data = json_decode(json_encode($data),true);
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
    		$data[$key]['item'] = $item;
    	}

    	return view('dashboard.pembelian.rencana.index',compact('data'));
    }

    public function create()
    {
    	$suppliers = DB::table('suppliers')->get();
    	$units = DB::table('units')->get();
    	$product = DB::table('products')->get();
    	return view('dashboard.pembelian.rencana.create',compact('suppliers','units','product'));
    }

    public function store(Request $request)
    {
    	if(!$request->product_id)
    	{
    		return redirect()->back()->with('error','mohon pilih salah satu produk');
    	}
    	$createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
    	$date = Carbon::now('Asia/Jakarta')->format('Y-m-d');
    	$poId = DB::table('purchase_orders')->insertGetId([
    		'user_id'=>Auth::user()->id,
    		'number_letter'=>'PO-'.rand(),
    		'date'=> $date,
    		'payment_method'=>$request->payment_method,
    		'payment_due_date'=>$request->payment_due_date,
    		'grandtotal'=>0,
    		'information'=>$request->information,
    		'status'=>'plan',
    		'created_at'=>$createdAt
    	]);
    	$grandTotal = 0;
    	foreach ($request->product_id as $key => $value) 
    	{
    		$subtotal = $request->qty[$key] * $request->price[$key];
    		$grandTotal += $subtotal;
    		DB::table('purchase_order_items')->insert([
    			'purchase_order_id'=>$poId,
    			'supplier_id'=> $request->supplier_id[$key],
    			'product_id'=>$value,
    			'unit_id'=>$request->unit_id[$key],
    			'qty'=> $request->qty[$key],
    			'price'=> $request->price[$key],
    			'subtotal'=> $subtotal,
    			'supplier_pic'=> $request->supplier_pic[$key],
    			'created_at'=> $createdAt,
    			'updated_at'=> $createdAt
    		]);
    	}
    	DB::table('purchase_orders')->where('id',$poId)->update(['grandtotal'=>$grandTotal]);	

    	return redirect('pembelian/rencana')->with('success','Berhasil menambahkan rencana pemblian');
    }

    public function edit($id)
    {
    	$data = DB::table('purchase_orders')->where('id',$id)->first();
    	$item = DB::table('purchase_order_items')->where('purchase_order_id',$id)->get();
    	$suppliers = DB::table('suppliers')->get();
    	$units = DB::table('units')->get();
    	$product = DB::table('products')->get();

    	return view('dashboard.pembelian.rencana.edit',compact('data','item','suppliers','units','product'));
    }

    public function update(Request $request ,$id)
    {
    	if(!$request->product_id)
    	{
    		return redirect()->back()->with('error','mohon pilih salah satu produk');
    	}
    	$updatedAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
    	DB::table('purchase_order_items')->where('purchase_order_id',$id)->delete();
    	$grandTotal = 0;
    	foreach ($request->product_id as $key => $value) 
    	{
    		$subtotal = $request->qty[$key] * $request->price[$key];
    		$grandTotal += $subtotal;
    		DB::table('purchase_order_items')->insertGetId([
    			'purchase_order_id'=>$id,
    			'supplier_id'=> $request->supplier_id[$key],
    			'product_id'=>$value,
    			'unit_id'=>$request->unit_id[$key],
    			'qty'=> $request->qty[$key],
    			'price'=> $request->price[$key],
    			'subtotal'=> $subtotal,
    			'supplier_pic'=> $request->supplier_pic[$key],
    			'created_at'=> $updatedAt,
    			'updated_at'=> $updatedAt
    		]);
    	}
    	DB::table('purchase_orders')->where('id',$id)->update([
    		'grandtotal'=>$grandTotal,
    		'payment_method'=>$request->payment_method,
    		'payment_due_date'=>$request->payment_due_date,
    		'information'=>$request->information,
    		'updated_at'=> $updatedAt,
    	]);
        return redirect('pembelian/rencana')->with('success','Berhasil mengubah rencana pemblian');
    }

    public function delete($id)
    {
        DB::table('purchase_orders')->where('id',$id)->delete();
    	return redirect('pembelian/rencana')->with('success','Berhasil menghapus rencana pemblian');
    }

    public function upToOrder(Request $request,$id)
    {
    	$updatedAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
    	$proof = $this->uploadFile($request,'proof');
    	DB::table('purchase_orders')->where('id',$id)->update([
    		'status'=> 'order',
    		'proof'=> $proof,
    		'updated_at' => $updatedAt
    	]);
    	return redirect('pembelian/pesanan')->with('success','Berhasil membuat pesanan pembelian');
    }

    public function uploadFile(Request $request, $oke)
    {
        $result = '';
        $file = $request->file($oke);
        $name = $file->getClientOriginalName();
        $extension = explode('.', $name);
        $extension = strtolower(end($extension));
        $key = rand() . '_' . $oke . '_table';
        $tmp_file_name = "{$key}.{$extension}";
        $tmp_file_path = "dist/img/bukti";
        $file->move($tmp_file_path, $tmp_file_name);
        $result = $tmp_file_name;
        return $result;
    }
}