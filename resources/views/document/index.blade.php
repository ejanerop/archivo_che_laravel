@extends('layouts.app')

@section('content')

    <div class="container">
        <table class="table table-bordered">
            <tr class="active">
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Tipo de documento</th>
                <th>Tipo de recurso</th>
                <th>Nivel de acceso</th>
                <th>Acciones</th>
            </tr>
            @foreach($documents as $document)
                <tr>
                    <td>{{$document->name}}</td>
                    <td>{{$document->description}}</td>
                    <td>{{$document->document_type->document_type}}</td>
                    <td>{{$document->document_type->resource_type->resource_type}}</td>
                    <td>{{$document->access_level->name}}</td>
                    <td> <button class="btn-outline-info">Modificar</button> <button class="btn-outline-danger">Eliminar</button> </td>
                </tr>
            @endforeach

        </table>
    </div>


@endsection