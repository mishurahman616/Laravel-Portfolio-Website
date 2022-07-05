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
        return Service::all();
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
}
