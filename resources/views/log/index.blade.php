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
                    <td>{{$log->object_table}}</td>
                    <td>{{$log->object_name}}</td>
                    <td>{{$log->ip_address}}</td>
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
            $('#table').DataTable();
            $('li.li').removeClass('active');
            $('li#document_type').addClass('active');
            $('li#typeList').addClass('active');
        });
    </script>

@endsection
