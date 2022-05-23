<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\Models\Role;
use Carbon\Carbon;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::with('role')->where('role_id', '!=', 1)->get();
        return view('admin.permission.index', compact('permissions') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('id', '!=', 2)->where('id', '!=', 1)->get();
        return view('admin.permission.create', compact('roles') );
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
            'role_id' => 'required|numeric|unique:permissions,role_id',
            'permission' => 'required'
        ]);
        Permission::create([
            'role_id' => $request->role_id,
            'permission' => $request->permission,
            'created_at' => Carbon::now(),
        ]);
        
        $notification = array(
            'message' => 'Permission Created Successfully !!',
            'alert-type' => 'success'
        );
        return Redirect()->route('permission.index')->with($notification);
        
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
       $permission = Permission::find($id);
       $roles = Role::where('id', '!=', 2)->where('id', '!=', 1)->get();
       return view('admin.permission.edit', compact('permission','roles') );
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
            'role_id' => 'required|numeric|exists:permissions,role_id',
            'permission' => 'required'
        ]);
        Permission::findOrfail($id)->update([
            'role_id' => $request->role_id,
            'permission' => $request->permission,
            'updated_at' => Carbon::now(),
        ]);
        
        $notification = array(
            'message' => 'Permission Updated Successfully !!',
            'alert-type' => 'success'
        );
        return Redirect()->route('permission.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Permission::findOrfail($id)->delete();
        
        $notification = array(
            'message' => 'Permission Deleted Successfully !!',
            'alert-type' => 'success'
        );
        return Redirect()->route('permission.index')->with($notification);
    }
}
