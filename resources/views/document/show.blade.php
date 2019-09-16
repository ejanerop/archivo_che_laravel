@extends('layouts.app')

@section('content')

    <section class="content-header">

    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-header">

            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input id="name" name="name" type="text" class="form-control" value="{{$document->name}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="document_type">Tipo de documento</label>
                            <input type="text" id="document_type" name="document_type" class="form-control" value="{{$document->document_type->document_type}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="date">Fecha</label>
                            <input type="text" id="date" name="date" class="form-control" value="{{date('d-M-Y',strtotime($document->date))}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="access_level">Nivel de acceso</label>
                            <input type="text" id="access_level" name="access_level" class="form-control" value="{{$document->access_level->name}}" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description">Descripción</label>
                            <textarea id="description" name="description" rows="5" class="form-control" style="resize:none" readonly >{{$document->description}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="description">Subtemas relacionados</label>
                        <table class="table table-bordered">
                            <thead>
                            </thead>
                            <tbody>
                            @foreach($document->subtopics as $subtopic)
                                <tr>
                                    <td>{{$subtopic->name}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                @if($document->document_type->resource_type->resource_type == 'Imagen')
                    <img src="{{asset($mainResource->path)}}" alt="sd">
                @elseif($document->document_type->resource_type->resource_type == 'Audio')
                    <audio controls>
                        <source src="{{asset($mainResource->path)}}" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                @elseif($document->document_type->resource_type->resource_type == 'Video')
                    <video width="320" height="240" controls>
                        <source src="{{asset($mainResource->path)}}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @else
                    <label for="text" hidden>Texto</label>
                    <textarea id="text" name="text" class="text_area">
                        {{$mainResource->text->text}}
                    </textarea>
                @endif
            </div>
        </div>
    </section>

    <script>
        $('.text_area').richText({
            urls: false,
            table: false,
            fontColor: false,
            fontSize: false,
            imageUpload: false,
            fileUpload: false,
            videoEmbed: false,
            bold: false,
            italic: false,
            underline: false,
            leftAlign: false,
            centerAlign: false,
            rightAlign: false,
            justify: false,
            ol: false,
            ul: false,
            heading: false,
            fonts: false,
            removeStyles: false,
            code: false,
        });
        $('div.richText-editor').attr('contenteditable', 'false');
    </script>

@endsection