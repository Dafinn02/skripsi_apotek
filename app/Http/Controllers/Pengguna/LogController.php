<?php

namespace App\Http\Controllers\Pengguna;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class LogController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

     public function index()
    {
        $data = DB::table('logs')->get();

        return view('dashboard.pengguna.log.index', compact('data'));
    }
}