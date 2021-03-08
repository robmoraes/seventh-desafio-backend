<?php

namespace App\Http\Controllers\Api\Security;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Local\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('security.permissions.index');
        return response()->json(
            Permission::orderBy('category', 'asc')->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('security.permissions.store');
        $request->validate([
            'name' => 'required|regex:/^[a-z0-9\-\.\_]+$/|min:3|max:50|unique:permissions,name',
            // 'name' => 'required|min:3|max:50|unique:permissions,name',
            'label' => 'required|min:4|max:200',
            'category' => 'max:50',
        ]);
        $permission = new Permission;
        $permission->name = $request->name;
        $permission->label = $request->label;
        $permission->category = $request->category;
        $permission->save();
        return response()->json($permission);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        $this->authorize('security.permissions.show');
        return response()->json($permission);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $this->authorize('security.permissions.update');
        $request->validate([
            'name' => 'required|regex:/^[a-z0-9\-\.\_]+$/|min:3|max:50|unique:permissions,name,'.$permission->id,
            'label' => 'required|min:4|max:200',
            'category' => 'max:50',
        ]);
        $permission->name = $request->name;
        $permission->label = $request->label;
        $permission->category = $request->category;
        $permission->save();
        return response()->json($permission);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $this->authorize('security.permissions.destroy');
        $permission->delete();
        return response('deleted', 200);
    }
}
