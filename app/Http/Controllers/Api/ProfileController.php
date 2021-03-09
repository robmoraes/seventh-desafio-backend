<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Local\User;
use App\Http\Resources\Security\User as UserResource;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the authenticated user resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $this->authorize("user.edit.yourself");
        return new UserResource(Auth::user());
    }

    /**
     * Update the authenticated user resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->authorize("user.update.yourself");

        $user = User::find(Auth::id());

        $validate = [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
        ];
        if ($request->password) {
            $validate['password'] = 'required|min:8|max:255';
        }

        $request->validate($validate);
        
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        
        return new UserResource($user);
    }
}
