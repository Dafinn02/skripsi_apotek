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
        $get->join('units as unt','unt.id','=','pd.unit_id');
        $get->join('suppliers as spl','spl.id','=','pd.supplier_id');
        // return response()->json($get->get());
        if($request->search != null)
        {
            $get->where('pd.name', 'like', '%' . $request->search . '%');
        }
        if($request->category != null)
        {
            $get->where('pd.category_id',$request->category);
        }
        if($request->unit_id != null)
        {
            $get->where('pd.unit_id',$request->unit_id);
        }
        $get->select('pd.id', 'pd.code as code', 'pd.name as name', 'pd.recipe as recipe', 'pd.price as price', 
        'pd.min_stock as min_stock', 'pd.max_stock as max_stock', 'pd.stock as stock',
        'ctg.name as category_name', 'unt.name as unit_name', 'spl.name as supplier_name');
        $data = $get->get();
        // return response()->json($data);
        $categories = DB::table('categories')->get();
        $units = DB::table('units')->get();

        return view('dashboard.master.product.index',compact('data','categories','units','request'));
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