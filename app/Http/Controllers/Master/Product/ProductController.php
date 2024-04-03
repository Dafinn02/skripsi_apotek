<?php 
namespace App\Http\Controllers\Master\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use Carbon\Carbon;
use DB;
class ProductController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $get = DB::table('products as pd');
        $get->join('categories as ctg','ctg.id','=','pd.category_id');
        if($request->search != null)
        {
            $get->where('name', 'like', '%' . $request->search . '%');
        }
        if($request->category_id != null)
        {
            $get->where('pd.category_id',$request->category_id);
        }
        $get->select('pd.*','ctg.name as category_name');
        $data = $get->get();
        $categories = DB::table('categories')->get();
        $units = DB::table('units')->get();
       // $option = ['pd.name'=>'Nama','pd.unit'=>'Unit','pd.code'=>'Kode'];
        $product = DB::table('products as pd')
                    ->join('categories as ctg','ctg.id','=','pd.category_id')
                    ->join('units as unt','unt.id','=','pd.unit_id')
                    ->join('suppliers as spl','spl.id','=','pd.supplier_id')
                    ->select('pd.*','ctg.name as category_name', 'unt.name as unit_name', 'spl.name as supplier_name')
                    ->orderBy('pd.id','desc')
                    ->get();

        return view('dashboard.master.product.index',compact('data','categories','units','request','product'));
    }

    public function create()
    {
        $categories = DB::table('categories')->get();
        $unit = DB::table('units')->get();
        $supplier = DB::table('suppliers')->get();

        return view('dashboard.master.product.create',compact('categories', 'unit', 'supplier'));
    }

    public function store(Request $request)
    {
        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $check = DB::table('products')->where('code',$request->code)->first();
        if($check)
        {
            return redirect()->back()->with('error','kode '.$request->code.' sudah digunakan produk lain, mohon isi kode yang belum digunakan oleh produk lain');
        }
        DB::table('products')->insert([
            'name'=>$request->name,
            'code'=>$request->code,
            'supplier_id'=>$request->supplier_id,
            'unit_id'=>$request->unit_id,
            'category_id'=>$request->category_id,
            'price'=>$request->price,
            'recipe'=>$request->recipe,
            'max_stock'=>$request->max_stock,
            'min_stock'=>$request->min_stock,
            'created_at'=>$createdAt,
        ]);

        return redirect('/master/produk')->with('success','Berhasil menambahkan data');
    }

    public function edit($id)
    {
        $categories = DB::table('categories')->get();
        $unit = DB::table('units')->get();
        $supplier = DB::table('suppliers')->get();
        $data = DB::table('products')->where('id',$id)->first();
        // return response()->json($data);
        return view('dashboard.master.product.edit',compact('categories', 'unit', 'supplier', 'data'));
    }

    public function update(Request $request,$id)
    {
        // return response()->json($request->all());
        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $check = DB::table('products')->where('code',$request->code)->first();
        if($check)
        {
            if($check->id != $id)
            {
                return redirect()->back()->with('error','kode '.$request->code.' sudah digunakan produk lain, mohon isi kode yang belum digunakan oleh produk lain');
            }
        }
        DB::table('products')->where('id',$id)->update([
            'name'=>$request->name,
            'code'=>$request->code,
            'supplier_id'=>$request->supplier_id,
            'unit_id'=>$request->unit_id,
            'category_id'=>$request->category_id,
            'price'=>$request->price,
            'recipe'=>$request->recipe,
            'max_stock'=>$request->max_stock,
            'min_stock'=>$request->min_stock,
            'updated_at'=>$createdAt,
        ]);

        return redirect('/master/produk')->with('success','Berhasil mengubah data');
    }

    public function delete($id)
    {
        DB::table('products')->where('id',$id)->delete();
        return redirect()->back()->with('success','Berhasil menghapus data');
    }
}