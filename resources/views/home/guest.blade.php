@section('home')
    <div class="row">
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{asset('user.png')}}" alt="User profile picture">
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
@endsection
