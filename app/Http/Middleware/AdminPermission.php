<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminPermission
{
    use \App\Traits\AdminPermission;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($this->CheckRequestPermission()){
            $notification = array(
                'message' => 'You Have No Permission!!',
                'alert-type' => 'error'
            );
            return Redirect()->route('admin.dashboard')->with($notification);
            
        }
        return $next($request);
    }
}
