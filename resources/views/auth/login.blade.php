@extends('layouts.auth')

@section('content')

<body class="hold-transition login-page">
    <div class="login-box">

        <div class="login-logo">
            <a href="/">Archivo <b>Che</b></a>
        </div>

        <div class="login-box-body">
            <div class="box-header">
                <p class="login-box-msg">Inicia sesión</p>
            </div>


            <form method="POST" action="{{ route('login') }}">
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
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Contraseña" required>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>

                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                              <input type="checkbox"> Remember Me
                            </label>
                          </div>
                    </div><!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar <i class="fa fa-sign-in"></i></button>
                    </div><!-- /.col -->
                </div>

            </form>
            <div class="box-footer">
                <a href="{{route('register')}}" class="text-center">No tengo cuenta</a>
            </div>


        </div>
    </div>
</body>
@endsection
