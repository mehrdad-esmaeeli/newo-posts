<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class ContactController extends Controller
{
    public function index(){
        return view('frontend.contact.index');
    }

    public function send(Request $request){

        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>'required',
            'message'=>'required'
        ]);
        return $request->all();
    }
}
