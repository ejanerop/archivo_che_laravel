<?php

namespace App\Util;

use App\Document;
use App\DocumentType;
use App\Log;
use App\LogType;
use App\Petition;
use App\PetitionState;
use App\ResearchTopic;
use App\Role;
use App\Subtopic;
use App\User;

class Stats
{
	public static function documentsCount()
    {
        return Document::all()->count();
    }


    public static function topicsCount()
    {
        return ResearchTopic::all()->count();
    }

    public static function subtopicsCount()
    {
        return Subtopic::all()->count();
    }


    public static function usersCount()
    {
        return User::all()->count();
    }

    public static function userCountByRole(String $slug)
    {
        $count = User::where('role_id', Role::where('slug', $slug)->first()->id)->count();

        return $count;
    }

    public static function docsAccessCount()
    {
        $count = Log::where('log_type_id', LogType::where('slug', 'read')->first()->id)->where('object_type', 'document')->count();

        return $count;
    }

    public static function docsAccessCountByRole(String $role)
    {
        $count = Log::whereHas('user', function ($q) use ($role) {
            $q->where('role_id', Role::where('slug', $role)->first()->id);
        })->where('log_type_id', LogType::where('slug', 'read')->first()->id)->where('object_type', 'document')->count();

        return $count;
    }

    // TODO
    public static function accessedDocsCount()
    {
        $count = Log::where('log_type_id', LogType::where('slug', 'read')->first()->id)->where('object_type', 'document')->get();


        return $count->unique('object_id')->count();
    }




    public static function typesWithAccess()
    {
        $arr = collect();
        $docTypes = DocumentType::all();
        foreach ($docTypes as $doctype) {
            $visits = 0;
            foreach ($doctype->documents as $doc) {
                $visits += $doc->visits;
            }
            $arr[$doctype->document_type] = $visits;
        }

        return $arr;
    }


    public static function typesWithCant()
    {
        $arr = collect();
        $docTypes = DocumentType::all();
        foreach ($docTypes as $doctype) {
            $arr[$doctype->document_type] = $doctype->related_documents_count;
        }

        return $arr;
    }


    public static function topicsWithAccess()
    {
        $arr = collect();
        $topics = ResearchTopic ::all();
        foreach ($topics as $topic) {
            $visits = 0;
            foreach ($topic->documents as $doc) {
                $visits += $doc->visits;
            }
            $arr[$topic->research_topic] = $visits;
        }

        return $arr;
    }


    public static function topicsWithCant()
    {
        $arr = collect();
        $topics = ResearchTopic::all();
        foreach ($topics as $topic) {
            $arr[$topic->research_topic] = $topic->documents_count;
        }

        return $arr;
    }


    public static function last5Petitions()
    {
        $id = PetitionState::where('slug', 'made')->first()->id;
        $petitions = Petition::where('petition_state_id', $id)->orderBy('created_at', 'DESC')->limit(5)->get();

        return $petitions;
    }


    public static function top5Subtopics()
    {
        $top5Subtopics = Subtopic::all();
        $top5Subtopics = $top5Subtopics->sortByDesc('visits')->take(5);

        return $top5Subtopics;
    }


    public static function top5Docs()
    {
        $top5Docs = Document::withCount(['logs as visits' => function ($query) {
            $query->where('log_type_id', '2');
        }])->orderBy('visits', 'DESC')->limit(5)->get();

        return $top5Docs;
    }


    public static function visitorsToday()
    {
        $logs = Log::filterToday()->get();
        $logs = $logs->unique('user');

        return $logs->count();
    }

    public static function userMostVisits()
    {
        $user = User::withCount(['logs as visits' => function ($query) {
            $query->where('log_type_id', LogType::where('slug', 'read')->first()->id);
        }])->orderBy('visits', 'DESC')->first();

        return $user;
    }



}
