@extends('layouts.app')

@section('content')

    <section class="content-header">
        <div class="container">
            <h2>Nuevo subtema de investigación</h2>
        </div>
    </section>

    <section class="content">
        <div class="row justify-content-center">
            <div class="col-md-12 form-box">
                <div class="box box-primary width-auto">
                    <div class="box-header"></div>
                    <form method="POST" action="/subtopic">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" id="name" name="name" class="form-control" value="{{$subtopic->name}}" placeholder="Temática" style="display: inline-block" required>
                            </div>
                            <div class="form-group">
                                    <label for="description">Descripción</label>
                                    <textarea id="description" name="description" class="form-control" rows="3" placeholder="Descripción del tema" style="resize: none; display: inline-block"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="research_topic">Tema de investigación relacionado</label>
                                    <select id="research_topic" name="research_topic" class="form-control">
                                        @foreach($research_topics as $topic)
                                            <option id="{{$topic->id}}">{{$topic->research_topic}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="box-footer">
                                <button type="button" class="btn btn-danger btn-flat pull-left">
                                    <span class="glyphicon glyphicon-remove"></span>
                                    {{ __('Limpiar') }}
                                </button>
                                <button type="submit" class="btn btn-primary btn-flat pull-right">
                                    <span class="glyphicon glyphicon-floppy-save"></span>
                                    {{ __('Guardar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection