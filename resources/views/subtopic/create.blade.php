@extends('layouts.app')

@section('content')

    <section class="content-header">
        <div class="container">
            <h2>Nuevo subtema de investigación</h2>
        </div>
    </section>

<section class="content">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="box box-primary">
                <div class="box-header"></div>
                <form method="POST" action="/subtopic">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <div class="input-group">
                                <label for="subtopic">Nombre</label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Temática">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label for="description">Descripción</label>
                                <textarea id="description" name="description" class="form-control" rows="3" placeholder="Descripción del tema" style="resize: none"></textarea>
                            </div>
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
                            <button type="reset" class="btn btn-warning btn-flat pull-left">
                                <span class="glyphicon glyphicon-erase"></span>
                                {{ __('Limpiar') }}
                            </button>
                            <button type="submit" class="btn btn-primary btn-flat pull-right">
                                <span class="glyphicon glyphicon-plus"></span>
                                {{ __('Crear') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection