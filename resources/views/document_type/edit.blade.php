@extends('layouts.app')

@section('content')

    <section class="content-header">
        <div class="container">
            <h2>Editar tipo de documeto</h2>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="box box-primary width-auto">
                    <div class="box-header"></div>
                    <form method="POST" action="{{route('document_type.edit', ['document_type' => $document_type->id])}}">
                        @method('PUT')
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