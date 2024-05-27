<?php

namespace App\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Auth;
use Maatwebsite\Excel\Facades\Excel;
// use App\Exports\LaporanPembelian;
use Session;
class LaporanPersediaanController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

    	$stockMasuk = DB::table('warehouse_rack_products');
    	if($request->start_date != null)
    	{
    		$start = $request->start_date.' 00:00:00';
    		$end = $request->end_date.' 23:59:59';
    		$stockMasuk->whereBetween('created_at',[$start,$end]);
    	}
    	$masuk = $stockMasuk->sum('qty');

    	$stockKeluar = DB::table('transaction_items');
    	if($request->start_date != null)
    	{
    		$start = $request->start_date.' 00:00:00';
    		$end = $request->end_date.' 23:59:59';
    		$stockKeluar->whereBetween('created_at',[$start,$end]);
    	}
    	$keluar = $stockKeluar->sum('qty');

    	$now = Carbon::now('Asia/Jakarta')->format('Y-m-d');
    	 $itemOnWareHouse = DB::table('warehouse_rack_products')
                            ->select('kadaluarsa','id')
                            ->get();
        $kadaluarsa = 0;
        foreach ($itemOnWareHouse as $key => $value) 
        {
            $kadal = Carbon::parse($value->kadaluarsa);
            $check = $kadal->diffInDays($now);
            if($check <= 5)
            {
                $kadaluarsa++;
            }
        }

        return view('dashboard.laporan.persediaan.index',compact('masuk','keluar','kadaluarsa','request'));
    }
}