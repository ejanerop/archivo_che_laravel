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
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header">
                        <h4>Nuevo tipo de documento</h4>
                    </div>
                    <form id="doctype" method="POST" action="{{route('document_type.store')}}">
                        @csrf
                        <div class="box-body">
                            <div class="form-group {{$errors->has('document_type')?"has-error":""}}">
                                    <label for="document_type">Tipo de documento</label>
                                    <input type="text" id="document_type" name="document_type" class="form-control" placeholder="Tipo de documento" value="{{old('document_type')}}" style="display: inline-block" required>
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
                                <a href="{{route('document_type.index')}}" class="btn btn-danger pull-left">
                                    <span class="fa fa-remove"></span>
                                    {{ __('Cancelar') }}
                                </a>
                                <button type="submit" class="btn btn-success pull-right">
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
        $('li#typeCreate').addClass('active');
        $('#doctype').validate({
            rules: {
                document_type: {
                    required: true,
                    maxlength: 191
                }
            },
            messages: {
                document_type: {
                    required: "Debe llenar este campo",
                    maxlength: "El tipo de documento no puede exceder los 191 caracteres"
                }
            }
        });
    </script>

@endsection
