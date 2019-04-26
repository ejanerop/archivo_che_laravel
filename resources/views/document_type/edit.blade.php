@extends('layouts.app')

@section('content')

    <section class="content-header">
        <div class="container">
            <h2>Editar tipo de documeto</h2>
        </div>
    </section>

    <section class="content">
        <div class="row justify-content-center">
            <div class="col-md-12 form-box">
                <div class="box box-primary width-auto">
                    <div class="box-header"></div>
                    <form method="POST" action="/document_type/{{$document_type->id}}">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="document_type"> Tipo de documento</label>
                                    <input type="text" id="document_type" name="document_type" class="form-control" value="{{$document_type->document_type}}" placeholder="Tipo de documento">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="resource_type">Tipo de recurso</label>
                                <select id="resource_type" name="resource_type" class="form-control">
                                    @foreach($resource_types as $type)
                                        <option id="{{$type->id}}">{{$type->resource_type}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="box-footer">
                                <button type="button" class="btn btn-danger btn-flat pull-left">
                                    <span class="glyphicon glyphicon-remove"></span>
                                    {{ __('Cancelar') }}
                                </button>
                                <button type="submit" class="btn btn-primary btn-flat pull-right">
                                    <span class="glyphicon glyphicon-floppy-save"></span>
                                    {{ __('Guardar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection