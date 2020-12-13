<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomDate extends Model
{
    public function document() {
        return $this->hasOne('App\Document');
    }

    public function date_type() {
        return $this->belongsTo('App\DateType', 'date_type_id');
    }

    private function month($month) {
        switch ($month) {
            case '1':
                $monthText = 'enero';
                break;

            case '2':
                $monthText = 'febrero';
                break;

            case '3':
                $monthText = 'marzo';
                break;

            case '4':
                $monthText = 'abril';
                break;

            case '5':
                $monthText = 'mayo';
                break;

            case '6':
                $monthText = 'junio';
                break;

            case '7':
                $monthText = 'julio';
                break;

            case '8':
                $monthText = 'agosto';
                break;

            case '9':
                $monthText = 'septiembre';
                break;

            case '10':
                $monthText = 'octubre';
                break;

            case '11':
                $monthText = 'noviembre';
                break;

            case '12':
                $monthText = 'diciembre';
                break;

            default:
                $monthText = 'enero';
                break;
        }

        return $monthText;

    }

    public function getDateStartAttribute() {

        $day = $this->dayStart != '' ? $this->dayStart : '1' ;
        $month = $this->monthStart != '' ? $this->monthStart : '1' ;
        $year = $this->yearStart;

        $date = date('Y-m-d', strtotime($day . '-' . $month . '-'. $year));

        return $date;

    }

    public function getDateEndAttribute() {

        $day = $this->dayEnd != '' ? $this->dayEnd : '1' ;
        $month = $this->monthEnd != '' ? $this->monthEnd : '1' ;
        $year = $this->yearEnd;

        $date = date('Y-m-d', strtotime($day . '-' . $month . '-'. $year));

        return $date;
    }

    public function getDateFormattedAttribute() {

        if ($this->date_type->slug == 'full_date') {

            $day = $this->dayStart;
            $month = $this->month($this->monthStart);
            $year = $this->yearStart;

            $date = $day . ' de ' . $month . ' de ' . $year;

        } elseif ($this->date_type->slug == 'month_year') {

            $month = $this->month($this->monthStart);
            $year = $this->yearStart;

            $date = $month . ' de ' . $year;

        } elseif ($this->date_type->slug == 'year') {

            $year = $this->yearStart;

            $date = $year;

        } elseif ($this->date_type->slug == 'year_lapse') {

            $yearStart = $this->yearStart;
            $yearEnd = $this->yearEnd;

            $date = $yearStart . ' - ' . $yearEnd;

        } else {

            $dayStart = $this->dayStart != '' ? $this->dayStart . ' de ' : '' ;
            $monthStart = $this->month($this->monthStart);
            $yearStart = $this->yearStart;
            $dayEnd = $this->dayEnd != '' ? $this->dayEnd . ' de ' : '' ;
            $monthEnd = $this->month($this->monthEnd);
            $yearEnd = $this->yearEnd;

            $date = $dayStart . $monthStart . ' de ' . $yearStart . ' - ' . $dayEnd . $monthEnd . ' de ' . $yearEnd;

        }

        return $date;

    }
}
