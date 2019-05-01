<?php

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
        $role = new Role();
        $role->name = 'Invitado';
        $role->slug = 'guest';
        $role->save();

        $role = new Role();
        $role->name = 'Administrador';
        $role->slug = 'admin';
        $role->save();

        $role = new Role();
        $role->name = 'Director';
        $role->slug = 'director';
        $role->save();

        $role = new Role();
        $role->name = 'Gestor Documental';
        $role->slug = 'manager';
        $role->save();

        $role = new Role();
        $role->name = 'Coordinador de proyectos alternativos';
        $role->slug = 'coord.alt';
        $role->save();

        $role = new Role();
        $role->name = 'Cordinador Académico';
        $role->slug = 'coord.acad';
        $role->save();
    }
}
