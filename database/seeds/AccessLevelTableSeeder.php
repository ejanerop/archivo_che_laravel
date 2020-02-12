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
        $access_level->description = 'Visible para cualquier usuario';
        $access_level->save();

        $access_level = new AccessLevel();
        $access_level->name = 'Investigadores';
        $access_level->level = 2;
        $access_level->description = 'Visible para investigadores externos';
        $access_level->save();

        $access_level = new AccessLevel();
        $access_level->name = 'Investigadores internos';
        $access_level->level = 3;
        $access_level->description = 'Visible para investigadores internos';
        $access_level->save();

        $access_level = new AccessLevel();
        $access_level->name = 'Gestor';
        $access_level->level = 4;
        $access_level->description = 'Visible para el gestor documental, coordinadores y director';
        $access_level->save();
        
    }
}
