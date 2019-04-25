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
                <div class="box box-primary">
                    <div class="box-header"></div>
                    <div class="box-body">
                        <table id="table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tema de investigación</th>
                                    <th>Descripción</th>
                                    <th>Cantidad de documentos</th>
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
                                            <a href="/research_topic/{{$topic->id}}/edit" class="btn btn-info btn-flat">Modificar</a>
                                            <button type="submit" class="btn btn-danger btn-flat"> Eliminar</button>
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
    </script>

@endsection