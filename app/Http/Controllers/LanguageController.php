<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function languageChange($lang)
    {
        if (array_key_exists($lang, Config::get('language'))) {
            Session::put('applocale', $lang);
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'Invalid language']);
    }
}
