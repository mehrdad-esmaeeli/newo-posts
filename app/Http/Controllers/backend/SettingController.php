<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view('backend.setting.index')->with('setting', Setting::first());
    }

    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'required',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'email' => 'nullable|email',
            'phone' => 'required|numeric',
            'address' => 'nullable',



        ]);


        Setting::where('id','1')->update(['logo'=>$request->logo,'facebook'=>$request->facebook,'twitter'=>$request->twitter,'email'=>$request->email,'phone'=>$request->phone,'address'=>$request->address]);

        Session::flash('success','setting update');

        return redirect()->back();
    }

}
