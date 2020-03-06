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
            <form id="petitionCreate" method="POST" action="{{route('petition.store')}}" enctype="multipart/form-data">
                @csrf
                <input id="type" name="type" type="hidden" value="text">
                <div class="box-header">
                    <a href="" class="btn btn-danger pull-left">
                        <span class="fa fa-remove"></span>
                        {{ __('Cancelar') }}
                    </a>
                    <button type="submit" class="btn btn-success pull-right">
                        <i class="fa fa-save"></i>
                        {{ __('Guardar') }}
                    </button>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="subtopics">Subtemas de investigación</label>
                                <select id="subtopics" name="subtopics[]" class="form-control select2 filterSelect" multiple = "multiple" data-placeholder="Selecciona los temas de investigación" style="width: 100%">
                                    @foreach($topics as $topic)
                                    <optgroup label="{{$topic->research_topic}}">
                                        @foreach($topic->subtopics as $subtopic)
                                        <option id="{{$subtopic->id}}">{{$subtopic->name}}</option>
                                        @endforeach
                                    </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="documentTypes">Tipos de documento</label>
                                <select id="documentTypes" name="documentTypes[]" class="form-control select2 filterSelect" multiple = "multiple" data-placeholder="Selecciona los tipos de documento" style="width: 100%">
                                    @foreach($resourceTypes as $resType)
                                    <optgroup class="optgroup" label="{{$resType->resource_type}}">
                                        @foreach($resType->document_types as $docType)
                                        <option class="opt {{$resType->resource_type}}" id="{{$docType->id}}">{{$docType->document_type}}</option>
                                        @endforeach
                                    </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="access_level">Nivel de acceso</label>
                                <select id="access_level" name="access_level" class="form-control filterSelect">
                                    @foreach($access_levels as $levels)
                                        <option id="{{$levels->id}}" {{old('access_level')==$levels->name ? 'selected' : ''}}>{{$levels->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="radio" name="filterTime" id="filterByStage">
                                <label for="filterByStage">Filtrar por etapa cronológica</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="radio" name="filterTime" id="filterByDate">
                                <label for="filterByDate">Filtrar por fechas</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stages">Etapas</label>
                                <select id="stages" name="stages[]" class="form-control select2 filterSelect" multiple = "multiple" data-placeholder="Selecciona las etapas" style="width: 100%" disabled>
                                    @foreach($stages as $stage)
                                    <option class="opt {{$resType->resource_type}}" id="{{$docType->id}}">{{$stage->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="dateStart">Fecha de inicio</label>
                            <input type="text" id="dateStart" name="dateStart" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask disabled>
                        </div>
                        <div class="col-md-3">
                            <label for="dateEndFilter">Fecha de fin</label>
                            <input type="text" id="dateEnd" name="dateEnd" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="notes">Notas</label>
                                <textarea id="notes" name="notes" rows="5" class="form-control" style="resize:none" placeholder="Notas">{{old('notes')}}</textarea>
                            </div>
                        </div>
                    </div>

                    </div>
                </div>

                </div>
            </form>
        </div>
    </section>

    <script src="{{asset('select2/select2.full.min.js')}}"></script>
    <script src="{{asset('input-mask/jquery.inputmask.js')}}"></script>
    <script src="{{asset('input-mask/jquery.inputmask.date.extensions.js')}}"></script>
    <script src="{{asset('input-mask/jquery.inputmask.extensions.js')}}"></script>
    <script>
        $('.filterSelect').select2();
        $("[data-mask]").inputmask();
        $('#filterByStage').on('ifToggled',function () {
            var stages = $('select#stages');
            var dateEnd = $('input#dateEnd');
            var dateStart = $('input#dateStart');
            stages.attr("disabled", !this.checked);
            dateEnd.attr("disabled", this.checked);
            dateStart.attr("disabled", this.checked);
            if (this.checked) {
                stages.removeAttr("value");
            }else{
                dateEnd.attr("value", "");
                dateStart.attr("value", "");
            }
        });
        $('#filterByDate').on('ifToggled',function () {
            var stages = $('select#stages');
            var dateEnd = $('input#dateEnd');
            var dateStart = $('input#dateStart');
            stages.attr("disabled", this.checked);
            dateEnd.attr("disabled", !this.checked);
            dateStart.attr("disabled", !this.checked);
            if (!this.checked) {
                stages.removeAttr("value");
            }else{
                dateEnd.attr("value", "");
                dateStart.attr("value", "");
            }
        });

    </script>

@endsection
