<?php

namespace App\Http\Controllers\Api\Security;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Local\Role;
use App\Http\Resources\Security\Role as RoleResource;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('security.roles.index');
        return RoleResource::collection(
            Role::orderBy('name', 'asc')->get()
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
        $this->authorize('security.roles.store');

        $request->validate([
            'name' => 'required|min:3|max:50|regex:/^[a-z0-9\-\.\_]+$/|unique:roles,name',
            'label' => 'required|min:3|max:200',
        ]);

        $role = new Role;
        $role->name = $request->name;
        $role->label = $request->label;
        $role->save();

        return new RoleResource($role);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Local\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $this->authorize('security.roles.show');
        return new RoleResource($role);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Local\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $this->authorize('security.roles.update');
        $request->validate([
            'name' => 'required|min:3|max:50|regex:/^[a-z0-9\-\.\_]+$/|unique:roles,name,'.$role->id,
            'label' => 'required|min:3|max:200',
        ]);

        $role->name = $request->name;
        $role->label = $request->label;
        $role->save();

        $role->permissions()->sync($request->permissions);

        return new RoleResource($role);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Local\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $this->authorize('security.roles.destroy');
        $role->delete();
    }
}
