<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
        /**
     * This function is used to display the contact data in the contact page
     */
    public function contactIndex()
    {
        $contactData=Contact::orderBy('id', 'desc')->get(); 
        return view('contact', ['contactData'=>$contactData]);
    }
    function deleteContactById(Request $request){
        $request->validate([
            'id'=>'required|string|max:255',
        ]);
        $id=$request->input('id');
        $result = Contact::find($id)->delete();
        return $result;
    }
}
