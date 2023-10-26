<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(){
        return view('backend.role.index')->with('roles',Role::paginate(10));
    }

    public function create(){
        return view('backend.role.create');
    }

    public function store(Request $request){

        $request->validate([
            'name'=>'required',
        ]);

        Role::create(['name'=>$request->name]);
        return redirect()->route('Role.index');

    }

    public function show($Role){

        return view('backend.role.show')->with('permissions',Permission::all())->with('role_id',$Role);

    }

    public function update(Request $request,$Role){
         $request->validate([
            'permission'=>'required|array'
         ]);

         $role=Role::find($Role);

        //  return  $role->permission();
         $role->permissions()->attach($request->permission);
         return redirect()->route('Role.index');
    }
}

