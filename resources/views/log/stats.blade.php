@extends('layouts.app')

@section('content')

    <section class="content-header">
        <div class="container">
            <h3>Actividad</h3>
        </div>
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
                            @foreach($top5Docs as $index => $doc)
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
                            @foreach($top5Subtopics as $index => $subtopic)
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
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </section>

    <script src="{{asset('chart-js/Chart.min.js')}}"></script>
    <script>
        $(function () {
            $('li.li').removeClass('active');
            $('li#log').addClass('active');
            $('li#logStats').addClass('active');
        });
    </script>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
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
