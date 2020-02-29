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
                        <h3 class="box-title">Top 5 documentos más consultados</h3>
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
    </section>

    <script>
        $(function () {
            $('li.li').removeClass('active');
            $('li#log').addClass('active');
            $('li#logStats').addClass('active');
        });
    </script>

@endsection
