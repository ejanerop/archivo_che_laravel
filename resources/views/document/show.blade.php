@extends('layouts.app')

@section('content')

    <section class="content-header">

    </section>

    <section class="content">
        <div class="box box-primary">
            <div class="box-header">

            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input id="name" name="name" type="text" class="form-control" value="{{$document->name}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="date">Fecha</label>
                            <input type="text" id="date" name="date" class="form-control" value="{{date('d-M-Y',strtotime($document->date))}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="era">Etapa</label>
                            <input type="text" id="era" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description">Descripción</label>
                            <textarea id="description" name="description" rows="5" class="form-control" style="resize:none" readonly >{{$document->description}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="document_type">Tipo de documento</label>
                            <input type="text" id="document_type" name="document_type" class="form-control" value="{{$document->document_type->document_type}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="access_level">Nivel de acceso</label>
                            <input type="text" id="access_level" name="access_level" class="form-control" value="{{$document->access_level->name}}" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                @foreach($document->resources as $resource)
                <img src="{{asset($resource->path)}}" alt="sd">
                @endforeach
            </div>
        </div>
    </section>


@endsection