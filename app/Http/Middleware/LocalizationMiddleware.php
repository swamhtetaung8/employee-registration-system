<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

/**
 * To handle current language of the applicationw
 *
 * @author Swam Htet Aung
 *
 * @create date 21-06-2023
 *
 */
class LocalizationMiddleware
{
    /**
     * Handle an incoming request.
     * @author Swam Htet Aung
     * @create date 05-07-2023
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!empty(session('locale'))) { #Checking if there is no stored language
            App::setLocale(session('locale'));
        } else {
            session()->put('locale','en');
            App::setLocale(session('locale'));
        }
        return $next($request);
    }
}
