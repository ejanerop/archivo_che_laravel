@extends('layouts.app')

@section('content')

    <section class="content-header">
        <div class="container">
            <h2>Nuevo tipo de documeto</h2>
        </div>
    </section>

    <section class="content">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="box box-primary">
                    <div class="box-header"></div>
                    <form method="POST" action="/document_type">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" id="document_type" name="document_type" class="form-control" placeholder="Tipo de documento">
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
                                <button type="reset" class="btn btn-warning btn-flat pull-left">
                                    <span class="glyphicon glyphicon-erase"></span>
                                    {{ __('Limpiar') }}
                                </button>
                                <button type="submit" class="btn btn-primary btn-flat pull-right">
                                    <span class="glyphicon glyphicon-plus"></span>
                                    {{ __('Crear') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

@endsection