<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="hold-transition fixed skin-blue">

    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                    <h3 class="box-title">Top 5 documentos más consultados</h3>
                    </div>
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
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                    <h3 class="box-title">Información general</h3>
                    </div>
                    <div class="box-body">
                        <table id="table" class="table table-bordered table-hover">
                            <tr>
                                <th>Cantidad de documentos</th>
                                <td>{{\Stats::documentsCount()}}</td>
                            </tr>
                            <tr>
                                <th>Cantidad de temas de investigación</th>
                                <td>{{\Stats::topicsCount()}}</td>
                            </tr>
                            <tr>
                                <th>Cantidad de subtemas de investigación</th>
                                <td>{{\Stats::subtopicsCount()}}</td>
                            </tr>
                            <tr>
                                <th>Cantidad de usuarios</th>
                                <td>{{\Stats::usersCount()}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Información de usuarios</h3>
                    </div>
                    <div class="box-body">
                        <table id="table" class="table table-bordered table-hover">
                            <tr>
                                <th>Usuario con más consultas</th>
                                <td>{{\Stats::userMostVisits()->username}}</td>
                            </tr>
                            <tr>
                                <th>Cantidad de investigadores internos</th>
                                <td>{{\Stats::userCountByRole('inv.int')}}</td>
                            </tr>
                            <tr>
                                <th>Cantidad de investigadores externos</th>
                                <td>{{\Stats::userCountByRole('inv.ext')}}</td>
                            </tr>
                            <tr>
                                <th>Cantidad de invitados</th>
                                <td>{{\Stats::userCountByRole('guest')}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Información de acceso a documentos</h3>
                    </div>
                    <div class="box-body">
                        <table id="table" class="table table-bordered table-hover">
                            <tr>
                                <th>Cantidad de consultas a documentos</th>
                                <td>{{\Stats::docsAccessCount()}}</td>
                            </tr>
                            <tr>
                                <th>Documentos únicos consultados</th>
                                <td>{{\Stats::docsAccessCount()}}</td>
                            </tr>
                            <tr>
                                <th>Consultas a documentos por investigadores internos</th>
                                <td>{{\Stats::docsAccessCountByRole('inv.int')}}</td>
                            </tr>
                            <tr>
                                <th>Consultas a documentos por investigadores internos</th>
                                <td>{{\Stats::docsAccessCountByRole('inv.ext')}}</td>
                            </tr>
                            <tr>
                                <th>Consultas a documentos por invitados</th>
                                <td>{{\Stats::docsAccessCountByRole('guest')}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </section>

</body>
</html>
