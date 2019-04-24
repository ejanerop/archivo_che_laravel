@extends('layouts.app')

@section('content')

    <section class="content-header">
        <div class="container">
            <h1>Documentos</h1>
        </div>
    </section>

    <section class="content">
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
                        <td>
                            <form action="/document/{{$document->id}}" method="post">
                                @csrf
                                @method('DELETE')
                                <a href="/document/{{$document->id}}/edit" class="btn btn-info">Modificar</a>
                                <button type="submit" class="btn btn-danger"> Eliminar</button>
                            </form>
                        </td>

                    </tr>
                @endforeach

            </table>
        </div>
    </section>


@endsection