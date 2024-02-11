<?php 
namespace App\Http\Controllers\Storage\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use Carbon\Carbon;
use DB;
class CategoryController extends Controller
{
	public function __construct()
    {
        $this->middleware('validate_user_first');
    }

    public function index(Request $request)
    {
        $data = DB::table('categories')->get();
        return view('dashboard.storage.product.category.index',compact('data'));
    }

    public function store(Request $request)
    {
        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        DB::table('categories')->insert([
            'name'=>$request->name,
            'created_at'=>$createdAt,
        ]);

        return redirect()->back()->with('success','Berhasil menambahkan data');
    }

    public function update(Request $request,$id)
    {
        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        DB::table('categories')->where('id',$id)->update([
            'name'=>$request->name,
            'updated_at'=>$createdAt,
        ]);

        return redirect()->back()->with('success','Berhasil mengubah data');
    }

    public function delete($id)
    {
        DB::table('categories')->where('id',$id)->delete();
        return redirect()->back()->with('success','Berhasil menghapus data');
    }
}