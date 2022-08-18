<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    function projectPage(){
        $projectData = Project::orderBy('id', 'desc')->get();
        return view('projectPage', ['projectData'=>$projectData]);
    }
}
