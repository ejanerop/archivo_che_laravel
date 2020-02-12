@extends('layouts.app')

@section('content')

    <section class="content-header">
        <div class="container">
            <h3>Solicitudes</h3>
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
                        <th>Usuario</th>
                        <th>Documento</th>
                        <th>Estado</th>  
                        <th>Acción</th> 
                    </tr>
                 </thead>
            @foreach($petitions as $petition)
                <tr>
                    <td>{{$petition->user->username}}</td>
                    <td>{{$petition->document->name}}</td>
                    <td>{{$petition->petition_state->state}}</td>
                    <td>
                        <a href="{{route('petition.accept' , ['petition' => $petition])}}" class="btn btn-xs btn-success"><span class="fa fa-check" style="margin-right: 2px"></span> Aprobar</a>
                        <a href="{{route('petition.deny' , ['petition' => $petition])}}" class="btn btn-xs btn-danger"><span class="fa fa-close" style="margin-right: 2px"></span> Denegar</a>
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
            $('#table').DataTable();
            $('li.li').removeClass('active');
            $('li#document_type').addClass('active');
            $('li#typeList').addClass('active');
        });
    </script>

@endsection