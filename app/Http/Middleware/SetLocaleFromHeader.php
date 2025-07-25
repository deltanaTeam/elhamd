<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleFromHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->header('Accept-Language','ar');
        $supportedLocale = ['en','ar'];
        if (!in_array($locale,$supportedLocale)) {
          $locale ='ar';
        }
        app()->setLocale($locale);
        return $next($request);
    }
}
