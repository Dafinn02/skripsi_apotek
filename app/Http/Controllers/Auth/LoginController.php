<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Menu;
use Auth;
use Session;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginUser(Request $request)
    {
        $user = DB::table('users')->where('username',$request->username)->first();
        $arr = [];
        if($user)
        {
            if (!Hash::check($request->password, $user->password))
            {
                return redirect()->back()->with('error','Mohon maaf password yang anda masukkan salah, mohon cek kembali!');
            }
            $user = User::find($user->id);
            Auth::login($user);

            //menu
            $resultMenu = Menu::getMenuBaseOnrole($user);
            //dd($resultMenu);
            //dd($request->path());
            $role = DB::table('roles')->where('id',$user->role_id)->first();
            Session::put('roleUser',$role->name);
            Session::put('resultMenu',$resultMenu['menu']);
            Session::put('resultPath',$resultMenu['path']);
            Session::put('resultPathOne',$resultMenu['path_one']);
            //dd($role);
            return redirect($role->route);
        }
        return redirect()->back()->with('error','Mohon maaf username anda tidak ditemukan, mohon cek kembali!');
    }
}
