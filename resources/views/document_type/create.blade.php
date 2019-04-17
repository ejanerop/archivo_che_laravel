@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">{{ __('Nuevo tipo de documento') }}</div>

                    <div class="card-body">
                        <form method="POST" action="" enctype="multipart/form-data">
                            <div class="form-body">
                                <div class="form-group">
                                    <label for="name">Tipo de documento</label>
                                    <input type="text" id="name" class="form-control col-md-10" placeholder="Tipo">
                                </div>

                                <div class="form-group">
                                    <label for="resource_type">Tipo de recurso</label>
                                    <select id="resource_type" class="form-control col-md-10" rows="3">
                                        @foreach($resource_types as $type)
                                        <option id="{{$type->id}}">{{$type->resource_type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="">
                                <button type="submit" class="btn btn-primary">Crear</button>
                                <button type="button" class="btn btn-secondary">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection