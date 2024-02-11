<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use Session;
class validateUserFirst
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!Auth::check())
        {
            return redirect('login');
        }else
        {
            if($request->isMethod('get'))
            {
                $pathArr = Session::get('resultPath');
                $path = $request->path();
                if(!in_array($path, $pathArr))
                {
                    $pathArrOne = Session::get('resultPathOne');
                    $crud = ['create','edit','delete','rack','category'];
                    $pathTwo = explode('/', $path);
                    if(isset($pathTwo[0]))
                    {
                        if(in_array($pathTwo[0], $pathArrOne))
                        {
                            if(isset($pathTwo[1]))
                            {
                                $pathTwo = $pathTwo[1];
                                if(!in_array($pathTwo, $crud))
                                {
                                    abort(403,'Maaf Anda Tidak Memilki Hak Akses Untuk Ke Halamn Ini');
                                }
                            }
                        }
                    }
                }
            }
        }
        return $next($request);
    }
}
