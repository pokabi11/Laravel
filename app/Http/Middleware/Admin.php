<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()){
            $user = auth()->user();
            if($user->isAdmin()){
                return $next($request);
            }
        }
        return abort(404);
    }
//    public function handle(Request $request, Closure $next)
//    {
//        if(auth()){
//            $user = auth()->user();
//            if($user->isAdmin()){
//                return $next($request);
//            }else{
//                return about(404);
//            }
//        }
//        return redirect()->to("admin/login");
//    }
}
