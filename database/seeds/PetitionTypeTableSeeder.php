<?php

use Illuminate\Database\Seeder;
use App\PetitionType;

class PetitionTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $petitionType = new PetitionType();
        $petitionType->slug = 'research_topic';
        $petitionType->type = 'Tema de investigación';
        $petitionType->save();

        $petitionType = new PetitionType();
        $petitionType->slug = 'subtopic';
        $petitionType->type = 'Subtema de investigación';
        $petitionType->save();

        $petitionType = new PetitionType();
        $petitionType->slug = 'stage';
        $petitionType->type = 'Etapa cronológica';
        $petitionType->save();

        $petitionType = new PetitionType();
        $petitionType->slug = 'document_type';
        $petitionType->type = 'Tipo de documento';
        $petitionType->save();
    }
}
