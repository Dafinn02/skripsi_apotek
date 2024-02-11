<?php 
namespace App\Http\Controllers\System;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use Carbon\Carbon;
use DB;
class PermissionController extends Controller
{
	public function __construct()
    {
        $this->middleware('validate_user_first');
    }

    public function index(Request $request)
    {
    	$role = DB::table('roles')->where('id','!=',0)->get();
    	$data = [];
    	$roleName = null;
    	if($request->role_id != null)
    	{
    		$data = Menu::getMenuBaseOnrole($request);
    		$data = $data['menu'];
    		$roleName = DB::table('roles')->where('id',$request->role_id)->first();
    		if($roleName)
    		{
    			$roleName = $roleName->name;
    		}
    		//dd($data);
    	}
    	return view('dashboard.system.permission.index',compact('role','data','roleName','request'));
    }

    public function update(Request $request,$id)
    {
    	$data = Menu::getMenuBaseOnrole($request);
    	$data = $data['menu'];
    	//dd($data);
    	//dd($request->all());
    	$roleMenu = $request->role_menu;
    	//dd($roleMenu);
    	foreach ($data as $k => $value) 
    	{
    		if(!isset($roleMenu[$k]))
    		{
    			DB::table('role_menus')
    			->where('role_id',$request->role_id)
    			->where('menu_id',$k)
    			->update(['allowed'=>0]);
    		}else
    		{
    			DB::table('role_menus')
    			->where('role_id',$request->role_id)
    			->where('menu_id',$k)
    			->update(['allowed'=>1]);
    		}
    		foreach ($value['item'] as $i => $v) 
    		{
    			if(!isset($roleMenu[$k][$i]))
	    		{
	    			DB::table('role_menus')
	    			->where('role_id',$request->role_id)
	    			->where('menu_id',$k)
	    			->where('item_id',$i)
	    			->update(['allowed'=>0]);
	    		}else
	    		{
	    			DB::table('role_menus')
	    			->where('role_id',$request->role_id)
	    			->where('menu_id',$k)
	    			->where('item_id',$i)
	    			->update(['allowed'=>1]);
	    		}
    			foreach ($v['child'] as $l => $u) 
    			{
    				if(!isset($roleMenu[$k][$i][$l]))
		    		{
		    			DB::table('role_menus')
		    			->where('role_id',$request->role_id)
		    			->where('menu_id',$k)
		    			->where('parent_id',$i)
		    			->where('item_id',$l)
		    			->update(['allowed'=>0]);
		    		}else
		    		{
		    			DB::table('role_menus')
		    			->where('role_id',$request->role_id)
		    			->where('menu_id',$k)
		    			->where('parent_id',$i)
		    			->where('item_id',$l)
		    			->update(['allowed'=>1]);
		    		}
    			}
    		}
    	}
    	// $data = Menu::getMenuBaseOnrole($request);
    	// $data = $data['menu'];
    	// dd($data);
    	return redirect()->back()->with('success','Berhasil melakukan update data');
    }
}