@extends('layouts.app')

@section('content')

    <section class="content-header">
        <div class="container">
            <h1>Temas de investigación</h1>
        </div>
    </section>

    <section class="content">
        <table class="table table-bordered">
                <tr class="active">
                    <th>Tema de investigación</th>
                    <th>Descripción</th>
                    <th>Cantidad de documentos</th>
                    <th>Acciones</th>
                </tr>
                @foreach($research_topics as $topic)
                    <tr>
                        <td>{{$topic->research_topic}}</td>
                        <td>{{$topic->description}}</td>
                        <td>{{$topic->subtopics_count}}</td>
                        <td>
                            <form action="/research_topic/{{$topic->id}}" method="post">
                                @csrf
                                @method('DELETE')
                                <a href="/research_topic/{{$topic->id}}/edit" class="btn btn-info">Modificar</a>
                                <button type="submit" class="btn btn-danger"> Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </table>
    </section>

@endsection