<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_guest = Role::where('name', 'Invitado')->first();
        $role_admin = Role::where('name', 'Administrador')->first();
        $role_gestor = Role::where('name', 'Gestor Documental')->first();

        $user = new User();
        $user->username = 'guest';
        $user->email = 'guest@gmail.com';
        $user->password = bcrypt('12345678');
        $user->roles()->associate($role_guest);
        $user->save();

        $user = new User();
        $user->username = 'admin';
        $user->email = 'admin@gmail.com';
        $user->password = bcrypt('12345678');
        $user->roles()->associate($role_admin);
        $user->save();

        $user = new User();
        $user->username = 'gestor';
        $user->email = 'gestor@gmail.com';
        $user->password = bcrypt('12345678');
        $user->roles()->associate($role_gestor);
        $user->save();


    }
}
