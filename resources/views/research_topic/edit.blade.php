@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Editar Temática') }}</div>

                    <div class="card-body">
                        <form method="POST" action="" enctype="multipart/form-data">
                            <div class="form-body">
                                <div class="form-group">
                                    <label for="research_topic">Temática de investigación</label>
                                    <input type="text" id="research_topic" class="form-control col-md-8" placeholder="Temática" value="{{$research_topic->research_topic}}">
                                </div>

                                <div class="form-group">
                                    <label for="description">Descripción</label>
                                    <textarea id="description" class="form-control col-md-8" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                                <button type="button" class="btn btn-secondary">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection