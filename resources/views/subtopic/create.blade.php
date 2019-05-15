@extends('layouts.app')

@section('content')

    <section class="content-header">
        <div class="container">
            <h2>Nuevo subtema de investigación</h2>
        </div>
    </section>

<section class="content">
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header"></div>
                <form id="topic" method="POST" action="{{route('subtopic.store')}}">
                    @csrf
                    <div class="box-body">
                        <div class="form-group {{$errors->has('name')?'has-error':''}}">
                            <label for="name">Nombre</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Temática" required>
                            @if($errors->has('name'))
                                <span class="text-red" role="alert">{{$errors->first('name')}}</span>
                            @endif

                        </div>
                        <div class="form-group">
                                <label for="description">Descripción</label>
                                <textarea id="description" name="description" class="form-control" rows="3" placeholder="Descripción del tema" style="resize: none"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <label for="research_topic">Tema de investigación relacionado</label>
                                <select id="research_topic" name="research_topic" class="form-control">
                                    @foreach($research_topics as $topic)
                                        <option id="{{$topic->id}}">{{$topic->research_topic}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="box-footer">
                            <a href="{{route('subtopic.index')}}" class="btn btn-danger pull-left">
                                <span class="fa fa-remove"></span>
                                {{ __('Cancelar') }}
                            </a>
                            <button type="submit" class="btn btn-primary btn-flat pull-right">
                                <span class="fa fa-plus"></span>
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
    $('li#subtopic').addClass('active');
    $('li#subtopicCreate').addClass('active');
    $('#topic').validate({
        rules: {
            name: {
                required: true,
                maxlength: 191
            }
        },
        messages: {
            name: {
                required: "Debe llenar este campo",
                maxlength: "El nombre del subtema no puede exceder los 191 caracteres"
            }
        }
    });
</script>

@endsection