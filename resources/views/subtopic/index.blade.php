@extends('layouts.app')

@section('content')

    <section class="content-header">
        <div class="container">
            <h1> Subtemas de investigación</h1>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header"></div>
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
                                        <form action="/subtopic/{{$topic->id}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a href="/subtopic/{{$topic->id}}/edit" class="btn btn-info btn-flat">Modificar</a>
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