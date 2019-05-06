@extends('layouts.app')

@section('content')

    <section class="content-header">
        <div class="container">
            <h1>Temas de investigación</h1>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><span class="glyphicon glyphicon-ok"></span></h4>
                        <strong>{{ session('success') }}</strong>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><span class="glyphicon glyphicon-ban-circle"></span></h4>
                        <strong>{{ session('error') }}</strong>
                    </div>
                @endif
                <div class="box box-primary">
                    <div class="box-header">
                        <a href="{{route('research_topic.create')}}" class="btn btn-flat btn-success pull-right"><span class="glyphicon glyphicon-plus"></span>Nuevo</a>
                    </div>
                    <div class="box-body">
                        <table id="table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tema de investigación</th>
                                    <th>Descripción</th>
                                    <th>Cantidad de subtemas</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            @foreach($research_topics as $topic)
                                <tr>
                                    <td>{{$topic->research_topic}}</td>
                                    <td>{{$topic->description}}</td>
                                    <td>{{$topic->subtopics_count}}</td>
                                    <td>
                                        <form action="/research_topic/{{$topic->id}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a href="/research_topic/{{$topic->id}}/edit" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-edit" style="margin-right: 2px"></span> Editar</a>
                                            <button type="submit" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove" style="margin-right: 2px"></span> Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(function () {
            $('#table').DataTable();
        });
        $('li.li').removeClass('active');
        $('li#topic').addClass('active');
        $('li#topicList').addClass('active');
    </script>

@endsection