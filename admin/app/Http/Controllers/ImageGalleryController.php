<?php

namespace App\Http\Controllers;

use App\Models\ImageGallery;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ImageGalleryController extends Controller
{
    function imageGalleryIndex(){
        $images= ImageGallery::orderBy('id', 'desc')->get();
        return view('gallery', [
            'images'=>$images,
        ]);
    }
    function saveImage(Request $request){

        $path= $request->file('image')->store('public/gallery');
        $name=(explode('/', $path))[2];
        $host= $_SERVER['HTTP_HOST'];
        $link='http://'.$host.'/storage/gallery/'.$name;
        $caption=$request->input('image_caption')??'';
        $result=ImageGallery::insert([
            'image_link'=>$link,
            'image_caption'=>$caption,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        if($result==1){
            return 1;
        }else{
            return 0;
        }

    }
}
