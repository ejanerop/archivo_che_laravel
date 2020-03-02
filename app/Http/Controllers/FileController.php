<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class FileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getFile($folder, $file)
    {
        //This method will look for the file and get it from drive
        $path = storage_path('app\media\\' . $folder . '\\' . $file);
        try {
            $file = File::get($path);
            $type = File::mimeType($path);
            $response = Response::make($file, 200);
            $response->header("Content-Type", $type);
            return $response;
        } catch (FileNotFoundException $exception) {
            abort(403);
        }
    }
}
