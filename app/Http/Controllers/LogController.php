<?php

namespace App\Http\Controllers;

use App\Document;
use App\Log;
use App\Subtopic;
use Illuminate\Http\Request;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('log.index', ['logs' => Log::all()]);
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
