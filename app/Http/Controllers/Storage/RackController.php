<?php 
namespace App\Http\Controllers\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use Carbon\Carbon;
use DB;
class RackController extends Controller
{
	public function __construct()
    {
        $this->middleware('validate_user_first');
    }

    public function index(Request $request)
    {
        $data = DB::table('racks')
                ->join('warehouses as whs','whs.id','=','racks.warehouse_id')
                ->where('racks.warehouse_id',$request->warehouse_id)
                ->select('racks.*','whs.name as warehouse_name')
                ->get();
        $warehouse = DB::table('warehouses')->where('id',$request->warehouse_id)->first();
        $warehouses = DB::table('warehouses')->where('id','!=',$request->warehouse_id)->get();
        return view('dashboard.storage.rack.index',compact('data','warehouse','warehouses'));
    }

    public function store(Request $request)
    {
        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        DB::table('racks')->insert([
            'name'=>$request->name,
            'capacity'=>$request->capacity,
            'warehouse_id'=>$request->warehouse_id,
            'created_at'=>$createdAt,
        ]);

        return redirect()->back()->with('success','Berhasil menambahkan data');
    }

    public function update(Request $request,$id)
    {
        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        DB::table('racks')->where('id',$id)->update([
            'name'=>$request->name,
            'capacity'=>$request->capacity,
            'warehouse_id'=>$request->warehouse_id,
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