@extends('layouts.app')

@section('content')

    <section class="content-header">
        <div class="container">
            <h3>Documentos</h3>
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
                        <h4></h4>
                        <strong>{{ session('error') }}</strong>
                    </div>
                @endif
                <div class="box box-primary">
                    <div class="box-header">
                        <a href="{{route('document.create')}}" class="btn btn-flat btn-success pull-right"><span class="glyphicon glyphicon-plus"></span>Nuevo</a>
                    </div>
                    <div class="box-body">
                        <table id="table" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Tipo de documento</th>
                                <th>Tipo de recurso</th>
                                <th>Nivel de acceso</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
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
                                            <a href="/document/{{$document->id}}/edit" class="btn btn-info btn-flat">Modificar</a>
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
        $('#table').DataTable();
    </script>

@endsection