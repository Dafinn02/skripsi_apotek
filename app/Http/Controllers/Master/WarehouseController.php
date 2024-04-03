<?php 
namespace App\Http\Controllers\Master;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use Carbon\Carbon;
use DB;
class WarehouseController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $data = DB::table('warehouses')->get();
        return view('dashboard.master.warehouse.index',compact('data'));
    }

    public function store(Request $request)
    {
        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        DB::table('warehouses')->insert([
            'name'=>$request->name,
            'created_at'=>$createdAt,
        ]);

        return redirect()->back()->with('success','Berhasil menambahkan data');
    }

    public function update(Request $request,$id)
    {
        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        DB::table('warehouses')->where('id',$id)->update([
            'name'=>$request->name,
            'updated_at'=>$createdAt,
        ]);

        return redirect()->back()->with('success','Berhasil mengubah data');
    }

    public function delete($id)
    {
        DB::table('warehouses')->where('id',$id)->delete();
        return redirect()->back()->with('success','Berhasil menghapus data');
    }
}