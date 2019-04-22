@extends('layouts.app')

@section('content')

    <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Inicio</a></li>
                <li class="breadcrumb-item"><a href="">Temas</a></li>
                <li class="breadcrumb-item"><a href="">Crear</a></li>
            </ol>
    </div>
    <div class="container">
        <table class="table table-bordered">
            <tr class="active">
                <th>Subtema</th>
                <th>Descripción</th>
                <th>Tema perteneciente</th>
                <th>Cantidad de documentos</th>
                <th>Acciones</th>
            </tr>
            @foreach($subtopics as $topic)
                <tr>
                    <td>{{$topic->name}}</td>
                    <td>{{$topic->description}} </td>
                    <td>{{$topic->research_topic->research_topic}}</td>
                    <td>15</td>
                    <td> <button class="btn-outline-info">Modificar</button> <button class="btn-outline-danger">Eliminar</button> </td>
                </tr>
            @endforeach

        </table>
    </div>

@endsection