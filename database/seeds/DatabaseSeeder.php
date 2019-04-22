<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(ResourceTypeTableSeeder::class);
        $this->call(DocumentTypeTableSeeder::class);
        $this->call(AccessLevelTableSeeder::class);
        $this->call(ResearchTopicTableSeeder::class);
        $this->call(SubtopicTableSeeder::class);
    }
}
