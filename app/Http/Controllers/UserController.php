<?php

namespace App\Http\Controllers;

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
}
