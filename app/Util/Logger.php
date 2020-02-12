<?php

namespace App\Util;

use App\Log;

class Logger 
{
	public static function log($action, $ip, $table, $object) {
		$log = new Log();
		$log->user = \Illuminate\Support\Facades\Auth::user()->username;
		$log->ip_address = $ip;
		$log->action = $action;
		$log->table = $table;
		$log->object = $object;
		$log->save();
	}
}