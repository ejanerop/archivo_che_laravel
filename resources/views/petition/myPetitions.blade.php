@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            Solicitudes
            <small>Mis solicitudes</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('home')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="{{route('petition.myPetitions')}}"><i class="fa fa-book"></i> Solicitudes</a></li>
            <li class="active">Mis solicitudes</li>
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
                        <th>Estado</th>
                        <th>Solicitud</th>
                        <th>Acción</th>
                    </tr>
                 </thead>
            @foreach($petitions as $petition)
                <tr>
                    @if($petition->petition_state->slug == 'approved')
                    <td><span class="label label-success">{{$petition->petition_state->state}}</span></td>
                    @elseif($petition->petition_state->slug == 'denied')
                    <td><span class="label label-danger">{{$petition->petition_state->state}}</span></td>
                    @else
                    <td><span class="label label-primary">{{$petition->petition_state->state}}</span></td>
                    @endif
                    <td>
                        @foreach($petition->subpetitions as $subpetition)
                            @if($subpetition->object_type == 'stage')
                                <span class="label label-primary">{{$subpetition->object->name}}</span>
                            @elseif($subpetition->object_type == 'subtopic')
                                <span class="label label-warning">{{$subpetition->object->name}}</span>
                            @elseif($subpetition->object_type == 'document_type')
                                <span class="label label-info">{{$subpetition->object->document_type}}</span>
                            @endif
                        @endforeach
                    </td>
                    <td>
                        <form action="{{route('petition.destroy', ['petition' => $petition])}}" method="post">
                            @csrf
                            @method('DELETE')
                            <a href="{{route('petition.showOwn' , ['petition' => $petition])}}" class="btn btn-xs btn-info"><span class="fa fa-eye" style="margin-right: 2px"></span> Mostrar</a>
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

    <script src="{{asset('js/scripts/petition/myPetitions.js')}}"></script>


@endsection
