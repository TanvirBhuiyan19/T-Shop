<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use App\Models\User;

class UserMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {

        //User Banned and Unbanned
        if (Auth::check() && Auth::user()->isban == 1) {
            Auth::logout();
            return redirect()->route('login')->withErrors([
                'banned' => 'Your Account Has Been Banned!! Please Contact with Admin.'
            ]);
        } 

        //User Active and Inactive
        if (Auth::check()) {
            $expireTime = Carbon::now()->addSeconds(60);
            Cache::put('user_is_online' . Auth::user()->id , true, $expireTime);
            User::where('id', Auth::user()->id)->update(['last_seen' => Carbon::now()]);
        }
        

        if (Auth::check() && Auth::user()->role_id == 2) {
            return $next($request);
        } else {
            return redirect()->route('login');
        }

        
        
    }

}
