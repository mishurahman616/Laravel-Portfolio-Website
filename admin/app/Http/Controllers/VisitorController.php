<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
/**
 * It returns a view called visitor, and passes the variable $visitorData to the view which contains all visitor data as object
 */
    public function visitorIndex()
    {
        $visitorsData=Visitor::orderBy('id', 'desc')->get(); 
        return view('visitor', ['visitorsData'=>$visitorsData]);
    }
}
