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
    public function dashboardracingadmin(){
        return view('admin.dashboard1-admin');
    }
    public function dashboardsalesadmin(){
        return view('admin.dashboard2-admin');
    }
    public function report(){
        return view('report');
    }
    public function salesach(){
        return view('salesach');
    }
    public function salesscore(){
        return view('salesscore');
    }
}
