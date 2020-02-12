<?php

use Illuminate\Database\Seeder;
use App\PetitionState;

class PetitionStateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $petitionState = new PetitionState();
        $petitionState->slug = 'approved';
        $petitionState->state = 'Aprobada';
        $petitionState->save();

        $petitionState = new PetitionState();
        $petitionState->slug = 'denied';
        $petitionState->state = 'Denegada';
        $petitionState->save();

        $petitionState = new PetitionState();
        $petitionState->slug = 'made';
        $petitionState->state = 'En espera';
        $petitionState->save();
    }
}
