<?php

namespace App\Http\Controllers;

use App\Http\Middleware\SetLocale;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * Switch the application locale.
     */
    public function switch(Request $request, string $locale)
    {
        if (! in_array($locale, SetLocale::SUPPORTED)) {
            $locale = config('app.locale', 'en');
        }

        $request->session()->put('locale', $locale);

        return back()->with('success', __('Language switched to :locale.', ['locale' => $locale === 'de' ? 'Deutsch' : 'English']));
    }
}
