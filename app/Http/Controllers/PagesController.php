<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function dashboardracing(){
        return view('dashboard1');
    }
    public function dashboardsales(){
        return view('dashboard2');
    }
}
