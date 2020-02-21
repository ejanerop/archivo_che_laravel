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
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
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
                        <label for="tableSubtopics">Subtemas</label>
                        <table id="tableSubtopics" class="table table-bordered">
                            <tbody>
                                @foreach ($subtopics as $subtopic)
                                    @if ($subtopic->isInPetition($petition))
                                    <tr>
                                        <td>{{$subtopic->name}}</td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <label for="tableStages">Etapas</label>
                        <table id="tableStages" class="table table-bordered">
                            <tbody>
                                @foreach ($stages as $stage)
                                    @if ($stage->isInPetition($petition))
                                    <tr>
                                        <td>{{$stage->name}}</td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4">
                        <label for="tableDocumentTypes">Tipos de documentos</label>
                        <table id="tableDocumentTypes" class="table table-bordered">
                            <tbody>
                                @foreach ($documentTypes as $documentType)
                                    @if ($documentType->isInPetition($petition))
                                    <tr>
                                        <td>{{$documentType->document_type}}</td>
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
