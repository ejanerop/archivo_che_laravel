<?php

namespace App\Util;

use App\Log;
use App\LogType;

class Logger
{
	public static function log($action, $ip, $table, $object) {
        $log = new Log();
        $logType = LogType::where('slug', $action)->first();
		$log->user = \Illuminate\Support\Facades\Auth::user()->username;
		$log->ip_address = $ip;
		$log->log_type()->associate($logType);
		$log->table = $table;
		$log->object = $object;
		$log->save();
	}
}
