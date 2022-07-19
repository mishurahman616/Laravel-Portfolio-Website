<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * This function is used to display the course data in the course page
     */
    public function courseIndex()
    {
        $courseData=Course::orderBy('id', 'desc')->get(); 
        return view('course', ['courseData'=>$courseData]);
    }

    /**
     * > This function returns all the courses 
     * 
     * @return The data from the Courses table in the database.
     */
    public function getCourseData()
    {
        return Course::orderBy('id', 'desc')->get();
    }

    /**
     * 
     * @param Request req The request object
     * 
     * @return The first row of the Course table where the id is equal to the id passed in the request.
     */
    public function getCourseDataById(Request $req)
    {
        $id = $req->input('id');
        return Course::where('id', '=', $id)->first();
    }

    /**
     * > This function deletes a course from the database
     * 
     * @param Request req The request object.
     * 
     * @return 1 or 0 based delete success or fail
     */
    function deleteCourse(Request $req)
    {
       
        $req->validate([
            "id"=>"required|int|min:0"
        ]);
        $deleteId=$req->input('id');
        $result= Course::find($deleteId)->delete();
        if($result===true){
            return 1;
        }else{
            return 0;
        }
    }

    /**
     * It updates the course details.
     * 
     * @param Request req The request object.
     * 
     * @return 1 or 0
     */
    function updateCourse(Request $req)
    {
        $req->validate([
            "id"=>"required|int|min:0",
            "name"=>"required|string|max:255",
            "desc"=>"required|string|max:500",
            "fee"=>"required|string|max:255",
            "totalEnroll"=>"required|string|max:255",
            "totalClass"=>"required|string|max:255",
            "link"=>"required|string|max:500",
            "image"=>"required|string|max:500",
        ]);
        $id=$req->input('id');
        $name=$req->input('name');
        $desc=$req->input('desc');
        $fee=$req->input('fee');
        $totalEnroll=$req->input('totalEnroll');
        $totalClass=$req->input('totalClass');
        $link=$req->input('link');
        $image=$req->input('image');
        $result= Course::where('id','=',$id)->update(['course_name'=>$name, 'course_desc'=>$desc, 'course_fee'=>$fee, 'course_total_enroll'=>$totalEnroll, 'course_total_class'=>$totalClass, 'course_link'=>$link, 'course_image'=>$image]);
        if($result==true){
            return 1;
        }else{
            return 0;
        }
    }

    /**
     * It adds a course to the database.
     * 
     * @param Request req The request object.
     * 
     * @return 1 or 0
     */
    function addCourse(Request $req)
    {
       
        $req->validate([
            "name"=>"required|string|max:255",
            "desc"=>"required|string|max:255",
            "fee"=>"required|string|max:255",
            "totalEnroll"=>"required|string|max:255",
            "totalClass"=>"required|string|max:255",
            "link"=>"required|string|max:255",
            "image"=>"required|string|max:255",
        ]);
        $name=$req->input('name');
        $desc=$req->input('desc');
        $fee=$req->input('fee');
        $totalEnroll=$req->input('totalEnroll');
        $totalClass=$req->input('totalClass');
        $link=$req->input('link');
        $image=$req->input('image');
        $result= Course::insert(['course_name'=>$name, 'course_desc'=>$desc, 'course_fee'=>$fee, 'course_total_enroll'=>$totalEnroll, 'course_total_class'=>$totalClass, 'course_link'=>$link, 'course_image'=>$image]);
        if($result==true){
            return 1;
        }else{
            return 0;
        }
    }

}
