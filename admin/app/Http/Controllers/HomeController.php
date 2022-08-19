<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Course;
use App\Models\Project;
use App\Models\Review;
use App\Models\Service;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function HomeIndex()
    {
        $totalVisitor=Visitor::count();
        $totalCourse=Course::count();
        $totalProject=Project::count();
        $toalService=Service::count();
        $totalReview=Review::count();
        $totalContact=Contact::count();
        $summary=array(
            'visitor'=>$totalVisitor, 
            'course'=>$totalCourse, 
            'project'=>$totalProject, 
            'service'=>$toalService, 
            'review'=>$totalReview,
            'contact'=>$totalContact
        );

        return view('home', ['summary'=>$summary]);

    }
}
