@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            Temas de investigación
            <small>Editar tema</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('home')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="{{route('research_topic.index')}}"><i class="fa fa-book"></i> Temas de investigación</a></li>
            <li class="active">Editar {{$researchTopic->research_topic}}</li>
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
                <div class="box box-primary width-auto">
                    <div class="box-header">
                        <h4>Editar tema de investigación</h4>
                    </div>
                    <form id="topic"method="POST" action="{{route('research_topic.update', ['research_topic' => $researchTopic->id])}}">
                        @method('PUT')
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="research_topic">Tema de investigación</label>
                                <input type="text" id="research_topic" name="research_topic" class="form-control" placeholder="Nombre del tema de investigación" value="{{$researchTopic->research_topic}}" style="display: inline-block" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Descripción</label>
                                <textarea id="description" name="description" class="form-control" rows="4" style="resize: none" placeholder="Descripción del tema">{{$researchTopic->description}}</textarea>
                            </div>
                            <div class="box-footer">
                                <a href="{{route('research_topic.index')}}" class="btn btn-danger pull-left">
                                    <span class="fa fa-remove"></span>
                                    {{ __('Cancelar') }}
                                </a>
                                <button type="submit" class="btn btn-primary pull-right">
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
        $('li#topic').addClass('active');
        $('li#topicList').addClass('active');
        $('#topic').validate({
            rules: {
                research_topic: {
                    required: true,
                    maxlength: 191
                }
            },
            messages: {
                research_topic: {
                    required: "Debe llenar este campo",
                    maxlength: "El nombre del tema no puede exceder los 191 caracteres"
                }
            }
        });
    </script>

@endsection
