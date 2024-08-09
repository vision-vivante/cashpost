<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class StripeAccount
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check() && isFreelancer()){
            if(empty(Auth::user()->profile->stripe_account)){
                return redirect('/stripe/add-account');
            }
        }
        return $next($request);
    }
}
