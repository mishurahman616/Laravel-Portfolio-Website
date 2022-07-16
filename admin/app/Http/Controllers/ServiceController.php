<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * It returns the view of the service page with serviceData.
     */
    public function serviceIndex()
    {
        $serviceData=Service::orderBy('id', 'desc')->get(); 
        return view('service', ['serviceData'=>$serviceData]);
    }
    
    
    /**
     * > This function returns all the data from the services table
     * 
     * @return All the data from the services table.
     */
    public function getServiceData()
    {
        return Service::orderBy('id')->get();
    }


    /**
     * It returns the first service with the id that matches the id passed in the request
     * 
     * @param Request req The request object
     * 
     * @return The first service with the id that matches the id passed in the request .
     */
    public function getServiceDataById(Request $req)
    {
        $id = $req->input('id');
        return Service::where('id', '=', $id)->first();
    }

    /**
     * It deletes a service from the database.
     * 
     * @param Request req The request object.
     * 
     * @return The result of the delete operation.
     */
    function deleteService(Request $req)
    {
       
        $req->validate([
            "id"=>"required|int|min:0"
        ]);
        $deleteId=$req->input('id');
        $result= Service::find($deleteId)->delete();
        if($result===true){
            return 1;
        }else{
            return 0;
        }
    }

    function updateService(Request $req)
    {
       
        $req->validate([
            "id"=>"required|int|min:0",
            "title"=>"required|string|max:255",
            "desc"=>"required|string|max:255",
            "image"=>"required|string|max:255"
        ]);
        $id=$req->input('id');
        $title=$req->input('title');
        $desc=$req->input('desc');
        $image=$req->input('image');
        $result= Service::where('id','=',$id)->update(['service_title'=>$title, 'service_desc'=>$desc, 'service_image'=>$image]);
        if($result==true){
            return 1;
        }else{
            return 0;
        }
    }
    function addService(Request $req)
    {
       
        $req->validate([
            "title"=>"required|string|max:255",
            "desc"=>"required|string|max:255",
            "image"=>"required|string|max:255"
        ]);
        $title=$req->input('title');
        $desc=$req->input('desc');
        $image=$req->input('image');
        $result= Service::insert(['service_title'=>$title, 'service_desc'=>$desc, 'service_image'=>$image]);
        if($result==true){
            return 1;
        }else{
            return 0;
        }
    }
}
