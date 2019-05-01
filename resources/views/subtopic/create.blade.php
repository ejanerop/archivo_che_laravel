@extends('layouts.app')

@section('content')

    <section class="content-header">
        <div class="container">
            <h2>Nuevo subtema de investigación</h2>
        </div>
    </section>

<section class="content">
    <div class="row justify-content-center">
        <div class="col-md-12 form-box">
            <div class="box box-primary width-auto">
                <div class="box-header"></div>
                <form id="topic" method="POST" action="/subtopic">
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