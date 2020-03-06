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
                <a href="{{route('petition.index')}}" class="btn btn-primary pull-left">
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
                            <div class="btn'group"></div>
                            <a href="{{route('petition.deny' , ['petition' => $petition])}}" class="btn btn-danger">
                                <span class="fa fa-times"></span>
                                {{ __('Denegar') }}
                            </a>
                            <a href="" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter">
                                <span class="fa fa-edit"></span>
                                {{ __('Editar y Aprobar') }}
                            </a>
                            <a href="{{route('petition.accept' , ['petition' => $petition])}}" class="btn btn-success">
                                <span class="fa fa-check"></span>
                                {{ __('Aprobar') }}
                            </a>
                        </div>
                        <div class="col-md-2">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade in" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                  <h4 class="modal-title">Editar petición</h4>
                </div>
                <div class="modal-body">
                  <form action="" method="POST">
                    <div class="container-fluid">
                      <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="access_level">Nivel de acceso</label>
                                <select id="access_level" name="access_level" class="form-control select2 filterSelect"style="width: 100%">
                                    @foreach($access_levels as $accessLevel)
                                        <option class="opt" id="{{$accessLevel->id}}" {{$accessLevel->id == $petition->access_level->id ? 'selected' : ''}}>{{$accessLevel->name}}</option>
                                    @endforeach
                                </select>
                              </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="document_types">Tipos de documento</label>
                                <select id="document_types" name="document_types[]" class="form-control select2 filterSelect" multiple = "multiple" data-placeholder="Selecciona los tipos de documento" style="width: 100%">
                                  @foreach($resourceTypes as $resType)
                                  <optgroup class="optgroup" label="{{$resType->resource_type}}">
                                    @foreach($resType->document_types as $docType)
                                    <option class="opt" id="{{$docType->id}}" {{in_array($docType->id, $documentTypesSelected) ? 'selected' : ''}}>{{$docType->document_type}}</option>
                                    @endforeach
                                  </optgroup>
                                  @endforeach
                                </select>
                              </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="stages">Etapas</label>
                            <select id="stages" name="stages[]" class="form-control select2 filterSelect" multiple = "multiple" data-placeholder="Selecciona las etapas" style="width: 100%">
                              @foreach($stages as $stage)
                                <option class="opt" id="{{$stage->id}}" {{in_array($stage->id, $stagesSelected) ? 'selected' : ''}}>{{$stage->name}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="subtopics">Subtemas de investigación</label>
                            <select id="subtopics" name="subtopics[]" class="form-control select2 filterSelect" multiple = "multiple" data-placeholder="Selecciona los temas de investigación" style="width: 100%">
                              @foreach($topics as $topic)
                                <optgroup label="{{$topic->research_topic}}">
                                  @foreach($topic->subtopics as $subtopic)
                                  <option id="{{$subtopic->id}}" {{in_array($subtopic->id, $subtopicsSelected) ? 'selected' : ''}}>{{$subtopic->name}}</option>
                                  @endforeach
                                </optgroup>
                              @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary pull-left" data-dismiss="modal"><span class="fa fa-reply"></span> Atrás</button>
                  <button type="submit" class="btn btn-success"><span class="fa fa-check"></span> Editar y aprobar</button>
                  </form>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
          </div>
    </section>

    <script src="{{asset('select2/select2.full.min.js')}}"></script>
    <script>
        $('.filterSelect').select2();
    </script>

@endsection
