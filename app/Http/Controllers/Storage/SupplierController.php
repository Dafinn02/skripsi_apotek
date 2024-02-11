<?php 
namespace App\Http\Controllers\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use Carbon\Carbon;
use DB;
class SupplierController extends Controller
{
	public function __construct()
    {
        $this->middleware('validate_user_first');
    }

    public function index(Request $request)
    {
        $get = DB::table('suppliers');
        if($request->search != null)
        {
            $get->where($request->option, 'like', '%' . $request->search . '%');
        }
        $data = $get->get();
        $option = ['name'=>'Nama','address'=>'Alamat','phone'=>'No Telepon','pic'=>'Pic','email'=>'Email'];
        return view('dashboard.storage.supplier.index',compact('data','request','option'));
    }

    public function store(Request $request)
    {
        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        DB::table('suppliers')->insert([
            'name'=>$request->name,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'pic'=>$request->pic,
            'email'=>$request->email,
            'created_at'=>$createdAt,
        ]);

        return redirect()->back()->with('success','Berhasil menambahkan data');
    }

    public function update(Request $request,$id)
    {
        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        DB::table('suppliers')->where('id',$id)->update([
            'name'=>$request->name,
            'address'=>$request->address,
            'phone'=>$request->phone,
            'pic'=>$request->pic,
            'email'=>$request->email,
            'updated_at'=>$createdAt,
        ]);

        return redirect()->back()->with('success','Berhasil mengubah data');
    }

    public function delete($id)
    {
        DB::table('suppliers')->where('id',$id)->delete();
        return redirect()->back()->with('success','Berhasil menghapus data');
    }
}