<?php

namespace App\Util;

use App\Document;
use App\DocumentType;
use App\ResearchTopic;
use App\User;

class Stats
{
	public static function documentsCount()
    {
        $count = Document::all()->count();
        return $count;
    }

    public static function usersCount()
    {
        $count = User::all()->count();
        return $count;
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
}
