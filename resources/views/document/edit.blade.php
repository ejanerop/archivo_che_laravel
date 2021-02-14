@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            Documentos
            <small>Editar</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('home')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="{{route('document.index')}}"><i class="fa fa-file-text"></i> Documentos</a></li>
            <li class="active"> Editar {{$document->name}}</li>
        </ol>
    </section>

    <section class="content">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="box box-primary">
            <form id="docCreate" method="POST" action="{{route('document.update', ['document' => $document->id])}}" enctype="multipart/form-data">
                @method('PUT')
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
                    <div class="col-md-6">
                        <div class="form-group {{$errors->has('name')?'has-error':''}}">
                            <label for="name">Nombre</label>
                            <input id="name" name="name" type="text" class="form-control" placeholder="Título del documento" value="{{$document->name}}">
                        </div>
                        <div class="form-group {{$errors->has('description')?'has-error':''}}">
                            <label for="description">Descripción</label>
                            <textarea id="description" name="description" rows="5" class="form-control" style="resize:none" placeholder="Descripción">{{$document->description}}</textarea>
                        </div>
                        <div class="form-group {{$errors->has('resource')?'has-error':''}}">
                            <label for="resource">Recurso principal</label>
                            <input id="resource" name="resource" type="file" class="form-control" accept="image/*">
                            <p class="help-block">Si deja en blanco este campo, se mantendrá el recurso principal existente.</p>
                        </div>
                        <div class="form-group">
                            <label for="resource_description">Descripción del recurso</label>
                            <textarea id="resource_description" name="resource_description" class="form-control" style="resize: none" disabled></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="date_type">Tipo de fecha </label>
                                    <select id="date_type"  name="date_type" class="form-control" onchange="toggleDate()" onload="toggleDate()"  style="width: 100%">
                                        <option {{$document->custom_date->date_type->slug == 'full_date' ? 'selected' : ''}} class="optDate" id="full_date" value="full_date">Fecha completa</option>
                                        <option {{$document->custom_date->date_type->slug == 'month_year' ? 'selected' : ''}} class="optDate" id="month_year" value="month_year">Mes y año</option>
                                        <option {{$document->custom_date->date_type->slug == 'year' ? 'selected' : ''}} class="optDate" id="year" value="year">Año</option>
                                        <option {{$document->custom_date->date_type->slug == 'lapse' ? 'selected' : ''}} class="optDate" id="lapse" value="lapse">Lapso</option>
                                        <option {{$document->custom_date->date_type->slug == 'year_lapse' ? 'selected' : ''}} class="optDate" id="year_lapse" value="year_lapse">Período de años</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group {{$errors->has('date')?'has-error':''}}">
                                    <label for="date">Fecha inicio</label>
                                    <div class="input-group">
                                        <input id='dayStart' name='dayStart' type="number" class="form-control" placeholder="Día" min="1" max="31" value="{{$document->custom_date->dayStart}}"/>
                                        <span class="input-group-addon"></span>
                                        <select id='monthStart' name='monthStart' class="form-control">
                                            <option {{$document->custom_date->monthStart == 1 ? 'selected' : ''}} value='1'>Enero</option>
                                            <option {{$document->custom_date->monthStart == 2 ? 'selected' : ''}} value='2'>Febrero</option>
                                            <option {{$document->custom_date->monthStart == 3 ? 'selected' : ''}} value='3'>Marzo</option>
                                            <option {{$document->custom_date->monthStart == 4 ? 'selected' : ''}} value='4'>Abril</option>
                                            <option {{$document->custom_date->monthStart == 5 ? 'selected' : ''}} value='5'>Mayo</option>
                                            <option {{$document->custom_date->monthStart == 6 ? 'selected' : ''}} value='6'>Junio</option>
                                            <option {{$document->custom_date->monthStart == 7 ? 'selected' : ''}} value='7'>Julio</option>
                                            <option {{$document->custom_date->monthStart == 8 ? 'selected' : ''}} value='8'>Augosto</option>
                                            <option {{$document->custom_date->monthStart == 9 ? 'selected' : ''}} value='9'>Septiembre</option>
                                            <option {{$document->custom_date->monthStart == 10 ? 'selected' : ''}} value='10'>Octubre</option>
                                            <option {{$document->custom_date->monthStart == 11 ? 'selected' : ''}} value='11'>Noviembre</option>
                                            <option {{$document->custom_date->monthStart == 12 ? 'selected' : ''}} value='12'>Diciembre</option>
                                         </select>
                                        <span class="input-group-addon"></span>
                                        <input type="number" id='yearStart' name='yearStart' class="form-control" placeholder="Año" min="1928" max="2099" value="{{$document->custom_date->yearStart}}"/>
                                    </div>
                                </div>
                                <div id="date_end" class="form-group hidden">
                                    <label for="date">Fecha fin</label>
                                    <div class="input-group">
                                        <input id='dayEnd' name='dayEnd' type="number" class="form-control" placeholder="Día" min="1" max="31" value="{{$document->custom_date->dayEnd}}"/>
                                        <span class="input-group-addon"></span>
                                        <select id='monthEnd' name='monthEnd' class="form-control">
                                            <option {{$document->custom_date->monthEnd == 1 ? 'selected' : ''}} value='1'>Enero</option>
                                            <option {{$document->custom_date->monthEnd == 2 ? 'selected' : ''}} value='2'>Febrero</option>
                                            <option {{$document->custom_date->monthEnd == 3 ? 'selected' : ''}} value='3'>Marzo</option>
                                            <option {{$document->custom_date->monthEnd == 4 ? 'selected' : ''}} value='4'>Abril</option>
                                            <option {{$document->custom_date->monthEnd == 5 ? 'selected' : ''}} value='5'>Mayo</option>
                                            <option {{$document->custom_date->monthEnd == 6 ? 'selected' : ''}} value='6'>Junio</option>
                                            <option {{$document->custom_date->monthEnd == 7 ? 'selected' : ''}} value='7'>Julio</option>
                                            <option {{$document->custom_date->monthEnd == 8 ? 'selected' : ''}} value='8'>Augosto</option>
                                            <option {{$document->custom_date->monthEnd == 9 ? 'selected' : ''}} value='9'>Septiembre</option>
                                            <option {{$document->custom_date->monthEnd == 10 ? 'selected' : ''}} value='10'>Octubre</option>
                                            <option {{$document->custom_date->monthEnd == 11 ? 'selected' : ''}} value='11'>Noviembre</option>
                                            <option {{$document->custom_date->monthEnd == 12 ? 'selected' : ''}} value='12'>Diciembre</option>
                                        </select>
                                        <span class="input-group-addon"></span>
                                        <input type="number" id='yearEnd' name='yearEnd' class="form-control" placeholder="Año" min="1928" max="2099" value="{{$document->custom_date->yearEnd}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="document_type">Tipo de documento</label>
                                    <select id="document_type"  name="document_type" class="form-control" onchange="modifyResource()">
                                        @foreach($resource_types as $resType)
                                            @if($resType->resource_type == $document->document_type->resource_type->resource_type)
                                            <optgroup class="optgroup" label="{{$resType->resource_type}}">
                                                @foreach($resType->document_types as $docType)
                                                    <option class="opt {{$resType->resource_type}}" id="{{$docType->id}}" {{$docType->id == $document->document_type->id ? 'selected' : ''}}>{{$docType->document_type}}</option>
                                                @endforeach
                                            </optgroup>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{$errors->has('author')?'has-error':''}}">
                                    <label for="date">Autor</label>
                                    <select id="author"  name="author" class="form-control">
                                        @foreach($authors as $author)
                                            <option class="opt" id="{{$author->id}}" {{$document->author->name==$author->name ? 'selected' : ''}}>{{$author->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="access_level">Nivel de acceso</label>
                                    <select id="access_level" name="access_level" class="form-control">
                                        @foreach($access_levels as $levels)
                                            <option id="{{$levels->id}}" {{$levels->id == $document->access_level->id ? 'selected' : ''}}>{{$levels->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group {{$errors->has('subtopics')?'has-error':''}}">
                                    <label for="subtopics">Subtemas de investigación</label>
                                    <select id="subtopics" name="subtopics[]" class="form-control select2" multiple = "multiple" data-placeholder="Selecciona los temas de investigación" style="width: 100%">
                                        @foreach($topics as $topic)
                                            <optgroup label="{{$topic->research_topic}}">
                                                @foreach($topic->subtopics as $subtopic)
                                                    <option id="{{$subtopic->id}}" {{in_array($subtopic->id, $subtopics) ? 'selected' : ''}}>{{$subtopic->name}}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input id="hasFacsim" name="hasFacsim" type="checkbox" class="form-control">
                                    <label for="hasFacsim">Facsimil</label>
                                </div>
                                <div class="form-group">
                                    <label for="image">Archivo(s)</label>
                                    <input id="facsim" name="facsim[]" type="file" class="form-control" accept="image/*" multiple disabled>
                                </div>
                            </div>
                        </div>
                    </div>
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

    <script src="{{asset('js/scripts/document/edit.js')}}"></script>


@endsection
