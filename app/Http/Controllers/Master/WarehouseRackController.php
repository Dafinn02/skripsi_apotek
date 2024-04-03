<?php 
namespace App\Http\Controllers\Master;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use Carbon\Carbon;
use DB;
class WarehouseRackController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        $warehouse = DB::table('warehouses')->where('id',$id)->first();
        $rack = DB::table('racks')->get();
        $data = DB::table('warehouse_racks as wr')
                ->join('racks as r','r.id','=','wr.rack_id')
                ->where('wr.warehouse_id',$id)
                ->select('r.*','wr.id as wr_id')
                ->get();

        return view('dashboard.master.warehouse-rack.index',compact('warehouse', 'rack', 'data'));
    }

    public function store(Request $request)
    {
        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        DB::table('warehouse_racks')->insert([
            'warehouse_id'=>$request->warehouse_id,
            'rack_id'=>$request->rack_id,
            'created_at'=>$createdAt,
        ]);

        return redirect()->back()->with('success','Berhasil menambahkan data');
    }

    public function update(Request $request,$id)
    {
        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        DB::table('warehouse_racks')->where('id',$id)->update([
            'warehouse_id'=>$request->warehouse_id,
            'rack_id'=>$request->rack_id,
            'updated_at'=>$createdAt,
        ]);

        return redirect()->back()->with('success','Berhasil mengubah data');
    }

    public function delete($id)
    {
        DB::table('racks')->where('id',$id)->delete();
        return redirect()->back()->with('success','Berhasil menghapus data');
    }
}