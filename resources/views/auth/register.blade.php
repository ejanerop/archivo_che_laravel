@extends('layouts.auth')

@section('content')
<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <a href="/">Archivo <b>Che</b></a>
        </div>

        <div class="register-box-body">

            <p class="login-box-msg">Introduce tus datos</p>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group has-feedback">
                    <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" placeholder="Usuario" required autofocus>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if ($errors->has('username'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group has-feedback">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Correo" required>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group has-feedback">
                    <input id="full_name" type="text" class="form-control{{ $errors->has('full_name') ? ' is-invalid' : '' }}" name="full_name" value="{{ old('full_name') }}" placeholder="Nombre (opcional)">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if ($errors->has('full_name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('full_name') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group has-feedback">
                    <input id="entity" type="text" class="form-control{{ $errors->has('entity') ? ' is-invalid' : '' }}" name="entity" value="{{ old('entity') }}" placeholder="Entidad (opcional)">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('entity'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('entity') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group has-feedback">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Contraseña" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group has-feedback">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Repetir contraseña" required>
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                </div>

                <div class="row">
                    <div class="col-xs-8"> </div><!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                            {{ __('Registrar') }}
                        </button>
                    </div><!-- /.col -->
                </div>
            </form>
            <div class="box-footer">
                <a href="{{route('login')}}" class="text-center">Ya tengo una cuenta</a>
            </div>
        </div>
    </div>
</body>
@endsection
