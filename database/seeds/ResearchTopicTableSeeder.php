<?php

use Illuminate\Database\Seeder;
use \App\ResearchTopic;

class ResearchTopicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $research_topic = new ResearchTopic();
        $research_topic->research_topic = 'Lucha Revolucionaria';
        $research_topic->description = 'loasdihbdfuydbfu uay fbvausdyf bauodsfybasuydfbaosf yasb fsuay bfo';
        $research_topic->save();

        $research_topic = new ResearchTopic();
        $research_topic->research_topic = 'Che Fotógrafo';
        $research_topic->description = 'loasdihbdfuydbfu uay fbvausdyf bauodsfybasuydfbaosf yasb fsuay bfo';
        $research_topic->save();
    }
}
