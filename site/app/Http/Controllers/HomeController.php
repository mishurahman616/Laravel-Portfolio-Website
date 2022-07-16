<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Visitor;
use Illuminate\Http\Request;

class HomeController extends Controller
{

/**
 * > This function is used to insert the visitor's IP address and visiting time into the database
 * 
 * @return A view is being returned.
 */
    function HomeIndex(){
    /* Inserting the visitor's IP address and visiting time into the database. */
        $userIP=$_SERVER['REMOTE_ADDR'];
        date_default_timezone_set("Asia/Dhaka");
        $timeDate=date('Y-m-d h:i:sa');
        Visitor::insert(['ip_address'=>$userIP, 'visiting_time'=>$timeDate]);

        $serviceData=Service::orderBy('id')->limit(4)->get();

        return view('home', ['serviceData'=>$serviceData]);
    }


}
