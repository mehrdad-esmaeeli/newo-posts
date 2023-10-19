<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.post.index')->with('posts', Post::where('lang',app()->getLocale())->paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.post.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:300',
            'sub_title' => 'required|max:500',
            'description' => 'required|max:1000'
        ]);

        Post::create(['title' => $request->title, 'sub_title' => $request->sub_title, 'description' => $request->description, 'slug' => Str::slug($request->title),'lang'=>app()->getLocale()]);
        Session::flash('success','create succesfuly');
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {

        return view('backend.post.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Post $post)
    {
        $request->validate([
            'title' => 'required|max:300',
            'sub_title' => 'required|max:500',
            'description' => 'required|max:1000'
        ]);

        $post->title=$request->title;
        $post->sub_title=$request->sub_title;
        $post->description=$request->description;
        $post->slug=Str::slug($request->title);
        $post->save();
        Session::flash('success','update succesfuly');

        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return "success";
    }

    public function trash(){
        return view('backend.post.trash')->with('posts',Post::onlyTrashed()->paginate(10));
    }


    public function delete($id){
        $post=Post::withTrashed('id',$id)->first();
        $post->forceDelete();
        return "success";
    }

    public function restore($id){

        $post=Post::withTrashed('id',$id)->first();
        $post->restore();
        return redirect()->route('post.index');

    }
}
