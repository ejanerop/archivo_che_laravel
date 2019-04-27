@extends('layouts.app')

@section('content')

    <section class="content-header">

    </section>

    <section class="content">


        <div class="box box-primary">
            <div class="box-header"></div>
            <div class="box-body">
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input id="name" name="name" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="description">Descripción</label>
                                <textarea id="description" name="description" class="form-control" style="resize:none" placeholder="Descripción"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="document_type">Tipo de documento</label>
                                        <select id="document_type"  name="document_type" class="form-control">
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
                            <img src="/user.png">
                            <input id="name" name="name" type="file" class="form-control"  accept="image/*">
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
    </script>

@endsection