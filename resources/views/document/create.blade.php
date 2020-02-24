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
            <form id="docCreate" method="POST" action="{{route('document.store')}}" enctype="multipart/form-data">
                @csrf
                <input id="type" name="type" type="hidden" value="text">
                <div class="box-header">
                    <a href="{{route('document.index')}}" class="btn btn-danger pull-left">
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
                        <div class="col-md-12">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li id="li1" class="active"><a href="#tab_1" onclick="toggleTab(1)" data-toggle="tab" aria-expanded="false">General</a></li>
                                    <li id="li3"><a href="#tab_3" onclick="toggleTab(3)" data-toggle="tab" aria-expanded="true">Recursos</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                       <div class="row">
                                           <div class="col-md-6">
                                               <div class="col-md-12">
                                                   <div class="form-group {{$errors->has('name')?'has-error':''}}">
                                                       <label for="name">Nombre</label>
                                                   <input id="name" name="name" type="text" class="form-control" placeholder="Título del documento" value="{{old('name')}}" required>
                                                   </div>
                                                   <div class="form-group {{$errors->has('description')?'has-error':''}}">
                                                       <label for="description">Descripción</label>
                                                       <textarea id="description" name="description" rows="5" class="form-control" style="resize:none" placeholder="Descripción">{{old('description')}}</textarea>
                                                   </div>
                                               </div>
                                           </div>
                                           <div class="col-md-6">
                                               <div class="col-md-6">
                                                   <div class="form-group {{$errors->has('date')?'has-error':''}}">
                                                       <label for="date">Fecha</label>
                                                       <input type="text" id="date" name="date" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" value="{{old('date')}}" data-mask>
                                                   </div>
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
                                                       <label for="date">Autor</label>
                                                       <input type="text" id="author" name="author" class="form-control" placeholder="Autor del documento" value="{{old('author')}}" required>
                                                   </div>
                                                   <div class="form-group">
                                                       <label for="access_level">Nivel de acceso</label>
                                                       <select id="access_level" name="access_level" class="form-control">
                                                           @foreach($access_levels as $levels)
                                                               <option id="{{$levels->id}}">{{$levels->name}}</option>
                                                           @endforeach
                                                       </select>
                                                   </div>
                                               </div>
                                               <div class="col-md-12">
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
                                           </div>
                                       </div>
                                        <div class="row">
                                            <!--  Recursos secundarios -->
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab_3">
                                        <div class="row">
                                            <div class="col-md-6"></div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input id="hasFacsim" name="hasFacsim" type="checkbox" class="form-control">
                                                    <label for="hasFacsim">Facsimil</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group {{$errors->has('resource')?'has-error':''}}">
                                                    <label for="resource">Recurso principal</label>
                                                    <input id="resource" name="resource" type="file" class="form-control" accept="application/pdf">
                                                </div>
                                                <div class="form-group">
                                                    <label for="resource_description">Descripción del recurso</label>
                                                    <textarea id="resource_description" name="resource_description" class="form-control" style="resize: none"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="image">Archivo(s)</label>
                                                    <input id="facsim" name="facsim" type="file" class="form-control" accept="image/*" multiple disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                </div>
                <div class="box-footer">

                </div>
            </form>
        </div>
    </section>

    <script src="{{asset('select2/select2.full.min.js')}}"></script>
    <script src="{{asset('input-mask/jquery.inputmask.js')}}"></script>
    <script src="{{asset('input-mask/jquery.inputmask.date.extensions.js')}}"></script>
    <script src="{{asset('input-mask/jquery.inputmask.extensions.js')}}"></script>
    <script>
        $('#subtopics').select2();
        $('li.li').removeClass('active');
        $('li#document').addClass('active');
        $('li#documentCreate').addClass('active');

        $("[data-mask]").inputmask();

        $('#hasFacsim').on('ifToggled',function () {
            $('input#facsim').attr("disabled", !this.checked);
        });

        function modifyResource() {
            var inputResources = $('input#resource');
            var descResources = $('textarea#resource_description');
            var optSelected = $('.opt:selected');
            var hasFacsim = $('#hasFacsim');
            var facsim = $('input#facsim');
            var type = $('input#type');
            if(optSelected.hasClass('Texto')){
                hasFacsim.iCheck('enable');
                hasFacsim.iCheck('uncheck');
                inputResources.attr("accept", "application/pdf");
                type.attr('value', 'text');
            }else{
                inputResources.attr("disabled", false);
                descResources.attr("disabled", false);
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

        $('#docCreate').validate({
            rules: {
                name:{
                    required: true,
                    minlength: 3,
                    maxlength: 255
                },
                description: {
                    maxlength: 255
                },
                date: {
                    required: true
                },
                author: {
                    required: true
                },
                subtopics: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "Debe llenar este campo",
                    maxlength: "El nombre del documento no puede exceder los 191 caracteres"
                },
                date: {
                    required: "Debe llenar este campo"
                },
                author: {
                    required: "Debe llenar este campo"
                },
                description: {
                    maxlength: "La descripción no puede ser mayor de 255 caracteres"
                },
                subtopics: {
                    required: "Debe seleccionar al menos un subtema"
                }
            }
        });

        function toggleTab(tab) {
            var tab1 = $('#li1');
            var tab2 = $('#li2');
            var tab3 = $('#li3');
            switch (tab) {
                case 1:
                    tab1.addClass('active');
                    tab2.removeClass('active');
                    tab3.removeClass('active');
                    break;
                case 2:
                    tab1.removeClass('active');
                    tab2.addClass('active');
                    tab3.removeClass('active');
                    break;
                case 3:
                    tab1.removeClass('active');
                    tab2.removeClass('active');
                    tab3.addClass('active');
                    break;
            }
        }

        modifyResource();

    </script>

@endsection
