@extends('layouts.app')

@section('content')

    <section class="content-header">
        <div class="container">
            <h2>Nuevo tema de investigación</h2>
        </div>
    </section>

    <section class="content">
        <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="box box-primary">
                        <div class="box-header"></div>
                        <form method="POST" action="/research_topic">
                            @csrf
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="research_topic">Tema de investigación</label>
                                    <input type="text" id="research_topic" name="research_topic" class="form-control" placeholder="Nombre del tema de investigación">
                                </div>
                                <div class="form-group">
                                    <label for="description">Descripción</label>
                                    <textarea id="description" name="description" class="form-control" rows="4" style="resize: none" placeholder="Descripción del tema"></textarea>
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
@endsection