<?php

namespace App\Util;

use App\Document;
use App\User;

class Stats
{
	public static function documentsCount()
    {
        $count = Document::all()->count();
        return $count;
    }

    public static function usersCount()
    {
        $count = User::all()->count();
        return $count;
    }
}
