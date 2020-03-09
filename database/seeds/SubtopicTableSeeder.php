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
        $research_topic = ResearchTopic::find(1);

        $subtopic = new Subtopic();
        $subtopic->name = 'Subtematica 1';
        $subtopic->description = 'Descripción';
        $subtopic->research_topic()->associate($research_topic);
        $subtopic->save();

        $research_topic = ResearchTopic::find(2);

        $subtopic = new Subtopic();
        $subtopic->name = 'Subtematica 2';
        $subtopic->description = 'Descripción';
        $subtopic->research_topic()->associate($research_topic);
        $subtopic->save();

        $research_topic = ResearchTopic::find(3);

        $subtopic = new Subtopic();
        $subtopic->name = 'Subtematica 3';
        $subtopic->description = 'Descripción';
        $subtopic->research_topic()->associate($research_topic);
        $subtopic->save();

    }
}
