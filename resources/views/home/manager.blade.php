@section('home')
    <div class="row justify-content-center">
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{\Stats::documentsCount()}}</h3>
                    <p>Cantidad de documentos</p>
                </div>
                <div class="icon">
                    <i class="ion ion-android-document"></i>
                </div>
                <a href="{{route('document.index')}}" class="small-box-footer">Ir a documentos <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{\Stats::usersCount()}}</h3>
                    <p>Cantidad de usuarios</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person"></i>
                </div>
                <a href="{{route('user.index')}}" class="small-box-footer">Ir a usuarios <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-6 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Últimas solicitudes sin responder</h3>
                    <a class="btn-sm btn-info pull-right" href="{{route('petition.index')}}">Lista de solicitudes <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                <div class="box-body">
                    <table id="table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Posición</th>
                                <th>Usuario</th>
                                <th>Fecha</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        @foreach(\Stats::last5Petitions() as $index => $petition)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>{{$petition->user->username}}</td>
                            <td>{{$petition->created_date}}</td>
                            <td>
                                <a href="{{route('petition.show' , ['petition' => $petition])}}" class="btn btn-xs btn-info"><span class="fa fa-mail-forward" style="margin-right: 2px"></span> Responder</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
