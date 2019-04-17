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
        $role->save();

        $role = new Role();
        $role->name = 'Administrador';
        $role->save();

        $role = new Role();
        $role->name = 'Director';
        $role->save();

        $role = new Role();
        $role->name = 'Gestor Documental';
        $role->save();

        $role = new Role();
        $role->name = 'Coordinador de proyectos alternativos';
        $role->save();

        $role = new Role();
        $role->name = 'Cordinador Académico';
        $role->save();
    }
}
