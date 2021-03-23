<?php

namespace App\Http\Controllers\Api\Security;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Local\User;
use App\Http\Resources\Security\User as UserResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('security.users.index');
        return UserResource::collection(
            User::orderBy('name')->get()
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
        $this->authorize('security.users.store');
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8|max:255',
        ]);

        DB::beginTransaction();
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        $user->roles()->sync($request->roles);
        DB::commit();

        return new UserResource($user);
    }

    public function getAuthUser(Request $request)
    {
        $user = User::where('id', $request->user()->id)
            ->with('roles', 'roles.permissions')
            ->first();
        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $this->authorize('security.users.show');
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('security.users.update');
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
        ]);

        DB::beginTransaction();
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        $user->roles()->sync($request->roles);
        DB::commit();

        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('security.users.destroy');
        $user->delete();

        return response("Usuário excluído com sucesso");
    }
}
