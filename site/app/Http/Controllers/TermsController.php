<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class TermsController extends Controller
{
    function termsPage(){
        return view('termsPage');
    }
}
