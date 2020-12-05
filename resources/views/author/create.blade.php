@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            Autores
            <small>Nuevo autor</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('home')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="{{route('author.index')}}"><i class="fa fa-book"></i> Autores</a></li>
            <li class="active">Nuevo autor</li>
        </ol>
    </section>

    <section class="content">
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
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header">
                    </div>
                    <form id="author" method="POST" action="{{route('author.store')}}">
                        @csrf
                        <div class="box-body">
                            <div class="form-group {{$errors->has('name')?"has-error":""}}">
                                <label for="name">Nombre del autor</label>
                                <input type="text" id="name" name="name" class="form-control" value="{{old('name')}}" placeholder="Nombre del autor" style="display: inline-block" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Descripción</label>
                                <textarea id="description" name="description" class="form-control" rows="4" style="resize: none" placeholder="Descripción del autor"></textarea>
                            </div>
                            <div class="box-footer">
                                <a href="{{route('author.index')}}" class="btn btn-danger pull-left">
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
        $('li#author').addClass('active');
        $('li#authorCreate').addClass('active');
        $('#author').validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 191
                }
            },
            messages: {
                author: {
                    required: "Debe llenar este campo",
                    maxlength: "El nombre del autor no puede exceder los 191 caracteres"
                }
            }
        });
    </script>
@endsection
