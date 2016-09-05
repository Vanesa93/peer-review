<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Session;
use App;

class LanguageController extends Controller {

    public function chooser($locale) {
        if (!empty($locale)) {
            Session::set('locale', $locale);
            App::setLocale($locale);
            
        } else {
            App::setLocale('en');
            Session::set('locale', 'en');
        }
     
       return redirect()->back();
    }
}
