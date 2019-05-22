@extends('layouts.app')

@section('content')

    <section class="content-header">
        <div class="container">
            <h3> Subtemas de investigación</h3>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><span class="fa fa-check"></span></h4>
                        <strong>{{ session('success') }}</strong>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><span class="fa fa-ban"></span></h4>
                        <strong>{{ session('error') }}</strong>
                    </div>
                @endif
                <div class="box box-primary">
                    <div class="box-header">
                        <a href="{{route('subtopic.create')}}" class="btn btn-success pull-right"><span class="fa fa-plus"></span></a>
                    </div>
                    <div class="box-body">
                        <table id="table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Subtema</th>
                                    <th>Descripción</th>
                                    <th>Tema perteneciente</th>
                                    <th>Cantidad de documentos</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            @foreach($subtopics as $topic)
                                <tr>
                                    <td>{{$topic->name}}</td>
                                    <td>{{$topic->description}} </td>
                                    <td>{{$topic->research_topic->research_topic}}</td>
                                    <td>{{$topic->documents_count}}</td>
                                    <td>
                                        <form action="{{route('subtopic.destroy', ['subtopic' => $topic->id])}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{route('subtopic.edit', ['subtopic' => $topic->id])}}" class="btn btn-xs btn-info"><span class="fa fa-edit" style="margin-right: 2px"></span> Editar</a>
                                            <button type="submit" onclick="return confirm('Está seguro que desea eliminar el subtema {{$topic->name}}?')" class="btn btn-xs btn-danger"><span class="fa fa-remove" style="margin-right: 2px"></span> Eliminar</button>
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
        $('li#subtopic').addClass('active');
        $('li#subtopicList').addClass('active');
    </script>
@endsection