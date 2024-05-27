<?php

namespace App\Http\Controllers\Persediaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class StockKadaluarsaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $get = DB::table('opname as op')->where('op.kadaluarsa', 1);

        if($request->produk != null)
        {
            $get->where('op.product_id',$request->produk);
        }

        if($request->warehouse != null)
        {
            $get->where('op.warehouse_id',$request->warehouse);
        }

        if($request->rack != null)
        {
            $get->where('op.rack_id',$request->rack);
        }

        if($request->kadaluarsa != null)
        {
            $get->where('op.date',$request->kadaluarsa);
        }

        $get->join('products as pd', 'op.product_id', '=', 'pd.id');
        $get->join('warehouses as wh', 'op.warehouse_id', '=', 'wh.id');
        $get->join('racks as rk', 'op.rack_id', '=', 'rk.id');
        $get->select('op.*', 'pd.name as product_name', 'wh.name as warehouse_name', 'rk.name as rack_name');
        $data = $get->get();
        // return response()->json($data);
        $products =  DB::table('products')->get();
        $warehouses = DB::table('warehouses')->get();
        $racks = DB::table('racks')->get();
        return view('dashboard.persediaan.stock_kadaluarsa', compact('data', 'products', 'warehouses', 'racks', 'request'));
    }
}
