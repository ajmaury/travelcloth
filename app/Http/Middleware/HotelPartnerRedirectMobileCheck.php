<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
class HotelPartnerRedirectMobileCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {       
        if (Auth::guard('hotelpartner')->user()->mobile_verification_status == 0) {
            Toastr::error('Please Verify Mobile Number.');
            return redirect()->route('hotelpartner.profile');
        }
        return $next($request);
    }
}
