<?php

use Illuminate\Database\Seeder;
use App\Stage;

class StageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stage = new Stage();
        $stage->name = 'Niñez y adolescencia (1929-1944)';
        $stage->date_start = date('Y-m-d', strtotime('14-06-1928'));
        $stage->date_end = date('Y-m-d', strtotime('13-06-1944'));
        $stage->save();

        $stage = new Stage();
        $stage->name = 'Primera juventud (1944-1953)';
        $stage->date_start = date('Y-m-d', strtotime('14-06-1944'));
        $stage->date_end = date('Y-m-d', strtotime('13-06-1953'));
        $stage->save();

        $stage = new Stage();
        $stage->name = 'Etapa de adulto-joven (1953-1958)';
        $stage->date_start = date('Y-m-d', strtotime('14-06-1953'));
        $stage->date_end = date('Y-m-d', strtotime('13-06-1958'));
        $stage->save();

        $stage = new Stage();
        $stage->name = 'Etapa de adulto (1958-1967)';
        $stage->date_start = date('Y-m-d', strtotime('14-06-1958'));
        $stage->date_end = date('Y-m-d', strtotime('9-10-1967'));
        $stage->save();

        $stage = new Stage();
        $stage->name = '1968 en adelante';
        $stage->date_start = date('Y-m-d', strtotime('10-10-1967'));
        $stage->date_end = date('Y-m-d', strtotime('12-12-2030'));
        $stage->save();
    }
}
