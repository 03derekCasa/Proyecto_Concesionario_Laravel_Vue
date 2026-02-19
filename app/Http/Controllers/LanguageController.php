<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function switch(Request $request, string $locale): RedirectResponse
    {
        $supported = ['es', 'en', 'fr'];

        if (! in_array($locale, $supported, true)) {
            $locale = config('app.locale');
        }

        $request->session()->put('locale', $locale);

        return back();
    }
}
