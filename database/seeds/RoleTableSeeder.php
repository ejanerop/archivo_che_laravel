<?php

use App\AccessLevel;
use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accessLevel = AccessLevel::where('level', 1)->first();

        $role = new Role();
        $role->name = 'Invitado';
        $role->slug = 'guest';
        $role->access_level()->associate($accessLevel);
        $role->save();

        $role = new Role();
        $role->name = 'Administrador';
        $role->slug = 'admin';
        $role->access_level()->associate($accessLevel);
        $role->save();

        $accessLevel = AccessLevel::where('level', 4)->first();

        $role = new Role();
        $role->name = 'Director';
        $role->slug = 'director';
        $role->access_level()->associate($accessLevel);
        $role->save();

        $role = new Role();
        $role->name = 'Gestor Documental';
        $role->slug = 'manager';
        $role->access_level()->associate($accessLevel);
        $role->save();

        $role = new Role();
        $role->name = 'Coordinador de proyectos alternativos';
        $role->slug = 'coord.alt';
        $role->access_level()->associate($accessLevel);
        $role->save();

        $role = new Role();
        $role->name = 'Cordinador Académico';
        $role->slug = 'coord.acad';
        $role->access_level()->associate($accessLevel);
        $role->save();

        $accessLevel = AccessLevel::where('level', 3)->first();

        $role = new Role();
        $role->name = 'Investigador interno';
        $role->slug = 'inv.int';
        $role->access_level()->associate($accessLevel);
        $role->save();

        $accessLevel = AccessLevel::where('level', 2)->first();

        $role = new Role();
        $role->name = 'Investigador externo';
        $role->slug = 'inv.ext';
        $role->access_level()->associate($accessLevel);
        $role->save();
    }
}
