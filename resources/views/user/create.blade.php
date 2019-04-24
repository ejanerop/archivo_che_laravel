@extends('layouts.app')

@section('content')

    <section class="content-header">
        <div class="container">
            <h2>Nuevo usuario</h2>
        </div>
    </section>

    <section class="content">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="box box-primary">
                    <div class="box-header"></div>
                    <form role="form" method="POST" action="/user">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon glyphicon glyphicon-user"></span>
                                    <input id="username" type="text" class="form-control" name="username" placeholder="Usuario" required autofocus>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon glyphicon glyphicon-envelope"></span>
                                    <input id="email" type="email" class="form-control" name="email" placeholder="Correo electrónico" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon glyphicon glyphicon-lock"></span>
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Contraseña" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon glyphicon glyphicon-log-in"></span>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Repetir contraseña" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><strong>Rol</strong></span>
                                    <select id="role" name="role" class="form-control">
                                            @foreach($roles as $role)
                                                <option id="{{$role->id}}">{{$role->name}}</option>
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

@endsection
