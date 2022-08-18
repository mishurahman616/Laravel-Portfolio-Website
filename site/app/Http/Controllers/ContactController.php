<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    function contactPage(){
        $contactData = Contact::orderBy('id', 'desc')->get();
        return view('contactPage', ['contactData'=>$contactData]);
        
    }
}
