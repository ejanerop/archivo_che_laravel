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
        $access_level->description = 'Visible para cualquier usuario';
        $access_level->save();

        $access_level = new AccessLevel();
        $access_level->name = 'Solo investigadores';
        $access_level->description = 'Visible para investigadores';
        $access_level->save();
    }
}
