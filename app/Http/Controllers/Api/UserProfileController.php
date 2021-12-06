<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @todo Only return fields appropriate to profile; nickname, bio etc.
     * @param User $user
     * @return User
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @todo Only return fields appropriate to profile; nickname, bio etc.
     * @todo Only the owning user should be able to update the profile.
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\User         $user
     * @return User
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'nickname' => 'required', // TODO: Check if unique
            'bio' => 'required',
        ]);
        $user->update($request->all());

        return $user->fresh();
    }
}
