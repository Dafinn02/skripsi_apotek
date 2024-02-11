<?php 
namespace App\Http\Controllers\Storage\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use Carbon\Carbon;
use DB;
class ProductController extends Controller
{
	public function __construct()
    {
        $this->middleware('validate_user_first');
    }

    public function index(Request $request)
    {
        $get = DB::table('products as pd');
        $get->join('categories as ctg','ctg.id','=','pd.category_id');
        if($request->search != null)
        {
            $get->where($request->option, 'like', '%' . $request->search . '%');
        }
        if($request->category_id != null)
        {
            $get->where('pd.category_id',$request->category_id);
        }
        if($request->status != null)
        {
            $get->where('pd.status',$request->category_id);
        }
        $get->select('pd.*','ctg.name as category_name');
        $data = $get->get();
        $categories = DB::table('categories')->get();
        $option = ['pd.name'=>'Nama','pd.unit'=>'Unit','pd.code'=>'Kode'];
        return view('dashboard.storage.product.index',compact('data','categories','option','request'));
    }

    public function create()
    {
        $categories = DB::table('categories')->get();
        return view('dashboard.storage.product.create',compact('categories'));
    }

    public function store(Request $request)
    {
        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $markup_percentage = $request->markup_percentage;
        $basic_price = $request->basic_price;
        $markup = $basic_price * $markup_percentage / 100;
        $sales_price = $markup + $basic_price;
        $check = DB::table('products')->where('code',$request)->first();
        if($check)
        {
            return redirect()->back()->with('error','kode '.$request->code.' sudah digunakan produk lain, mohon isi kode yang belum digunakan oleh produk lain');
        }
        DB::table('products')->insert([
            'name'=>$request->name,
            'category_id'=>$request->category_id,
            'code'=>$request->code,
            'unit'=>strtolower($request->unit),
            'basic_price'=>$basic_price,
            'sales_price'=>$sales_price,
            'markup'=>$markup,
            'markup_percentage'=>$markup_percentage,
            'status'=>$request->status,
            'created_at'=>$createdAt,
        ]);

        return redirect('product')->with('success','Berhasil menambahkan data');
    }

    public function edit($id)
    {
        $categories = DB::table('categories')->get();
        $data = DB::table('products')->where('id',$id)->first();
        return view('dashboard.storage.product.edit',compact('categories','data'));
    }

    public function update(Request $request,$id)
    {
        $createdAt = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $markup_percentage = $request->markup_percentage;
        $basic_price = $request->basic_price;
        $markup = $basic_price * $markup_percentage / 100;
        $sales_price = $markup + $basic_price;
        $check = DB::table('products')->where('code',$request)->first();
        if($check)
        {
            if($check->id != $id)
            {
                return redirect()->back()->with('error','kode '.$request->code.' sudah digunakan produk lain, mohon isi kode yang belum digunakan oleh produk lain');
            }
        }
        DB::table('products')->where('id',$id)->update([
            'name'=>$request->name,
            'category_id'=>$request->category_id,
            'unit'=>strtolower($request->unit),
            'code'=>$request->code,
            'basic_price'=>$basic_price,
            'sales_price'=>$sales_price,
            'markup'=>$markup,
            'markup_percentage'=>$markup_percentage,
            'status'=>$request->status,
            'updated_at'=>$createdAt,
        ]);

        return redirect('product')->with('success','Berhasil mengubah data');
    }

    public function delete($id)
    {
        DB::table('products')->where('id',$id)->delete();
        return redirect()->back()->with('success','Berhasil menghapus data');
    }
}