<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
class HotelPartnerAuthenticate extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('hotelpartner.sign_in');
        }
    }
    protected function authenticate($request, array $guards)
    {        
        if ($this->auth->guard('hotelpartner')->check()) {
            return $this->auth->shouldUse('hotelpartner');
        }

        $this->unauthenticated($request, ['hotelpartner']);
    }
}
