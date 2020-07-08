@extends('layouts.app')

@section('content')

<section class="content-header">
    <h1>
        Registro de actividad
        <small>Datos de uso</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-home"></i> Inicio</a></li>
        <li><a href="{{route('log.index')}}"><i class="fa fa-exchange"></i> Registro de actividad</a></li>
        <li class="active">Datos de uso</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Top 5 documentos más consultados</h3>
                </div>
                <div class="box-body">
                    <table id="table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Posición</th>
                                <th>Nombre</th>
                                <th>Tipo de documento</th>
                                <th>Fecha</th>
                                <th>Visitas</th>
                            </tr>
                        </thead>
                        @foreach(\Stats::top5Docs() as $index => $doc)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>{{$doc->name}}</td>
                            <td>{{$doc->document_type->document_type}}</td>
                            <td>{{$doc->date_formated}}</td>
                            <td>{{$doc->visits}}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Top 5 subtemas de investigación más consultados</h3>
                </div>
                <div class="box-body">
                    <table id="table" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Posición</th>
                                <th>Nombre</th>
                                <th>Tema perteneciente</th>
                                <th>Visitas</th>
                            </tr>
                        </thead>
                        @foreach(\Stats::top5Subtopics() as $index => $subtopic)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>{{$subtopic->name}}</td>
                            <td>{{$subtopic->research_topic->research_topic}}</td>
                            <td>{{$subtopic->visits}}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li id="liType1" class="active"><a href="#tabType_1" data-toggle="tab" aria-expanded="true" onclick="toggleTabType(1)">Cantidad de accesos por tipo de documento</a></li>
                    <li id="liType2" class=""><a href="#tabType_2" data-toggle="tab" aria-expanded="false" onclick="toggleTabType(2)">Cantidad de documentos por tipo</a></li>
                    <li class="pull-right"><a href="" id="saveTypes" class="text-muted"><i class="fa fa-download"></i></a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tabType_1">
                        <canvas id="typesWithAccess"></canvas>
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane" id="tabType_2">
                        <canvas id="typesWithCant"></canvas>
                    </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
            </div>
        </div>
        <div class="col-md-6">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li id="liTopic1" class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true" onclick="toggleTabTopic(1)">Cantidad de accesos por tema</a></li>
                    <li id="liTopic2" class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false" onclick="toggleTabTopic(2)">Cantidad de documentos por tema</a></li>
                    <li class="pull-right"><a href="" id="saveTopics" class="text-muted"><i class="fa fa-download"></i></a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <canvas id="topicsWithAccess"></canvas>
                    </div><!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_2">
                        <canvas id="topicsWithCant"></canvas>
                    </div><!-- /.tab-pane -->
                </div><!-- /.tab-content -->
            </div>
        </div>
    </div>
</section>

<script src="{{asset('filesaver/FileSaver.min.js')}}"></script>
<script src="{{asset('chart-js/Chart.min.js')}}"></script>
<script>
    $(function () {
        $('li.li').removeClass('active');
        $('li#log').addClass('active');
        $('li#logStats').addClass('active');
    });

    function toggleTabType(tab) {
        var tab1 = $('#liType1');
        var tab2 = $('#liType2');
        switch (tab) {
            case 1:
            tab1.addClass('active');
            tab2.removeClass('active');
            break;
            case 2:
            tab1.removeClass('active');
            tab2.addClass('active');
            break;
        }
    }
    function toggleTabTopic(tab) {
        var tab1 = $('#liTopic1');
        var tab2 = $('#liTopic2');
        switch (tab) {
            case 1:
            tab1.addClass('active');
            tab2.removeClass('active');
            break;
            case 2:
            tab1.removeClass('active');
            tab2.addClass('active');
            break;
        }
    }
</script>


<script>

    var backgroundColor = 'white';
    Chart.plugins.register({
        beforeDraw: function(c) {
            var ctx = c.chart.ctx;
            ctx.fillStyle = backgroundColor;
            ctx.fillRect(0, 0, c.chart.width, c.chart.height);
        }
    });

    var ctx = document.getElementById('typesWithAccess').getContext('2d');
    var typesWithAccess = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
            @foreach (\Stats::typesWithAccess()->keys() as $item)
            "{{ $item }}",
            @endforeach
            ],
            datasets: [{
                label: 'Cantidad de accesos',
                data: {{\Stats::typesWithAccess()->values()}},
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

    $('#saveTypes').click(function() {
        if ($('#liType1').hasClass('active')) {
            var graph = document.getElementById('typesWithAccess');
        } else {
            var graph = document.getElementById('typesWithCant');
        }
        graph.toBlob(function(blob) {
        saveAs(blob, "Gráfico.png");
    });
    });
</script>
<script>
    var ctx = document.getElementById('typesWithCant').getContext('2d');
    var typesWithCant = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
            @foreach (\Stats::typesWithCant()->keys() as $item)
            "{{ $item }}",
            @endforeach
            ],
            datasets: [{
                label: 'Cantidad de documentos',
                data: {{\Stats::typesWithCant()->values()}},
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
<script>
    var ctx = document.getElementById('topicsWithCant').getContext('2d');
    var typesWithAccess = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
            @foreach (\Stats::topicsWithCant()->keys() as $item)
            "{{ $item }}",
            @endforeach
            ],
            datasets: [{
                label: 'Cantidad de documentos',
                data: {{\Stats::topicsWithCant()->values()}},
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

    $('#saveTopics').click(function() {
        if ($('#liTopic1').hasClass('active')) {
            var graph = document.getElementById('topicsWithAccess');
        } else {
            var graph = document.getElementById('topicsWithCant');
        }
        graph.toBlob(function(blob) {
        saveAs(blob, "Gráfico.png");
    });
    });
</script>



@endsection
