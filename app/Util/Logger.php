<?php

namespace App\Util;

use App\Log;
use App\LogType;
use Illuminate\Support\Facades\Auth;

class Logger
{
	public static function log($action, $table, $object_id, $objectName) {
        $log = new Log();
        $logType = LogType::where('slug', $action)->first();
		$log->user()->associate(Auth::user());
		$log->ip_address = $_SERVER['REMOTE_ADDR'];
		$log->log_type()->associate($logType);
		$log->object_type = $table;
        $log->object_id = $object_id;
        $log->object_name = $objectName;
		$log->save();
	}
}
