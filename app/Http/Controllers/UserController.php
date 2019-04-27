<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
        $validate = $request->validate([
            'username' => 'required|string|max:20|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $role = Role::where('name', $request->input('role'))->first();

        $user = new User();
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->roles()->associate($role);
        $user->save();

        return redirect()->route('user.index');
    }

    public function edit($id)
    {
        return view('user.edit', ['roles' => Role::get(), 'user' => User::with('roles')->find($id)]);
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(),[
            'username' => ['required','string','max:20', Rule::unique('users')->ignore($id)],
            'email' => ['required','string','email','max:255', Rule::unique('users')->ignore($id)],
            'password' => 'nullable|string|min:8|confirmed'
        ])->validate();

        $role = Role::where('name', $request->input('role'))->first();

        $user = User::find($id);
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        if(!($request->has('password'))){
            $user->password = Hash::make($request->input('password'));
        }
        $user->roles()->associate($role);
        $user->save();

        return redirect()->route('user.index');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();

        return redirect()->route('user.index')->with('success','El usuario ha sido eliminado correctamente.');
    }
}
