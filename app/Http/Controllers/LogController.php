<?php

namespace App\Http\Controllers;

use App\Log;
use App\LogType;
use App\User;
use Illuminate\Http\Request;

class LogController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
        $this->middleware('user.has.role:manager,manager')->only('index', 'filter');
        $this->middleware('user.has.role:manager,director,coord.acad,coord.alt')->only('stats');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::withTrashed()->get();
        $log_types = LogType::all();
        $logs = Log::orderBy('created_at','DESC')->get();

        return view('log.index', ['logs' => $logs,
                                  'users' => $users,
                                  'log_types' => $log_types,
                                  'filtered' => false]);
    }

     /**
     * Filters the resources.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter(Request $request)
    {
        $logs = Log::with('log_type');
        $log_types = LogType::all();

        $filtered = false;

        if ($request->has('name')) {
            $name = $request->input('name');
            if (trim($name) != '') {
                $logs->filterUser($name);
                $filtered = true;
            }
        }
        if ($request->has('log_types')) {
            $logTypes = $request->input('log_types');
            $logs->filterLogTypes($logTypes);
            $filtered = true;
        }

        if ($filtered) {
            $users = User::withTrashed()->get();

            return view('log.index', ['logs' => $logs->get(),
                                      'users' => $users,
                                      'log_types' => $log_types,
                                      'filtered' => $filtered]);
        } else {
            return redirect()->route('log.index');
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function show(Log $log)
    {
        //TODO
    }

    public function stats()
    {

        return view('log.stats');
    }

}
