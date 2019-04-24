@extends('layouts.app')

@section('content')

    <section class="content-header">
        <div class="container">
            <h1>Tipos de documento</h1>
        </div>
    </section>

    <section class="content">
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
                    <td>{{$type->documents_count}}</td>
                    <td>
                        <form action="/document_type/{{$type->id}}" method="post">
                            @csrf
                            @method('DELETE')
                            <a href="/document_type/{{$type->id}}/edit" class="btn btn-info">Modificar</a>
                            <button type="submit" class="btn btn-danger"> Eliminar</button>
                        </form>
                    </td>
                    </tr>
            @endforeach
        </table>
    </section>

@endsection