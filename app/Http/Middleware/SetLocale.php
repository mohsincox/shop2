<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * The supported locales.
     */
    public const SUPPORTED = ['en', 'de'];

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->hasSession() && $request->session()->has('locale')
            ? $request->session()->get('locale')
            : config('app.locale', 'en');

        if (! in_array($locale, self::SUPPORTED)) {
            $locale = 'en';
        }

        App::setLocale($locale);

        return $next($request);
    }
}
