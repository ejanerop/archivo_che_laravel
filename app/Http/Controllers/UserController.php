<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index', ['users'=> User::with('roles')->get()]);
    }

    public function create()
    {
        return view('user.create', ['roles' => Role::get()]);
    }
}
