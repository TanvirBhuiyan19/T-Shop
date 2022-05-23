<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class SubadminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('role')->where('role_id', '!=', 2)->where('role_id', '!=', 1)->get();
        return view('admin.subadmin.index', compact('users') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('id', '!=', 2)->where('id', '!=', 1)->get();
        return view('admin.subadmin.create', compact('roles') );
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'role_id' => 'required|numeric',
        ]);
        $request['password'] = Hash::make($request->password);
        
        User::create($request->all());
//        User::create([
//            'role_id' => $request->role_id,
//            'user' => $request->user,
//            'created_at' => Carbon::now(),
//        ]);
        
        $notification = array(
            'message' => 'User Created Successfully !!',
            'alert-type' => 'success'
        );
        return Redirect()->route('subadmin.index')->with($notification);
        
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
    public function edit($id)
    {
       $user = User::find($id);
       $roles = Role::where('id', '!=', 2)->where('id', '!=', 1)->get();
       return view('admin.subadmin.edit', compact('user','roles') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|confirmed|min:6',
            'role_id' => 'required|numeric',
        ]);
        if($request->password == null){
            $request['password'] = auth()->user()->password;
        }else{
            $request['password'] = Hash::make($request->password);
        }
        User::findOrfail($id)->update($request->all());
        
        $notification = array(
            'message' => 'User Updated Successfully !!',
            'alert-type' => 'success'
        );
        return Redirect()->route('subadmin.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrfail($id)->delete();
        
        $notification = array(
            'message' => 'User Deleted Successfully !!',
            'alert-type' => 'success'
        );
        return Redirect()->route('subadmin.index')->with($notification);
    }
}
