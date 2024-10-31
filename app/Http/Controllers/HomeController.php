<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function requestfrm(){

        return view('forms.request');
    }
}
