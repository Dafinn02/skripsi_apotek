<?php

namespace App\Http\Controllers\Penjualan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Session;
class TransaksiController extends Controller
{

    public function index(Request $request)
    {
    	$now = Carbon::now('Asia/Jakarta')->format('Y-m-d');
        $shift_id = 0;
        if($request->session_trs_shift != null)
        {
            $userSessionShiftId = Session::get('shift-session-id');
            $ses = DB::table('user_shift_sessions')->where('id',$userSessionShiftId)->first();
            if($ses)
            {
                $shift_id = $ses->shift_id;
            }
            $data = json_decode(json_encode(DB::table('transactions')->where('date','=',$now)->where('shift_id',$shift_id)->orderBy('created_at','DESC')->get()),true);
        }else
        {
            if($request->transaction_id != null)
            {
                $data = json_decode(json_encode(DB::table('transactions')->where('id',$request->transaction_id)->orderBy('created_at','DESC')->get()),true);
            }else
            {
                $data = json_decode(json_encode(DB::table('transactions')->where('date','=',$now)->orderBy('created_at','DESC')->get()),true);
            }
        }
        foreach($data as $key => $value) {
            $item = DB::table('transaction_items')->where('transaction_id', $value['id'])->get();
            $data[$key]['item'] = json_decode(json_encode($item),true);
            $data[$key]['kasir'] = '-';
           // if($value['shift_id'] == 0)
            //{
                $check = DB::table('shifts')->where('id',$value['shift_id'])->first();
                if($check)
                {
                    if($check->id == 0)
                    {
                        $data[$key]['kasir'] = $check->name;
                        $user = DB::table('users')->where('id',$value['user_id'])->first();
                        if($user)
                        {
                            $data[$key]['kasir'] .= '<br> '.$user->name.' <br> (Shift : '.$check->name.')';
                        }
                    }else
                    {
                        $user = DB::table('users')->where('id',$value['user_id'])->first();
                        if($user)
                        {
                            $data[$key]['kasir'] = '<br> '.$user->name.' <br> (Shift : '.$check->name.')';
                        }
                    }
                }
            
        }

        return view('dashboard.penjualan.transaksi.index', compact('data','now','shift_id'));
    }
}
