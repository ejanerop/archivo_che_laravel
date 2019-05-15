@extends('layouts.app')

@section('content')

    <section class="content-header">
        <div class="container">
            <h2>Nuevo tipo de documeto</h2>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header"></div>
                    <form id="doctype" method="POST" action="{{route('document_type.store')}}">
                        @csrf
                        <div class="box-body">
                            <div class="form-group {{$errors->has('document_type')?"has-error":""}}">
                                    <label for="document_type">Tipo de documento</label>
                                    <input type="text" id="document_type" name="document_type" class="form-control" placeholder="Tipo de documento" style="display: inline-block" required>
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
                                <button type="reset" class="btn btn-warning pull-left">
                                    <span class="glyphicon glyphicon-erase"></span>
                                    {{ __('Limpiar') }}
                                </button>
                                <button type="submit" class="btn btn-primary pull-right">
                                    <span class="glyphicon glyphicon-plus"></span>
                                    {{ __('Crear') }}
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
        $('li#typeCreate').addClass('active');
        $('#doctype').validate({
            rules: {
                document_type: {
                    required: true,
                    maxlength: 191
                }
            },
            messages: {
                name: {
                    required: "Debe llenar este campo",
                    maxlength: "El tipo de documento no puede exceder los 191 caracteres"
                }
            }
        });
    </script>

@endsection