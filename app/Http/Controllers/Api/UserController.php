<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return User
     */
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return User
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        return User::create($request->all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @Todo Check only authed user or
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\User      $user
     * @return User
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->all());

        return $user->fresh();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @todo Check only authed user or moderator can delete this resource
     * @todo We should delete the users
     * @param  \App\Models\User $user
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();
    }
}
