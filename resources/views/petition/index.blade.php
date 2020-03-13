@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            Solicitudes
            <small>Lista de solicitudes</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('home')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="{{route('petition.index')}}"><i class="fa fa-book"></i> Solicitudes</a></li>
            <li class="active">Lista de solicitudes</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div id="alert-div" class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><span class="fa fa-checked"></span></h4>
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
            </div>
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">

                    </div>
                    <div class="box-body">
                        <table id="table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Usuario</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            @foreach($petitions as $petition)
                                <tr>
                                    <td>{{$petition->user->username}}</td>
                                    @if($petition->petition_state->slug == 'approved')
                                    <td><span class="label label-success">{{$petition->petition_state->state}}</span></td>
                                    @elseif($petition->petition_state->slug == 'denied')
                                    <td><span class="label label-danger">{{$petition->petition_state->state}}</span></td>
                                    @else
                                    <td><span class="label label-primary">{{$petition->petition_state->state}}</span></td>
                                    @endif
                                    <td>
                                        <form action="{{route('petition.destroy', ['petition' => $petition])}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{route('petition.show' , ['petition' => $petition])}}" class="btn btn-xs btn-info"><span class="fa fa-mail-forward" style="margin-right: 2px"></span> Responder</a>
                                            <button type="submit" onclick="return confirm('Está seguro que desea eliminar la petición?')" class="btn btn-xs btn-danger"><span class="fa fa-remove" style="margin-right: 2px"></span> Eliminar</button>
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
            $('#table').DataTable({
                language : {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla =(",
                "sInfo":           "Mostrando del _START_ al _END_ de un total de _TOTAL_ solicitudes",
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
            $('li.li').removeClass('active');
            $('li#petition').addClass('active');
            $('li#petitionList').addClass('active');
        });
    </script>

@endsection
