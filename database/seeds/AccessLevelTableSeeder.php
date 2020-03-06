<?php

use Illuminate\Database\Seeder;
use \App\AccessLevel;

class AccessLevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $access_level = new AccessLevel();
        $access_level->name = 'Público';
        $access_level->level = 1;
        $access_level->description = 'Visible para todos';
        $access_level->save();

        $access_level = new AccessLevel();
        $access_level->name = 'Ordinario';
        $access_level->level = 2;
        $access_level->description = 'Visible para todos menos invitado e investigador externo';
        $access_level->save();

        $access_level = new AccessLevel();
        $access_level->name = 'Limitado';
        $access_level->level = 3;
        $access_level->description = 'Visible para investigadores internos, gestor, coordinadores y director';
        $access_level->save();

        $access_level = new AccessLevel();
        $access_level->name = 'Secreto';
        $access_level->level = 4;
        $access_level->description = 'Visible para gestor, coordinadores y director';
        $access_level->save();

    }
}
