<?php

use Illuminate\Database\Seeder;
use \App\Subtopic;
use \App\ResearchTopic;

class SubtopicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $research_topic = \App\ResearchTopic::find(1);

        $subtopic = new Subtopic();
        $subtopic->name = 'Subtematica 1';
        $subtopic->description = 'Ssdòka difjapuidfba0iudfbaiudsfbadfuiabfica 1';
        $subtopic->research_topic()->associate($research_topic);
        $subtopic->save();

        $subtopic = new Subtopic();
        $subtopic->name = 'Subtematica 2';
        $subtopic->description = 'Ssdòka difjapuidfba0iudfbaiudsfbadfuiabfica 1';
        $subtopic->research_topic()->associate($research_topic);
        $subtopic->save();

    }
}
