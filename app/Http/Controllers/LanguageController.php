<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class LanguageController extends Controller
{
    public function switch($apprev)
    {
        if(array_key_exists($apprev, Config::get('languages'))){

            Session::put('applocale', $apprev);
        }
        return redirect()->back();
    }
}
