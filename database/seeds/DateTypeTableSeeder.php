<?php

use App\DateType;
use Illuminate\Database\Seeder;

class DateTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dateType = new DateType();
        $dateType->slug = 'full_date';
        $dateType->type = 'Fecha completa';
        $dateType->save();

        $dateType = new DateType();
        $dateType->slug = 'month_year';
        $dateType->type = 'Mes y año';
        $dateType->save();

        $dateType = new DateType();
        $dateType->slug = 'year';
        $dateType->type = 'Año';
        $dateType->save();

        $dateType = new DateType();
        $dateType->slug = 'lapse';
        $dateType->type = 'Período de tiempo';
        $dateType->save();

        $dateType = new DateType();
        $dateType->slug = 'year_lapse';
        $dateType->type = 'Intervalo de años';
        $dateType->save();
    }
}
