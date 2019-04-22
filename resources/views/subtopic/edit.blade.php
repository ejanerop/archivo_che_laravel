@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Editar Subtema') }}</div>

                    <div class="card-body">
                        <form method="POST" action="" enctype="multipart/form-data">
                            <div class="form-body">
                                <div class="form-group">
                                    <label for="subtopic">Nombre</label>
                                    <input type="text" id="subtopic" class="form-control col-md-8" placeholder="Temática" value="{{$subtopic->name}}">
                                </div>

                                <div class="form-group">
                                    <label for="description">Descripción</label>
                                    <textarea id="description" class="form-control col-md-8" rows="3" placeholder="Descripción del tema"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="research_topic">Tema de investigación</label>
                                    <select id="research_topic" class="form-control col-md-8">
                                        @foreach($research_topics as $topic)
                                            <option id="{{$topic->id}}" {{$subtopic->research_topic->id == $topic->id ? 'selected' : ''}} >{{$topic->research_topic}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="">
                                <button type="submit" class="btn btn-primary">Crear</button>
                                <button type="button" class="btn btn-secondary">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection