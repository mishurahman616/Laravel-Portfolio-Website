<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class PrivacyController extends Controller
{
    function privacyPage(){
        return view('privacyPage');
    }
}
