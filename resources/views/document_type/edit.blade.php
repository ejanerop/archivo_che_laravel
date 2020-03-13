@extends('layouts.app')

@section('content')

    <section class="content-header">
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
        <h1>
            Tipos de documentos
            <small>Editar</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('home')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="{{route('document_type.index')}}"><i class="fa fa-tags"></i> Tipos de documento</a></li>
            <li class="active">Editar {{$document_type->document_type}}</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header">
                        <h4>Editar tipo de documento</h4>
                    </div>
                    <form method="POST" action="{{route('document_type.update', ['document_type' => $document_type->id])}}">
                        @method('PUT')
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                    <label for="document_type"> Tipo de documento</label>
                                    <input type="text" id="document_type" name="document_type" class="form-control" value="{{$document_type->document_type}}" placeholder="Tipo de documento">
                            </div>
                            <div class="form-group">
                                <label for="resource_type">Tipo de recurso</label>
                                <select id="resource_type" name="resource_type" class="form-control">
                                    @foreach($resource_types as $type)
                                        <option id="{{$type->id}}" {{$document_type->resource_type->id == $type->id ? 'selected' : ''}}>{{$type->resource_type}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="box-footer">
                                <a href="{{route('document_type.index')}}" class="btn btn-danger pull-left">
                                    <span class="fa fa-remove"></span>
                                    {{ __('Cancelar') }}
                                </a>
                                <button type="submit" class="btn btn-primary pull-right">
                                    <span class="fa fa-save"></span>
                                    {{ __('Guardar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </section>

    <script>
        $('li.li').removeClass('active');
        $('li#document_type').addClass('active');
        $('li#typeList').addClass('active');
    </script>

@endsection
