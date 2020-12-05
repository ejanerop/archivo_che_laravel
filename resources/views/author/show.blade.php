@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            Autores
            <small>Lista de autores</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('home')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="{{route('research_topic.index')}}"><i class="fa fa-book"></i> Autores</a></li>
            <li class="active">{{$researchTopic->research_topic}}</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header">
                    </div>
                    <form id="topic" method="POST" action="">
                        @csrf
                        <div class="box-body">
                            <div class="form-group {{$errors->has('research_topic')?"has-error":""}}">
                                <label for="research_topic">Tema de investigación</label>
                                <input type="text" id="research_topic" name="research_topic" class="form-control" value="{{$researchTopic->research_topic}}" style="display: inline-block" disabled>
                            </div>
                            <div class="form-group">
                                <label for="description">Descripción</label>
                                <textarea id="description" name="description" class="form-control" rows="4" style="resize: none" placeholder="Descripción del tema" readonly>{{$researchTopic->description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="subtopics">Subtemas relacionados</label>
                                <table id="subtopics" class="table table-bordered table-condensed">
                                    <thead>
                                    </thead>
                                    <tbody>
                                        @foreach($subtopics as $subtopic)
                                        <tr>
                                            <td>{{$subtopic->name}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="box-footer">
                                <a href="{{URL::previous()}}" class="btn btn-primary pull-left">
                                    <span class="fa fa-reply"></span>
                                    {{ __('Atrás') }}
                                </a>
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
        $('li#topicCreate').addClass('active');
    </script>
@endsection
