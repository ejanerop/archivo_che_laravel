@extends('layouts.app')

@section('content')

    <section class="content-header">
        <div class="container">
            <h3>Actividad</h3>
        </div>
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
            $('#table').DataTable();
            $('#log_types').select2();
            $('#name').select2();
            $('li.li').removeClass('active');
            $('li#log').addClass('active');
            $('li#logList').addClass('active');
        });
    </script>

@endsection
