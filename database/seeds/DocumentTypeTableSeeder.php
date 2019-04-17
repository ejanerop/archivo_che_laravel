<?php

use Illuminate\Database\Seeder;
use \App\ResourceType;
use \App\DocumentType;

class DocumentTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $resource_type_text = ResourceType::where('resource_type', 'Texto')->first();
        $resource_type_image = ResourceType::where('resource_type', 'Imagen')->first();
        $resource_type_audio = ResourceType::where('resource_type', 'Audio')->first();
        $resource_type_video = ResourceType::where('resource_type', 'Video')->first();

        $type = new DocumentType();
        $type->document_type = 'Apuntes';
        $type->resource_type()->associate($resource_type_text);
        $type->save();

        $type = new DocumentType();
        $type->document_type = 'Album';
        $type->resource_type()->associate($resource_type_image);
        $type->save();

        $type = new DocumentType();
        $type->document_type = 'Poema';
        $type->resource_type()->associate($resource_type_audio);
        $type->save();

        $type = new DocumentType();
        $type->document_type = 'Documental';
        $type->resource_type()->associate($resource_type_video);
        $type->save();

    }
}
