@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            Documentos
            <small>Mostrar</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('home')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li><i class="fa fa-file-text"></i> Documentos</li>
            <li class="active"> {{$document->name}}</li>
        </ol>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-header">
                <a href="{{URL::previous()}}" class="btn btn-primary pull-left">
                    <span class="fa fa-reply"></span>
                    Atrás
                </a>
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
                            <input type="text" id="date" name="date" class="form-control" value="{{$document->date_formated}}" readonly>
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
                <div class="row">
                    <div class="col-md-3">
                        <a class="btn btn-primary" href="{{route('file', ['folder' => $mainResource->type, 'file' => $mainResource->path])}}" target="_blank">Mostrar</a>
                    </div>
                    <div class="col-md-6"></div>
                    @if($document->document_type->resource_type->resource_type == 'Texto')
                    <div class="col-md-3">
                        <a class="btn btn-primary pull-right" href="" target="_blank">Mostrar facsímiles</a>
                    </div>
                    @endif
                </div>
            </div>
            <div class="box-footer">
                @if($document->document_type->resource_type->resource_type == 'Imagen')
                    <img src="{{route('file', ['folder' => $mainResource->type, 'file' => $mainResource->path])}}" alt="sd" width="100%">
                @elseif($document->document_type->resource_type->resource_type == 'Audio')
                    <audio controls>
                        <source src="{{route('file', ['folder' => $mainResource->type, 'file' => $mainResource->path])}}" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                @elseif($document->document_type->resource_type->resource_type == 'Video')
                    <video width="320" height="240" controls>
                        <source src="{{route('file', ['folder' => $mainResource->type, 'file' => $mainResource->path])}}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @else
                    <label for="text" hidden>Texto</label>
                    <embed src="{{route('file', ['folder' => $mainResource->type, 'file' => $mainResource->path])}}" width="100%" height="700" type="application/pdf">
                @endif
            </div>
        </div>
    </section>

    <script src="{{asset('js/scripts/document/show.js')}}"></script>

@endsection
