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

    public function store(Request $request)
    {
        //todo
    }

    public function edit($id)
    {
        return view('user.edit', ['roles' => Role::get(), 'user' => User::with('roles')->find($id)]);
    }

    public function update(Request $request, $id)
    {
        //todo
    }

    public function destroy($id)
    {
        //todo
    }
}
