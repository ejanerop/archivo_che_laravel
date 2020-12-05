@section('home')
    <div class="row">
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="/user.png" alt="User profile picture">
                    <h3 class="profile-username text-center">{{\Auth::user()->username}}</h3>
                    <p class="text-muted text-center">{{\Auth::user()->roles->name}}</p>
                    <ul class="list-group list-group-unbordered">
                        @if (\Auth::user()->full_name != '')
                        <li class="list-group-item">
                        <b>Nombre</b> <a class="pull-right">{{\Auth::user()->full_name}}</a>
                        </li>
                        @endif
                        <li class="list-group-item">
                        <b>Correo</b> <a class="pull-right">{{\Auth::user()->email}}</a>
                        </li>
                        @if (\Auth::user()->entity != '')
                        <li class="list-group-item">
                            <b>Entidad</b> <a class="pull-right">{{\Auth::user()->entity}}</a>
                        </li>
                        @endif
                        <li class="list-group-item">
                            <b>Solicitudes</b> <a class="pull-right">{{\Auth::user()->petitions()->count()}}</a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-5">

        </div>
    </div>
@endsection
