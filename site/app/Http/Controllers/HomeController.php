<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Course;
use App\Models\Service;
use App\Models\Visitor;
use App\Models\Project;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{

/**
 * > This function is used to insert the visitor's IP address and visiting time into the database
 * 
 * @return A view is being returned.
 */
    function homeIndex(){
    /* Inserting the visitor's IP address and visiting time into the database. */
        $userIP=$_SERVER['REMOTE_ADDR'];
        date_default_timezone_set("Asia/Dhaka");
        $timeDate=date('Y-m-d h:i:sa');
        Visitor::insert(['ip_address'=>$userIP, 'visiting_time'=>$timeDate]);

        $serviceData=Service::orderBy('id', 'desc')->limit(4)->get();
        $courseData=Course::orderBy('id', 'desc')->limit(6)->get();
        $projectData=Project::orderBy('id', 'desc')->limit(10)->get();
        $reviewData=Review::orderBy('id', 'desc')->limit(10)->get();

        return view('home', [
            'serviceData'=>$serviceData, 
            'courseData'=>$courseData, 
            'projectData'=>$projectData,
            'reviewData'=>$reviewData,
        ]);
    }
    function contactSend(Request $request){
        $request->validate([
            'name'=>'required|string|min:2|max:255',
            'mobile'=>'required|string|min:2|max:255',
            'email'=>'required|email',
            'message'=>'required|string|min:2|max:500',
        ]);

        $name=$request->input('name');
        $mobile=$request->input('mobile');
        $email=$request->input('email');
        $message=$request->input('message');
        $result = Contact::insert([
            'name'=>$name,
            'mobile'=>$mobile,
            'email'=>$email,
            'message'=>$message,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),            
        ]);
        if($result){
            return 1;
        }else{
            return 0;
        }
    }


}
