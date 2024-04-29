<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use DB;
use Carbon\Carbon;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //Session::put('shift-session-cash-end',80000);
        //dd(Session::get('shift-session-cash-end'));
        if(Auth::user()->role == 'cashier')
        {
            if(Session::get('shift-session-name') == null)
            {
                //dd('iyo1');
                $dateNow = Carbon::now('Asia/Jakarta')->format('Y-m-d');
                $check = DB::table('user_shift_sessions')->where('date_start',$dateNow)->where('status','active')->first();
                if($check)
                {
                    //dd('iyo2');
                    if($check->user_id == Auth::user()->id)
                    {
                        //return redirect('logout');
                        //dd(Auth::user()->id);
                        $shift = DB::table('shifts')->where('id',$check->shift_id)->first();
                        if($shift)
                        {
                            Session::put('shift-session-name',$shift->name);
                            Session::put('shift-session-open',$check->open);
                            Session::put('shift-session-cash-in',$check->cash_in_hand);
                            Session::put('shift-session-cash-end',$check->end_cash);
                            Session::put('shift-session-id',$check->id);
                            //dd(Session::get('shift-session-cash-end'));
                        }
                        return redirect('penjualan/transaksi');
                    }
                    return redirect('current-active-shift'); 
                }
                return redirect('start-shift');
            }
            //dd(Session::get('shift-session-cash-end'));
            return redirect('penjualan/transaksi');
        }
        $produk = DB::table('products')->count();
        $penjualan = DB::table('transactions')->count();
        $pembelian = DB::table('purchase_orders')->count();
        $pelanggan = DB::table('transactions')->groupBy('customer_name','customer_phone')->count();
        $supplier = DB::table('suppliers')->count();
        return view('dashboard.dashboard',compact('produk','penjualan','pembelian','pelanggan','supplier'));
    }

    public function startShift()
    {
        if(Auth::user()->role == 'cashier')
        {
            $data = DB::table('shifts')->where('id','!=',0)->get();
            $timeNow = Carbon::now('Asia/Jakarta')->format('H:i:s');
            return view('dashboard.start-shift',compact('data','timeNow'));
        }
        return redirect()->back();
    }

    public function endShift()
    {
        if(Auth::user()->role == 'cashier')
        {
            $data = DB::table('shifts')->where('id','!=',0)->get();
            $timeNow = Carbon::now('Asia/Jakarta')->format('H:i:s');
            $userSessionShiftId = Session::get('shift-session-id');
            $ses = DB::table('user_shift_sessions')->where('id',$userSessionShiftId)->first();
            if($ses)
            {
                $shift = DB::table('shifts')->where('id',$ses->shift_id)->first();
                if($shift)
                {
                    return view('dashboard.end-shift',compact('data','timeNow','shift'));
                }
                return redirect()->back();
            }
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function currentShift()
    {
        if(Auth::user()->role == 'cashier')
        {
            $dateNow = Carbon::now('Asia/Jakarta')->format('Y-m-d');
            $check = DB::table('user_shift_sessions')->where('date_start',$dateNow)->where('status','active')->first();
            if($check)
            {
                $data = DB::table('users')->where('id',$check->user_id)->first();
                if($data)
                {
                    $shift = DB::table('shifts')->where('id',$check->shift_id)->first();
                    if($shift)
                    {
                        return view('dashboard.current-active-shift',compact('data','shift'));
                    }
                    return redirect()->back();
                }
                return redirect()->back();
            }
            return redirect()->back();
        }
        return redirect()->back();
    }

    public function openShift(Request $request)
    {
        $userId = Auth::user()->id;
        $shiftId = $request->shift_id;
        $cash_in_hand = $request->cash_in_hand;
        $open = $request->open;
        $dateNow = Carbon::now('Asia/Jakarta')->format('Y-m-d');
        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d h:i:s');
        $userSessionShiftId = DB::table('user_shift_sessions')->insertGetId([
            'user_id'=>$userId,
            'shift_id'=>$shiftId,
            'date_start'=> $dateNow,
            'start'=> $open,
            'cash_in_hand'=> $cash_in_hand,
            'end_cash' => 0,
            'status' => 'active',
            'created_at' => $createdAt
        ]);
        $shift = DB::table('shifts')->where('id',$request->shift_id)->first();
        if($shift)
        {
            Session::put('shift-session-name',$shift->name);
            Session::put('shift-session-open',$open);
            Session::put('shift-session-cash-in',$cash_in_hand);
            Session::put('shift-session-cash-end',0);
            Session::put('shift-session-id',$userSessionShiftId);
        }

        return redirect('penjualan/transaksi')->with('success','Pembukaan shift berhasil selamat berkerja '.Auth::user()->name.' ');
    }

    public function closeShift(Request $request)
    {
        $end = $request->close;
        $end_cash = $request->end_cash;
        $dateNow = Carbon::now('Asia/Jakarta')->format('Y-m-d');
        $updatedAt = Carbon::now('Asia/Jakarta')->format('Y-m-d h:i:s');
        $userSessionShiftId = Session::get('shift-session-id');
        DB::table('user_shift_sessions')->where('id',$userSessionShiftId)->update([
            'end_cash' => $end_cash,
            'date_end' => $dateNow,
            'end' => $end,
            'status' => 'deactive',
            'updated_at' => $updatedAt
        ]);

        return redirect('logout');
    }
}
