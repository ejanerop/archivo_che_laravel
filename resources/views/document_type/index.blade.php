@extends('layouts.app')

@section('content')

    <div class="container">
        <table class="table table-bordered">
            <tr class="active">
                <th>Tipo de documento</th>
                <th>Tipo de recurso</th>
                <th>Cantidad de documentos</th>
                <th>Acciones</th>
            </tr>
            @foreach($document_types as $type)
                <tr>
                    <td>{{$type->document_type}}</td>
                    <td>{{$type->resource_type->resource_type}}</td>
                    <td>15</td>
                    <td> <button class="btn-outline-info">Modificar</button> <button class="btn-outline-danger">Eliminar</button> </td>
                </tr>
            @endforeach

        </table>
    </div>

@endsection