<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Role;
use App\Rules\CurrentPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ApiUserController extends Controller
{

    public function __construct()
    {
        $this->middleware('cors');
    }

    public function index()
    {
        return User::with('roles')->get();
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'username' => 'required|string|max:20|unique:users',
            'full_name' => 'required|string|max:30',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $role = Role::where('name', $request->input('role'))->first();

        $user = new User();
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        if ($request->has('full_name')) {
            $user->full_name = $request->input('full_name');
        }
        if ($request->has('entity')) {
            $user->entity = $request->input('entity');
        }
        $user->roles()->associate($role);
        $user->save();

        //Logger::log('create', 'user', $user->id, $user->username);

        return response()->json('El usuario ha sido creado correctamente.', 201);
    }


    public function show(User $user){
        $user->load('roles');
        return $user;
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(),[
            'username' => ['required','string','max:20', Rule::unique('users')->ignore($id)],
            'email' => ['required','string','email','max:255', Rule::unique('users')->ignore($id)],
            'password' => 'nullable|string|min:8|confirmed'
        ])->validate();

        $user = User::find($id);
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        if ($request->has('full_name')) {
            $user->full_name = $request->input('full_name');
        }
        if ($request->has('entity')) {
            $user->entity = $request->input('entity');
        }
        if($request->input('password') != null){
            $user->password = Hash::make($request->input('password'));
        }

        if ($request->has('role')) {
            $role = Role::where('name', $request->input('role'))->first();
            $user->roles()->associate($role);
        }

        $user->save();

        //Logger::log('update', 'user', $user->id, $user->username);

        return response()->json('El usuario ha sido modificado correctamente.', 204);
    }

    public function destroy(Request $request, $id)
    {
        if(Auth::user()->id == $id){ //TODO verificar si es el usuario con api_token
            return response()->json('No puede eliminar su propio usuario.', 422); // TODO revisar codigo
        }

        $user = User::find($id);
        $name = $user->username;
        $user->delete();

        //Logger::log('delete', 'user', $user->id, $name);

        return response()->json('El usuario ha sido eliminado correctamente.', 204);
    }

    public function changePassword(Request $request, $id){

        $validator = Validator::make($request->all(),[
            'old_password' => ['required','string','min:8', new CurrentPassword()],
            'password' => 'required|string|min:8|confirmed'
        ])->validate();

        $user = User::find($id);
        $user->password = Hash::make($request->input('password'));
        $user->save();

        //Logger::log('password_change', 'users', $user->id, $user->username);

        return response()->json('La contraseña se ha cambiado correctamente.', 204);

    }

    public function trashed()
    {
        return User::onlyTrashed()->get();
    }

    public function recover($id)
    {
        $user = User::withTrashed()->find($id);

        if ($user->trashed()) {
            $user->restore();
            return response()->json('El usuario ha sido recuperado correctamente.', 204);
        }else {
            //TODO codigo
            return response()->json('El usuario no existe o ya ha sido recuperado.', 204);
        }
    }

    public function roles()
    {
        return Role::with('access_level')->get();
    }

}
