<?php

namespace App\Util;

use App\Log;
use App\LogType;

class Logger
{
	public static function log($action, $table, $object, $objectName) {
        $log = new Log();
        $logType = LogType::where('slug', $action)->first();
		$log->user = \Illuminate\Support\Facades\Auth::user()->username;
		$log->ip_address = $_SERVER['REMOTE_ADDR'];
		$log->log_type()->associate($logType);
		$log->object_table = $table;
        $log->object = $object;
        $log->object_name = $objectName;
		$log->save();
	}
}
