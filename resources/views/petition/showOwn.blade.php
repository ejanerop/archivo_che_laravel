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
        <div class="box box-primary">
            <div class="box-header">
                <a href="{{route('petition.myPetitions')}}" class="btn btn-primary pull-left">
                    <span class="fa fa-reply"></span>
                    {{ __('Atras') }}
                </a>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="user">Usuario</label>
                            <input type="text" id="user" name="user" class="form-control" value="{{$petition->user->username}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="petitionState">Estado de la petición</label>
                            <input type="text" id="petitionState" name="petitionState" class="form-control" value="{{$petition->petition_state->state}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="access_level">Nivel de acceso</label>
                            <input type="text" id="access_level" name="access_level" class="form-control" value="{{$petition->access_level->name}}" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="tableSubtopics">Subtemas</label>
                        <table id="tableSubtopics" class="table table-bordered table-hover">
                            <tbody>
                                @foreach ($subpetitions as $subpetition)
                                    @if ($subpetition->object_type == 'subtopic')
                                    <tr>
                                        <td>{{$subpetition->object->name}}</td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <label for="tableStages">Etapas</label>
                        <table id="tableStages" class="table table-bordered table-hover">
                            <tbody>
                                @foreach ($subpetitions as $subpetition)
                                    @if ($subpetition->object_type == 'stage')
                                    <tr>
                                        <td>{{$subpetition->object->name}}</td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <label for="tableDocumentTypes">Tipos de documentos</label>
                        <table id="tableDocumentTypes" class="table table-bordered table-hover">
                            <tbody>
                                @foreach ($subpetitions as $subpetition)
                                    @if ($subpetition->object_type == 'document_type')
                                    <tr>
                                        <td>{{$subpetition->object->document_type}}</td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-grouo">
                            <label for="notes">Notas</label>
                            <textarea name="notes" id="notes" rows="7" class="form-control" style="resize:none" readonly>{{$petition->notes}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="col-md-10">
                        </div>
                        <div class="col-md-2">

                        </div>
                    </div>
                </div>
            </div>
        </div>



    </section>

    <script src="{{asset('select2/select2.full.min.js')}}"></script>
    <script>
        $('.filterSelect').select2();
    </script>

@endsection
