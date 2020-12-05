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

        $user = new User();
        $user->username = 'guest';
        $user->full_name = 'guest';
        $user->email = 'guest@gmail.com';
        $user->password = bcrypt('12345678');
        $user->roles()->associate(Role::where('slug', 'guest')->first());
        $user->save();

        $user = new User();
        $user->username = 'gestor';
        $user->full_name = 'guest';
        $user->email = 'gestor@gmail.com';
        $user->password = bcrypt('12345678');
        $user->roles()->associate(Role::where('slug', 'manager')->first());
        $user->save();

        $user = new User();
        $user->username = 'Daina';
        $user->full_name = 'Daina Rodriguez';
        $user->email = 'daina@gmail.com';
        $user->password = bcrypt('12345678');
        $user->roles()->associate(Role::where('slug', 'inv.int')->first());
        $user->save();

        $user = new User();
        $user->username = 'Eric';
        $user->full_name = 'Eric Janero';
        $user->email = 'eric@gmail.com';
        $user->password = bcrypt('12345678');
        $user->roles()->associate(Role::where('slug', 'inv.int')->first());
        $user->save();

        $user = new User();
        $user->username = 'Camilo';
        $user->full_name = 'guest';
        $user->email = 'camilo@gmail.com';
        $user->password = bcrypt('12345678');
        $user->roles()->associate(Role::where('slug', 'coord.alt')->first());
        $user->save();

        $user = new User();
        $user->username = 'Maria';
        $user->full_name = 'guest';
        $user->email = 'maria@gmail.com';
        $user->password = bcrypt('12345678');
        $user->roles()->associate(Role::where('slug', 'coord.acad')->first());
        $user->save();

        $user = new User();
        $user->username = 'director';
        $user->full_name = 'guest';
        $user->email = 'director@gmail.com';
        $user->password = bcrypt('12345678');
        $user->roles()->associate(Role::where('slug', 'director')->first());
        $user->save();


    }
}
