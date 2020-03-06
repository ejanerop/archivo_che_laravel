<?php

namespace App\Http\Controllers;

use App\Document;
use App\Log;
use App\LogType;
use App\Subtopic;
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

        return view('log.index', ['logs' => Log::all(),
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function show(Log $log)
    {
        //
    }

    public function stats()
    {
        $top5Docs = Document::withCount(['logs as visits' => function ($query) {
            $query->where('log_type_id', '2');
        }])->orderBy('visits', 'DESC')->limit(5)->get();

        $top5Subtopics = Subtopic::all();
        $top5Subtopics = $top5Subtopics->sortByDesc('visits')->take(5);

        return view('log.stats', ['top5Docs' => $top5Docs,
                                  'top5Subtopics' => $top5Subtopics]);
    }

}
