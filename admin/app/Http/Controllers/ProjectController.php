<?php

namespace App\Http\Controllers;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function projectIndex()
    {
      $projectData = Project::orderBy('id', 'desc')->get();
      return view('project', ['projectData'=>$projectData]);
    }

    public function getProjectData()
    {
        $projectData = Project::orderBy('id', 'desc')->get();
        return $projectData;
    }
    public function addProject(Request $req)
    {

        $req->validate([
            'title'=>'required|string|max:255',
            'image'=>'required|string|max:255',
            'link'=>'required|string|max:255',
            'desc'=>'required|string|max:1000',
        ]);
        $title=$req->input('title');
        $image=$req->input('image');
        $link=$req->input('link');
        $desc=$req->input('desc');
        $result= Project::insert(['project_title'=>$title, 'project_desc'=>$desc,  'project_link'=>$link, 'project_image'=>$image]);
        if($result==true){
            return 1;
        }else{
            return 0;
        }
    }
    public function getProjectDataById(Request $req)
    {
        $req->validate([
            'id'=>'required|int|min:0',
        ]);
        $id = $req->input('id');
        return Project::where('id', '=', $id)->first();
    }
    public function updateProject(Request $req)
    {

        $req->validate([
            'id'=>'required|int|min:0',
            'title'=>'required|string|max:255',
            'image'=>'required|string|max:255',
            'link'=>'required|string|max:255',
            'desc'=>'required|string|max:1000',
        ]);
        $id=$req->input('id');
        $title=$req->input('title');
        $image=$req->input('image');
        $link=$req->input('link');
        $desc=$req->input('desc');
        $result= Project::where('id', '=', $id)->update(['project_title'=>$title, 'project_desc'=>$desc,  'project_link'=>$link, 'project_image'=>$image]);
        if($result==true){
            return 1;
        }else{
            return 0;
        }
    }
}
