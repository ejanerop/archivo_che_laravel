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
            <form method="POST" action="{{route('document.index')}}" enctype="multipart/form-data">
                @csrf
                <input id="type" name="type" type="hidden" value="text">
                <div class="box-header">
                    <button type="reset" class="btn btn-warning pull-left">
                        <i class="fa fa-eraser"></i>
                        {{ __('Limpiar') }}
                    </button>
                    <button type="submit" class="btn btn-success pull-right">
                        <i class="fa fa-save"></i>
                        {{ __('Guardar') }}
                    </button>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group {{$errors->has('name')?'has-error':''}}">
                                <label for="name">Nombre</label>
                                <input id="name" name="name" type="text" class="form-control" placeholder="Título del documento">
                            </div>
                            <div class="form-group {{$errors->has('description')?'has-error':''}}">
                                <label for="description">Descripción</label>
                                <textarea id="description" name="description" rows="5" class="form-control" style="resize:none" placeholder="Descripción"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="document_type">Tipo de documento</label>
                                        <select id="document_type"  name="document_type" class="form-control" onchange="modifyResource()">
                                            @foreach($resource_types as $resType)
                                                <optgroup class="optgroup" label="{{$resType->resource_type}}">
                                                    @foreach($resType->document_types as $docType)
                                                        <option class="opt {{$resType->resource_type}}" id="{{$docType->id}}">{{$docType->document_type}}</option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="access_level">Nivel de acceso</label>
                                        <select id="access_level" name="access_level" class="form-control">
                                            @foreach($access_levels as $levels)
                                                <option id="{{$levels->id}}">{{$levels->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{$errors->has('subtopics')?'has-error':''}}">
                                <label for="subtopics">Subtemas de investigación</label>
                                <select id="subtopics" name="subtopics[]" class="form-control select2" multiple = "multiple" data-placeholder="Selecciona los temas de investigación" style="width: 100%">
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
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group {{$errors->has('date')?'has-error':''}}">
                                        <label for="date">Fecha</label>
                                        <input type="text" id="date" name="date" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="date">Etapa</label>
                                        <input type="text" id="date" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group {{$errors->has('resource')?'has-error':''}}">
                                        <label for="resource">Recurso</label>
                                        <input id="resource" name="resource" type="file" class="form-control" accept="image/*" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input id="hasFacsim" name="hasFacsim" type="checkbox" class="form-control">
                                        <label for="hasFacsim">Tiene facsimil</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Facsimil</label>
                                        <input id="facsim" name="facsim" type="file" class="form-control" accept="image/*" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <label for="text">Texto</label>
                        <textarea id="text" name="text" class="text_area"></textarea>
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
        $('.text_area').richText();
        $('#subtopics').select2();
        $('li.li').removeClass('active');
        $('li#document').addClass('active');
        $('li#documentCreate').addClass('active');

        $("[data-mask]").inputmask();

        $('#hasFacsim').on('ifToggled',function () {
            $('input#facsim').attr("disabled", !this.checked);
        });

        function modifyResource() {
            var textArea = $('.box-footer');
            var inputResources = $('input#resource');
            var optSelected = $('.opt:selected');
            var hasFacsim = $('#hasFacsim');
            var facsim = $('input#facsim');
            var type = $('input#type');
            if(optSelected.hasClass('Texto')){
                textArea.attr('hidden', false);
                inputResources.attr("disabled", true);
                hasFacsim.iCheck('enable');
                hasFacsim.iCheck('uncheck');
                type.attr('value', 'text');
            }else{
                textArea.attr('hidden', 'hidden');
                inputResources.attr("disabled", false);
                hasFacsim.iCheck('disable');
                facsim.attr('disabled', 'disabled');
                if(optSelected.hasClass('Imagen')){
                    inputResources.removeAttr('accepts');
                    inputResources.attr("accept", "image/*");
                    type.attr('value', 'image');
                }else if (optSelected.hasClass('Audio')) {
                    inputResources.removeAttr('accepts');
                    inputResources.attr("accept", "audio/*");
                    type.attr('value', 'audio');
                }else {
                    inputResources.removeAttr('accepts');
                    inputResources.attr("accept", "video/*");
                    type.attr('value', 'video');
                }
            }
        }


    </script>

@endsection