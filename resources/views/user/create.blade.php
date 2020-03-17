@extends('layouts.app')

@section('content')

    <script>
        $('li.li').removeClass('active');
        $('li#user').addClass('active');
        $('li#userCreate').addClass('active');
        $('#user').validate({
            rules: {
                username: {
                    required: true,
                    minlength: 3,
                    maxlength: 255
                },
                password: {
                    required: true,
                    minlength: 8
                },
                password_confirm: {
                    required: true,
                    minlength: 8,
                    equalTo: "#password"
                },
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                username: {
                    required: "Escribe un nombre de usuario",
                    minlength: "El usuario debe tener al menos 3 caracteres",
                    maxlength: "Detente"
                },
                password: {
                    required: "Escribe una contraseña",
                    minlength: "Tu contraseña debe tener al menos 8 caracteres"
                },
                confirm_password: {
                    required: "Escribe una contraseña",
                    minlength: "Tu contraseña debe tener al menos 8 caracteres",
                    equalTo: "Las contraseñas no coinciden"
                },
                email: "Escribe una dirección de correo válida"
            }
        });
    </script>

    <section class="content-header">
        <h1>
            Usuarios
            <small>Crear</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('home')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li><i class="fa fa-users"></i> Usuarios</li>
            <li class="active"> Nuevo</li>
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
                        <h4>Nuevo usuario</h4>
                    </div>
                    <form id="user" role="form" method="POST" action="{{route('user.store')}}">
                        @csrf
                        <div class="box-body">
                            <div class="form-group has-feedback">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user" style="width: 14px; height: 14px"></i></span>
                                    <input id="username" type="text" class="form-control" name="username" placeholder="Usuario" value="{{ old('username') }}" required autofocus>
                                    </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope" style="width: 14px; height: 14px"></i></span>
                                    <input id="email" type="email" class="form-control" name="email" placeholder="Correo electrónico" value="{{ old('email') }}" required>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user" style="width: 14px; height: 14px"></i></span>
                                    <input id="full_name" type="text" class="form-control" name="full_name" placeholder="Nombre (opcional)" value="{{ old('full_name') }}">
                                    </div>
                            </div>
                            <div class="form-group has-feedback">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-university" style="width: 14px; height: 14px"></i></span>
                                    <input id="entity" type="text" class="form-control" name="entity" placeholder="Entidad perteneciente (opcional)" value="{{ old('entity') }}">
                                    </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock" style="width: 14px; height: 14px"></i></span>
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Contraseña" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-repeat" style="width: 14px; height: 14px"></i></span>
                                    <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="Repetir contraseña" required>
                                </div>
                                @if ($errors->has('password_confirmation'))
                                    <span class="invalid-feedback marginLeft39" role="alert">
                                        <strong class="text-red">{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-users" style="width: 14px; height: 14px"></i></span>
                                    <select id="role" name="role" class="form-control">
                                            @foreach($roles as $role)
                                                <option id="{{$role->id}}">{{$role->name}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="box-footer">
                                <a href="{{route('user.index')}}" class="btn btn-danger pull-left">
                                    <span class="fa fa-remove"></span>
                                    {{ __('Cancelar') }}
                                </a>
                                <button type="submit" class="btn btn-primary pull-right">
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

@endsection

