@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            Subtemas de investigación
            <small>Nuevo subtema</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('home')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="{{route('subtopic.index')}}"><i class="fa fa-book"></i> Subtemas de investigación</a></li>
            <li class="active">Nuevo subtema</li>
        </ol>
    </section>

    <section class="content">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header">
                        <h4>Nuevo subtema</h4>
                    </div>
                    <form id="topic" method="POST" action="{{route('subtopic.store')}}">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">Nombre</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Temática" value="{{old('name')}}" required>
                            </div>
                            <div class="form-group">
                                    <label for="description">Descripción</label>
                                    <textarea id="description" name="description" class="form-control" rows="3" placeholder="Descripción del tema" style="resize: none">{{old('description')}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="research_topic">Tema de investigación relacionado</label>
                                <select id="research_topic" name="research_topic" class="form-control">
                                    @foreach($research_topics as $topic)
                                        <option id="{{$topic->id}}">{{$topic->research_topic}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="box-footer">
                                <a href="{{route('subtopic.index')}}" class="btn btn-danger pull-left">
                                    <span class="fa fa-remove"></span>
                                    {{ __('Cancelar') }}
                                </a>
                                <button type="submit" class="btn btn-success pull-right">
                                    <span class="fa fa-save"></span>
                                    {{ __('Guardar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </section>


    <script>
        $('li.li').removeClass('active');
        $('li#subtopic').addClass('active');
        $('li#subtopicCreate').addClass('active');
        $('#topic').validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 191
                }
            },
            messages: {
                name: {
                    required: "Debe llenar este campo",
                    maxlength: "El nombre del subtema no puede exceder los 191 caracteres"
                }
            }
        });
    </script>

@endsection
