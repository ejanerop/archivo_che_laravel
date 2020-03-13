@extends('layouts.app')

@section('content')

    <section class="content-header">
        <h1>
            Usuarios
            <small>Editar</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('home')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li><i class="fa fa-users"></i> Usuarios</li>
            <li class="active"> Editar</li>
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
                        <h4>Editar usuario</h4>
                    </div>
                    <form role="form" method="POST" action="{{route('user.update', ['user' => $user->id])}}">
                        @method('PUT')
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user" style="width: 14px; height: 14px"></i></span>
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
                                    <span class="input-group-addon"><i class="fa fa-envelope" style="width: 14px; height: 14px"></i></span>
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
                                    <span class="input-group-addon"><i class="fa fa-users" style="width: 14px; height: 14px"></i></span>
                                    <select id="role" name="role" class="form-control">
                                        @foreach($roles as $role)
                                            <option id="{{$role->id}}" {{$user->roles->id == $role->id ? 'selected' : ''}}>{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="box box-primary box-solid collapsed-box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Cambiar contraseña</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                                    </div><!-- /.box-tools -->
                                </div><!-- /.box-header -->
                                <div class="box-body" style="display: none;">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock" style="width: 14px; height: 14px"></i></span>
                                            <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Nueva contraseña">
                                        </div>
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-repeat" style="width: 14px; height: 14px"></i></span>
                                            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="Repetir contraseña">
                                        </div>
                                    </div>
                                </div><!-- /.box-body -->
                            </div>
                            <div class="box-footer">
                                <a href="{{route('user.index')}}" class="btn btn-danger pull-left">
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
        $('li#user').addClass('active');
        $('li#userList').addClass('active');
    </script>

@endsection
