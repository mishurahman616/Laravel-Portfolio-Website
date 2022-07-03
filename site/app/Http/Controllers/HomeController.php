<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    function HomeIndex(){
        $userIP=$_SERVER['REMOTE_ADDR'];
        date_default_timezone_set("Asia/Dhaka");
        $timeDate=date('Y-m-d h:i:sa');
        
        Visitor::insert(['ip_address'=>$userIP, 'visiting_time'=>$timeDate]);
        

        return view('home');
    }


}
