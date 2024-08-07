<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;


class ContactController extends Controller
{
    //
    function index(){
        return response()->json([
            'contacts'=>Contact::all()
        ],200);
    }

    function store(Request $request){
        $data = $request->validate([
            'subject'=> ['required', 'string'],
            'email'=>['required', 'email'],
            'message'=>['required', 'string'],
            'name'=>['required', 'string']
        ]);
        return Contact::create($data);
    }

    function delete(Contact $contact){
        $contact->delete();
        return response()->json([
            'message'=>"request deleted successfully"
        ],204);
    }
}
