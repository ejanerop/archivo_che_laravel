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
        $research_topic->description = 'El Che como luchador en la Sierra';
        $research_topic->save();

        $research_topic = new ResearchTopic();
        $research_topic->research_topic = 'Che Fotógrafo';
        $research_topic->description = 'El Che como fotógrafo';
        $research_topic->save();

        $research_topic = new ResearchTopic();
        $research_topic->research_topic = 'Medicina';
        $research_topic->description = 'Documentos realcionados con la vida como médico del Che';
        $research_topic->save();
    }
}
