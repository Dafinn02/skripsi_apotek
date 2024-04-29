<?php

namespace App\Http\Controllers\Penjualan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Auth;
use Session;
class KasirController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = DB::table('products')->select('name', 'code','price','id','stock')->get();
        $arr = [];
        foreach($products as $key => $value) {
            $arr[$key+1] = $value;
        }
        $now = Carbon::now('Asia/Jakarta')->format('Y-m-d');
        return view('dashboard.penjualan.kasir.create', compact('products', 'arr','now'));
    }

    public function store(Request $request)
    {
        if(!$request->filled('product_name'))
        {
            return redirect()->back()->with('error','mohon pilih salah satu produk');
        }

        foreach ($request->product_name as $checkKey => $checkValue) 
        {
            $checkQty = DB::table('products')->where('id',$request->product_id[$checkKey])->first();
            if($checkQty)
            {
                //check stock
                if($checkQty->stock <= 0)
                {
                    return redirect()->back()->with('error','Mohon maaf untuk produk '.$checkQty->name.' stock nya masih 0, silahkan melakukan distribusi ke gudang di menu pembelian - pesanan jika sudah melakukan pembelian product tersebut !');
                }
            }
        }

        foreach ($request->product_name as $checkKey1 => $checkValue1) 
        {
            //check qty minus
            $qtyExist = DB::table('products')->where('id',$request->product_id[$checkKey1])->first();
            if($qtyExist)
            {
                $stock = $request->qty[$checkKey1];
                if($stock <= 0)
                {
                    return redirect()->back()->with('error','Mohon maaf untuk produk '.$qtyExist->name.' kuantiti yang anda inputkan sebesar '.$request->qty[$checkKey1].' mohon ganti kuantiti nya karena akan merusak stock!');
                }
            }
        }

        foreach ($request->product_name as $checkKey2 => $checkValue2) 
        {
            //check stoack minus
            $qtyExist = DB::table('products')->where('id',$request->product_id[$checkKey2])->first();
            if($qtyExist)
            {
                $stock = $qtyExist->stock - $request->qty[$checkKey2];
                if($stock < 0)
                {
                    return redirect()->back()->with('error','Mohon maaf untuk produk '.$qtyExist->name.' stock akan mengalami minus karena kuantiti yang anda inputkan sebesar '.$request->qty[$checkKey2].' mohon ganti kuantiti nya!');
                }
            }
        }
        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $date = Carbon::now('Asia/Jakarta')->format('Y-m-d');
        $service_cost = $request->service_cost;
        $emblase_cost = $request->emblase_cost;
        $shipping_cost = $request->shipping_cost;
        $lainnya = $request->lainnya;
        $discount = $request->discount == null ? 0 : $request->discount ;
        $result = [];
        $userSessionShiftId = Session::get('shift-session-id');
        $ses = DB::table('user_shift_sessions')->where('id',$userSessionShiftId)->first();
        //dd($ses);
        $shift_id = 0;
        if($ses)
        {
            $shift_id = $ses->shift_id;
        }
        $trId = DB::table('transactions')->insertGetId([
            'user_id'=> Auth::user()->id,
            'shift_id'=>$shift_id,
            'date'=>$date,
            'customer_name'=>$request->customer_name,
            'customer_phone'=>$request->customer_phone,
            'service_cost'=>$service_cost == null ? 0 : $service_cost,
            'emblase_cost'=>$emblase_cost == null ? 0 : $emblase_cost,
            'shipping_cost'=>$shipping_cost == null ? 0 : $shipping_cost,
            'lainnya'=>$lainnya == null ? 0 : $lainnya,
            'discount_type'=>$request->discount_type,
            'discount'=>$discount,
            'grandtotal'=>0,
            'created_at'=> $createdAt
        ]);
        $grandTotal = 0;
        $total = $service_cost + $emblase_cost + $shipping_cost + $lainnya;
        foreach ($request->product_name as $key => $value) {
            $subTotal = $request->qty[$key] * $request->product_price[$key];
            $total += $subTotal; 
            if($request->discount_type == 'percentage') { 
                $total = $total - ($total * $discount / 100);
            }
            elseif($request->discount_type == 'fix_price') {
                $total = $total - $discount;
            }
            $grandTotal = $total;
            DB::table('transaction_items')->insert([
                'transaction_id'=>$trId,
                'product_name'=>$request->product_name[$key],
                'product_code'=>$request->product_code[$key],
                'product_price'=>$request->product_price[$key],
                'qty'=>$request->qty[$key],
                'created_at'=>$createdAt,
                'updated_at'=>$createdAt
            ]);

            //update stock
            $qtyExist = DB::table('products')->where('id',$request->product_id[$key])->first();
            if($qtyExist)
            {
                $stock = $qtyExist->stock - $request->qty[$key];
                DB::table('products')->where('id',$request->product_id[$key])->update(['stock'=>$stock]);
            }
        }
        DB::table('transactions')->where('id', $trId)->update(['grandtotal'=>$grandTotal]);
        if($ses)
        {
            $temp = DB::table('transactions')->where('date',$date)->where('shift_id',$ses->shift_id)->where('user_id',Auth::user()->id)->sum('grandtotal');
            Session::put('shift-session-cash-end',$temp);
        }
        return redirect('penjualan/kasir-beli')->with('success', 'Berhasil menambahkan transaksi penjualan');
    }
}
