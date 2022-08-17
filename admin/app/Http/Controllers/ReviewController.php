<?php

namespace App\Http\Controllers;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function reviewIndex()
    {
      $reviewData = Review::orderBy('id', 'desc')->get();
      return view('review', ['reviewData'=>$reviewData]);
    }

    public function getReviewData()
    {
        $reviewData = Review::orderBy('id', 'desc')->get();
        return $reviewData;
    }
    public function addReview(Request $req)
    {

        $req->validate([
            'name'=>'required|string|max:255',
            'image'=>'required|string|max:255',
            'desc'=>'required|string|max:1000',
        ]);
        $title=$req->input('name');
        $image=$req->input('image');
        $desc=$req->input('desc');
        $result= Review::insert([
            'name'=>$title, 
            'desc'=>$desc,  
            'image'=>$image,
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),  
        ]);
        if($result==true){
            return 1;
        }else{
            return 0;
        }
    }
    public function getReviewDataById(Request $req)
    {
        $req->validate([
            'id'=>'required|int|min:0',
        ]);
        $id = $req->input('id');
        return Review::where('id', '=', $id)->first();
    }
    public function updateReview(Request $req)
    {

        $req->validate([
            'id'=>'required|int|min:0',
            'name'=>'required|string|max:255',
            'image'=>'required|string|max:255',
            'desc'=>'required|string|max:1000',
        ]);
        $id=$req->input('id');
        $name=$req->input('name');
        $image=$req->input('image');
        $desc=$req->input('desc');
        $result= Review::where('id', '=', $id)->update([
            'name'=>$name, 
            'desc'=>$desc,  
            'image'=>$image,
            'updated_at'=> Carbon::now(),  
        ]);
        if($result==true){
            return 1;
        }else{
            return 0;
        }
    }
    public function deleteReview(Request $req)
    {
        
        $req->validate([
            'id'=>'required|int|min:0'
        ]);
        $id=$req->input('id');
        $result=Review::find($id)->delete();
        return $result;
    }
}
