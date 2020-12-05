@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            Autores
            <small>Lista de autores</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('home')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active">Autores</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><span class="fa fa-chack"></span></h4>
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
                        <a href="{{route('author.create')}}" class="btn btn-success pull-right"><span class="fa fa-plus"></span> Nuevo</a>
                    </div>
                    <div class="box-body">
                        <table id="table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nombre del autor</th>
                                    <th>Descripción</th>
                                    <th>Documentos</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($authors as $author)
                                <tr>
                                    <td>{{$author->name}}</td>
                                    <td>{{$author->description}}</td>
                                    <td>{{$author->documents_count}}</td>
                                    <td>
                                        <form action="{{route('author.destroy', ['author' => $author->id])}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{route('author.show', ['author' => $author->id])}}" class="btn btn-xs btn-success"><span class="fa fa-eye" style="margin-right: 2px"></span> Mostrar</a>
                                            <a href="{{route('author.edit', ['author' => $author->id])}}" class="btn btn-xs btn-info"><span class="fa fa-edit" style="margin-right: 2px"></span> Editar</a>
                                            <button type="submit" class="btn btn-xs btn-danger"  onclick="return confirm('Está seguro que desea eliminar el autor {{$author->name}}?')"><span class="fa fa-remove" style="margin-right: 2px"></span> Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(function () {
            $('#table').DataTable({
                paging : false,
                language : {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla =(",
                "sInfo":           "Mostrando del _START_ al _END_ de un total de _TOTAL_ temas",
                "sInfoEmpty":      "Mostrando del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                },
                "buttons": {
                    "copy": "Copiar",
                    "colvis": "Visibilidad"
            }
        }
            });
        });
        $('li.li').removeClass('active');
        $('li#author').addClass('active');
        $('li#authorList').addClass('active');
    </script>

@endsection
