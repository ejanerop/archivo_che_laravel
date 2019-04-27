@extends('layouts.app')

@section('content')

    <section class="content-header">
        <div class="container">
            <h2>Editar usuario usuario</h2>
        </div>
    </section>

    <section class="content">
        <div class="row justify-content-center">
            <div class="col-md-12 form-box">
                <div class="box box-primary width-auto">
                    <div class="box-header"></div>
                    <form role="form" method="POST" action="/user/{{$user->id}}">
                        @method('PUT')
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon glyphicon glyphicon-user"></span>
                                    <input id="username" type="text" class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" placeholder="Usuario" value="{{$user->username}}" required autofocus>
                                </div>
                                @if ($errors->has('username'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon glyphicon glyphicon-envelope"></span>
                                    <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="Correo electrónico" value="{{$user->email}}" required>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon glyphicon glyphicon-lock"></span>
                                    <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Nueva contraseña">
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon glyphicon glyphicon-log-in"></span>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Repetir contraseña">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><strong>Rol</strong></span>
                                    <select id="role" name="role" class="form-control">
                                        @foreach($roles as $role)
                                            <option id="{{$role->id}}" {{$user->roles->id == $role->id ? 'selected' : ''}}>{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="button" class="btn btn-danger btn-flat pull-left">
                                    <span class="glyphicon glyphicon-remove"></span>
                                    {{ __('Cancelar') }}
                                </button>
                                <button type="submit" class="btn btn-primary btn-flat pull-right">
                                    <span class="glyphicon glyphicon-floppy-save"></span>
                                    {{ __('Guardar') }}
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
        $('li#user').addClass('active');
        $('li#userList').addClass('active');
    </script>

@endsection
