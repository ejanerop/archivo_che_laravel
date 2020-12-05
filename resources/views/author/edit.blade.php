@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            Autores
            <small>Editar autor</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('home')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li><a href="{{route('author.index')}}"><i class="fa fa-book"></i> Autores</a></li>
            <li class="active">Editar autor {{$author->name}}</li>
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
                <div class="box box-primary width-auto">
                    <div class="box-header">
                        <h4>Editar autor</h4>
                    </div>
                    <form id="author"method="POST" action="{{route('author.update', ['author' => $author->id])}}">
                        @method('PUT')
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">Nombre del autor</label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Nombre del autor" value="{{$author->name}}" style="display: inline-block" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Descripción</label>
                                <textarea id="description" name="description" class="form-control" rows="4" style="resize: none" placeholder="Descripción del tema">{{$researchTopic->description}}</textarea>
                            </div>
                            <div class="box-footer">
                                <a href="{{route('author.index')}}" class="btn btn-danger pull-left">
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
        $('li#author').addClass('active');
        $('li#authorList').addClass('active');
        $('#author').validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 191
                }
            },
            name: {
                research_topic: {
                    required: "Debe llenar este campo",
                    maxlength: "El nombre del tema no puede exceder los 191 caracteres"
                }
            }
        });
    </script>

@endsection
