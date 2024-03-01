<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;

class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Session()->has('applocale') AND array_key_exists(Session()->get('applocale'), config('langauge'))){
            App::setLocale(Session()->get('apploacale'));
        }else{
            App::setLocale(config('app.fallback_locale'));
        }
        return $next($request);
    }
}
