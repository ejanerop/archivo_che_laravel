<?php

use Illuminate\Database\Seeder;
use App\LogType;

class LogTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $logType = new LogType();
        $logType->slug = 'create';
        $logType->type = 'Inserción';
        $logType->save();

        $logType = new LogType();
        $logType->slug = 'read';
		$logType->type = 'Acceso';
        $logType->save();

        $logType = new LogType();
        $logType->slug = 'update';
		$logType->type = 'Actualización';
        $logType->save();

        $logType = new LogType();
        $logType->slug = 'delete';
		$logType->type = 'Borrado';
        $logType->save();

        $logType = new LogType();
        $logType->slug = 'download';
		$logType->type = 'Descarga';
        $logType->save();

        $logType = new LogType();
        $logType->slug = 'request';
		$logType->type = 'Petición';
        $logType->save();

        $logType = new LogType();
        $logType->slug = 'permit';
		$logType->type = 'Petición concedida';
        $logType->save();

        $logType = new LogType();
        $logType->slug = 'deny';
		$logType->type = 'Petición denegada';
        $logType->save();

        $logType = new LogType();
        $logType->slug = 'login';
		$logType->type = 'Inicio de sesión';
        $logType->save();

        $logType = new LogType();
        $logType->slug = 'logout';
		$logType->type = 'Cierre de sesión';
        $logType->save();

        $logType = new LogType();
        $logType->slug = 'password_reset';
		$logType->type = 'Cambio de contraseña';
        $logType->save();
    }
}
