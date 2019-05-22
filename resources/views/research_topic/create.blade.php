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
                        <h4>Nuevo tema de investigación</h4>
                    </div>
                    <form id="topic" method="POST" action="{{route('research_topic.store')}}">
                        @csrf
                        <div class="box-body">
                            <div class="form-group {{$errors->has('research_topic')?"has-error":""}}">
                                <label for="research_topic">Tema de investigación</label>
                                <input type="text" id="research_topic" name="research_topic" class="form-control" value="{{old('research_topic')}}" placeholder="Nombre del tema de investigación" style="display: inline-block" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Descripción</label>
                                <textarea id="description" name="description" class="form-control" rows="4" style="resize: none" placeholder="Descripción del tema"></textarea>
                            </div>
                            <div class="box-footer">
                                <a href="{{route('subtopic.index')}}" class="btn btn-danger pull-left">
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
        $('li#topic').addClass('active');
        $('li#topicCreate').addClass('active');
        $('#topic').validate({
            rules: {
                research_topic: {
                    required: true,
                    maxlength: 191
                }
            },
            messages: {
                research_topic: {
                    required: "Debe llenar este campo",
                    maxlength: "El nombre del tema no puede exceder los 191 caracteres"
                }
            }
        });
    </script>
@endsection