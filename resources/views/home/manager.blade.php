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
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                  <h3>{{\Stats::topicsCount()}}</h3>
                  <p>Cantidad de temas de investigación</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{route('research_topic.index')}}" class="small-box-footer">Ir a temas de investigación <i class="fa fa-arrow-circle-right"></i></a>
              </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-red">
                <div class="inner">
                  <h3>{{\Stats::visitorsToday()}}</h3>
                  <p>Cantidad de visitantes hoy</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{route('log.index')}}" class="small-box-footer">Ir registro de actividad <i class="fa fa-arrow-circle-right"></i></a>
              </div>
        </div>


    </div>
    <div class="row justify-content-center">
        <div class="col-lg-7 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Cantidad de acceso a documentos por tema de investigación</h3>
                    </div>
                <div class="box-body">
                    <canvas id="topicsWithAccess"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <p id="time"></p>
                    <h3 class="box-title">Últimas solicitudes sin responder</h3>
                    <a class="btn-sm btn-primary pull-right" href="{{route('petition.index')}}">Lista de solicitudes <i class="fa fa-arrow-circle-right"> </i></a>
                </div>
                <div class="box-body">
                    <table id="table" class="table table-bordered">
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


    <script src="{{asset('chart-js/Chart.min.js')}}"></script>

    <script>
        $('table#table').DataTable({
                paging : false,
                sort : false,
                language : {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla =(",
                    "sInfo":           "Mostrando _TOTAL_ solicitudes",
                    "sInfoEmpty":      "Mostrando del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    },
                    "buttons": {
                        "copy": "Copiar",
                        "colvis": "Visibilidad"
                }
            }
            });
    </script>

    <script>
        var timestamp = '<?=time();?>';
        function updateTime(){
        $('#time').html(Date(timestamp));
        timestamp++;
        }
        $(function(){
        setInterval(updateTime, 1000);
        });
    </script>

<script>
    var ctx = document.getElementById('topicsWithAccess').getContext('2d');
    var typesWithAccess = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
            @foreach (\Stats::topicsWithAccess()->keys() as $item)
            "{{ $item }}",
            @endforeach
            ],
            datasets: [{
                label: 'Cantidad de accesos',
                data: {{\Stats::topicsWithAccess()->values()}},
                backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>

@endsection


