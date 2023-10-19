<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('frontend.home.index')->with('posts', Post::where('lang',app()->getLocale())->orderBy('created_at','DESC')->paginate(10));
    }


    public function show($slug){
        $post=Post::where('slug',$slug)->first();
        // return $post;
        return view('frontend.home.show')->with('post',$post);
    }
}
