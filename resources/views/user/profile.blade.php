@extends('layouts.app')

@section('content')

<section class="content-header">
    <h1>
        Perfil de usuario
        <small>{{$user->username}}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-home"></i> Inicio</a></li>
        <li class="active"> Perfil de usuario</li>
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
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="/user.png" alt="User profile picture">
                        <h3 class="profile-username text-center">{{$user->username}}</h3>
                        <p class="text-muted text-center">{{$user->roles->name}}</p>
                        <ul class="list-group list-group-unbordered">
                            @if ($user->full_name != '')
                            <li class="list-group-item">
                              <b>Nombre</b> <a class="pull-right">{{$user->full_name}}</a>
                            </li>
                            @endif
                            <li class="list-group-item">
                              <b>Correo</b> <a class="pull-right">{{$user->email}}</a>
                            </li>
                            @if ($user->entity != '')
                            <li class="list-group-item">
                                <b>Entidad</b> <a class="pull-right">{{$user->entity}}</a>
                            </li>
                            @endif

                        </ul>
                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalPassChange">
                            <i class="fa fa-edit"></i>
                             Cambiar contraseña
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-md-5">

            </div>
        </div>
        </div>
    </section>

    <div class="modal fade in" id="modalPassChange" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
              <h4 class="modal-title">Cambiar contraseña</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('pass.change',['id' => $user->id])}}">
                @csrf
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon glyphicon glyphicon-time"></span>
                                <input type="password" id="old_password" name="old_password" class="form-control" placeholder="Escriba su contraseña anterior">
                                <input type="hidden" id="pass" name="pass" value="{{$user->password}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon glyphicon glyphicon-lock"></span>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Escriba su contraseña nueva">
                            </div>
                        </div>
                    </div>
                </div>
                  <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon glyphicon glyphicon-repeat"></span>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Repita la contraseña">
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Filtrar</button>
              </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
    </div>

    <script>
        $('span#ok').removeClass("hidden").delay(6000).queue(function(next){
            $(this).removeClass("hidden");
            next();
        });
    </script>
@endsection
