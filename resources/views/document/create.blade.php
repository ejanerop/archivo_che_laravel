@extends('layouts.app')

@section('content')

    <section class="content-header">

    </section>

    <section class="content">


        <div class="box box-primary">
            <div class="box-header"></div>
            <div class="box-body">
                <form method="POST" action="/document" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input id="name" name="name" type="text" class="form-control" placeholder="Título del documento">
                            </div>
                            <div class="form-group">
                                <label for="description">Descripción</label>
                                <textarea id="description" name="description" rows="5" class="form-control" style="resize:none" placeholder="Descripción"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="document_type">Tipo de documento</label>
                                        <select id="document_type"  name="document_type" class="form-control" onchange="modifyResource()">
                                            @foreach($resource_types as $resType)
                                                <optgroup label="{{$resType->resource_type}}">
                                                    @foreach($resType->document_types as $docType)
                                                        <option id="{{$docType->id}}">{{$docType->document_type}}</option>
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
                            <div class="form-group">
                                <label for="subtopics">Subtemas de investigación</label>
                                <select id="subtopics" name="subtopics" class="form-control select2" multiple = "multiple" data-placeholder="Selecciona los temas de investigación" style="width: 100%">
                                    @foreach($topics as $topic)
                                        <optgroup class="optgroup" label="{{$topic->research_topic}}">
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
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="date">Fecha</label>
                                        <input type="date" id="date" name="date" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="resource">Recurso</label>
                                        <input id="resource" name="resource" type="file" class="form-control" accept="image/*">
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
                        <button type="reset" class="btn btn-warning btn-flat pull-left">
                            <span class="glyphicon glyphicon-erase"></span>
                            {{ __('Limpiar') }}
                        </button>
                        <button type="submit" class="btn btn-primary btn-flat pull-right">
                            <span class="glyphicon glyphicon-plus"></span>
                            {{ __('Crear') }}
                        </button>
                    </div>

                </form>


            </div>


        </div>
    </section>

    <script src="{{asset('select2/select2.full.min.js')}}"></script>
    <script>
        $('#subtopics').select2();
        $('li.li').removeClass('active');
        $('li#document').addClass('active');
        $('li#documentCreate').addClass('active');

        $('#hasFacsim').on('ifToggled',function () {
            $('input#facsim').attr("disabled", !this.checked);
        });

        function modifyResource() {
            if($('#document_type')){

            }
        }


    </script>

@endsection