@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            Registro de actividad
            <small>Lista de acciones</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('home')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="{{route('log.index')}}"><i class="fa fa-exchange"></i> Registro de actividad</a></li>
            <li class="active">Lista de acciones</li>
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
                        @if($filtered)
                            <a href="{{route('log.index')}}" class="btn btn-danger">
                                <i class="fa fa-close"></i>
                                 Quitar filtro</a>
                        @else
                            <button type="button" class="btn btn-primary pull-left" data-toggle="modal" data-target="#exampleModalCenter">
                                <i class="fa fa-filter"></i>
                                 Filtrar
                            </button>
                        @endif
                    </div>
                    <div class="box-body">
                        <table id="table" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Fecha y hora</th>
                                    <th>Usuario</th>
                                    <th>Acción</th>
                                    <th>Tabla</th>
                                    <th>Objeto</th>
                                    <th>Dirección IP</th>
                                </tr>
                            </thead>
                            @foreach($logs as $log)
                                <tr>
                                    <td>{{$log->created_at}}</td>
                                    <td>{{$log->user}}</td>
                                    <td>{{$log->log_type->type}}</td>
                                    <td>{{$log->table_name}}</td>
                                    <td>{{$log->object_name}}</td>
                                    <td>{{$log->ip_add}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

        <!-- Modal -->
        <div class="modal fade in" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg ">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Filtrar</h4>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('log.filter')}}" method="GET">
                            <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Usuario</label>
                                        <select id="name" class="form-control select2 filterSelect" name="name" style="width: 100%">
                                            @foreach($users as $user)
                                                <option class="opt" id="{{$user->id}}">{{$user->username}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="log_types">Tipo de accion</label>
                                        <select id="log_types" name="log_types[]" class="form-control select2 filterSelect" multiple = "multiple" data-placeholder="Selecciona los tipos de eventos" style="width: 100%">
                                            @foreach($log_types as $logType)
                                                <option class="opt" id="{{$logType->id}}">{{$logType->type}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Filtrar</button>
                        </form>
                    </div>
                </div>
            </div>
              <!-- /.modal-content -->
        </div>



    <script src="{{asset('select2/select2.full.min.js')}}"></script>
    <script>
        $(function () {
            $('#table').DataTable({
                language : {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible ",
                "sInfo":           "Mostrando del _START_ al _END_ de un total de _TOTAL_ acciones",
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
            $('#log_types').select2();
            $('#name').select2({
                placeholder: 'Selecciona un usuario',
                allowClear: true   // Shows an X to allow the user to clear the value.
            });
            $('#name').val(null).trigger('change');
            $('li.li').removeClass('active');
            $('li#log').addClass('active');
            $('li#logList').addClass('active');
        });
    </script>

@endsection
