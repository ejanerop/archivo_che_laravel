@extends('layouts.app')

@section('content')

    <section class="content-header">
        <ul>
        @foreach($errors->all() as $error)
            <li class="text-red">
            <span class="text-red">
                <strong class="text-red">{{ $error }}</strong>
            </span>
            </li>
        @endforeach
        </ul>
    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-header">
                <a href="" class="btn btn-danger pull-left">
                    <span class="fa fa-remove"></span>
                    {{ __('Atras') }}
                </a>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="user">Usuario</label>
                        <input type="text" id="user" name="user" class="form-control" value="{{$petition->user->username}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="petitionState">Estado de la petición</label>
                            <input type="text" id="petitionState" name="petitionState" class="form-control" value="{{$petition->petition_state->state}}" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="tableSubtopics">Subtemas   <a href="">(Editar)</a></label>
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
                        <label for="tableStages">Etapas   <a href="">(Editar)</a></label>
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
                        <label for="tableDocumentTypes">Tipos de documentos   <a href="">(Editar)</a></label>
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
                <div class="box-footer">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="btn'group"></div>
                            <a href="{{route('petition.deny' , ['petition' => $petition])}}" class="btn btn-danger">
                                <span class="fa fa-times-circle-o"></span>
                                {{ __('Denegar') }}
                            </a>
                            <a href="{{route('petition.accept' , ['petition' => $petition])}}" class="btn btn-success">
                                <span class="fa fa-check-circle-o"></span>
                                {{ __('Aprobar') }}
                            </a>
                        </div>
                        <div class="col-md-2">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
