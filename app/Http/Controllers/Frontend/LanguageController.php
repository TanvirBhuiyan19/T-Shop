<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller {

//==================================== FOr  Bangla Language =============================================//  
    public function bangla() {
        session()->get('language');
        session()->forget('language');
        Session::put('language', 'bangla');
        return redirect()->back();
    }    

//==================================== FOr  English Language =============================================//  
    public function english() {
        session()->get('language');
        session()->forget('language');
        Session::put('language', 'english');
        return redirect()->back();
    }

    
}
