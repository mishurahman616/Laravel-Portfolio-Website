<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    function coursePage(){
        $courseData=Course::orderBy('id', 'desc')->get();
        return view('coursePage', ['courseData'=>$courseData]);
    }
}
