<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function viewUsers()
    {
        $users = UserResource::collection(User::otherUsers()->get());
        return view('users', ['users' => $users->toArray(request())]);
    }

    public function users()
    {
        // return User::filter(request(['search', 'room']))->get();
        return User::filter()->get();
    }

    // public function createUser(UserRequest $request)
    // {
    //     $request->validated();
    //     User::create($request->only('name', 'username', 'email', 'password'));
    // }
}
