<?php

namespace App\Http\Controllers\Penjualan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Auth;
use Session;
use Barryvdh\DomPDF\Facade\Pdf;
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
        $newArr = ['name', 'code','price','id','stock'];
        foreach ($arr as $i => $k) 
        {
           foreach ($newArr as $v => $u) 
           {
              if($u == 'price')
              {
                $arr[$i]->$u = number_format($arr[$i]->$u, 0, ",", ".");
              }
           }
        }
      //  dd($arr[1]);
        $now = Carbon::now('Asia/Jakarta')->format('Y-m-d');
        return view('dashboard.penjualan.kasir.create', compact('products', 'arr','now'));
    }

    public function cetak($id)
    {
        $data = json_decode(json_encode(DB::table('transactions')->where('id','=',$id)->first()),true);
        $item =  json_decode(json_encode(DB::table('transaction_items')->where('transaction_id', $id)->get()),true);
        $data['item'] = $item;
        $kasir = DB::table('users')->where('id',$data['user_id'])->first();
        $data['kasir'] = 'Kasir#'.$data['id'];
        if($kasir)
        {
            $data['kasir'] = $kasir->name;
        }
        $customPaper = array(0,0,226.771653543,368.503937008);
        $pdf = Pdf::loadView('dashboard.penjualan.kasir.pdf', compact('data'))->setPaper($customPaper,'portrait');
        return $pdf->stream();
        //return $pdf->download('Struk#'.$data['id'].'.pdf');
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
            //check stock minus
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

        foreach ($request->product_name as $checkKey3 => $checkValue3) {
            // check stok
            $qtyThin = DB::table('products')->where('id', $request->product_id[$checkKey3])->first();
            if ($qtyThin) {
                $stock = $qtyThin->stock - $request->qty[$checkKey3];
                if ($stock < $qtyThin->min_stock) {
                    return redirect()->back()->with('error', 'Mohon maaf, produk '.$qtyThin->name.' tidak dapat dijual karena stok minimal ('.$qtyThin->min_stock.').');
                }
            }
        }

        if($request->discount_type != null)
        {
            if($request->discount == null)
            {
                return redirect()->back()->with('error','Mohon maaf anda telah memilih tipe discount akan tetapi tidak menginputkan nominal discount nya');
            }else
            {
                if($request->discount_type == 'percentage')
                {
                    if(intval($request->discount) > 100)
                    {
                        return redirect()->back()->with('error','Mohon maaf anda telah memilih tipe discount percentage akan tetapi jumlah discount nya melebihi 100!');
                    }
                }
            }
        }
        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $date = Carbon::now('Asia/Jakarta')->format('Y-m-d');
        $service_cost = $request->service_cost;
        $service_cost = str_replace('.', '', $service_cost);
        $service_cost = intval($service_cost);
        $emblase_cost = $request->emblase_cost;
        $emblase_cost = str_replace('.', '', $emblase_cost);
        $emblase_cost = intval($emblase_cost);
        $shipping_cost = $request->shipping_cost;
        $shipping_cost = str_replace('.', '', $shipping_cost);
        $shipping_cost = intval($shipping_cost);
        $lainnya = $request->lainnya;
        $lainnya = str_replace('.', '', $lainnya);
        $lainnya = intval($lainnya);
        $discount = $request->discount == null ? 0 : intval(str_replace('.', '', $request->discount));

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
			$price = intval(str_replace('.', '', $request->product_price[$key]));
			$qty = intval($request->qty[$key]);
    		$subTotal = $qty * $price;
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
                'product_price'=>$price,
                'qty'=>$qty,
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

            //log
            DB::table('logs')->insert([
                'user_name' => Auth::user()->name,
                'product_name' => $request->product_name[$key].' ('.$request->product_code[$key].' )',
                'qty' => $request->qty[$key],
                'created_at' => $createdAt
            ]);
        }

        // $tmp = $grandTotal;
        // if($request->discount_type != null)
        // {
        //     if($request->discount_type == 'percentage')
        //     {
        //         $discount = $tmp * $discount / 100;
        //         $grandTotal =  $grandTotal - $discount;
        //     }else
        //     {
        //         $grandTotal =  $grandTotal - $discount;
        //     }
        // }

        DB::table('transactions')->where('id', $trId)->update(['grandtotal'=>$grandTotal,'discount' => $discount]);
        if($ses)
        {
            $temp = DB::table('transactions')->where('date',$date)->where('shift_id',$ses->shift_id)->where('user_id',Auth::user()->id)->sum('grandtotal');
            Session::put('shift-session-cash-end',$temp);
        }
        Session::put('trs-id',$trId);
        return redirect('penjualan/kasir-beli')->with('success', 'Berhasil menambahkan transaksi penjualan');
    }
}
