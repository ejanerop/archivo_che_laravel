@extends('layouts.app')

@section('content')
    <section class="content-header">
        @if ($errors->any())
            <div class="alert alert-danger">
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
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="/user.png" alt="User profile picture">
                        <h3 class="profile-username text-center">{{$user->username}}</h3>
                        <p class="text-muted text-center">{{$user->roles->name}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="box box-primary">
                    <div class="box-header">Cambiar contraseña</div>
                    <div class="box-body">
                    <form method="POST" action="/pass_change/{{$user->id}}">
                        @csrf
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon glyphicon glyphicon-time"></span>
                                <input type="password" id="old_password" name="old_password" class="form-control" placeholder="Escriba su contraseña anterior">
                                <input type="hidden" id="pass" name="pass" value="{{$user->password}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon glyphicon glyphicon-lock"></span>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Escriba su contraseña nueva">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon glyphicon glyphicon-repeat"></span>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Repita la contraseña">
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-success btn-flat pull-left">
                                <span class="glyphicon glyphicon-floppy-save"></span>
                                {{ __('Guardar') }}
                            </button>
                            <h4><span class="pull-right glyphicon glyphicon-ok" style="color: #00a65a"></span></h4>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection