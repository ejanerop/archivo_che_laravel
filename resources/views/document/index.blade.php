@extends('layouts.app')

@section('content')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li><a id="homeTab" href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Datos</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-file-code-o bg-green"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">{{$documents->count()}} documentos</h4>
                    <p></p>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->



          </div><!-- /.tab-pane -->
          <!-- Settings tab content -->
          <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
              <h3 class="control-sidebar-heading">General Settings</h3>
              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Report panel usage
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Some information about this general settings option
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Allow mail redirect
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Other sets of options are available
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Expose author name in posts
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Allow the user to show his name in blog posts
                </p>
              </div><!-- /.form-group -->

              <h3 class="control-sidebar-heading">Chat Settings</h3>

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Show me as online
                  <input type="checkbox" class="pull-right" checked>
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Turn off notifications
                  <input type="checkbox" class="pull-right">
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Delete chat history
                  <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                </label>
              </div><!-- /.form-group -->
            </form>
          </div><!-- /.tab-pane -->
        </div>
    </aside><!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>



    <section class="content-header">
        <h1>
            Documentos
            <small>Lista</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('home')}}"><i class="fa fa-home"></i> Inicio</a></li>
            <li><i class="fa fa-file-text"></i> Documentos</li>
            <li class="active"> Lista de documentos</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><span class="glyphicon glyphicon-ok"></span></h4>
                        <strong>{{ session('success') }}</strong>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><span class="glyphicon glyphicon-ban-circle"></span></h4>
                        <strong>{{ session('error') }}</strong>
                    </div>
                @endif
                <div class="box box-primary">
                    <div class="box-header">
                        @if (\Auth::user()->hasRole('manager'))
                        <a href="{{route('document.create')}}" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Nuevo</a>
                        @endif

                        @if($filtered)
                            <a href="{{route('document.index')}}" class="btn btn-danger">
                                <i class="fa fa-close"></i>
                                 Quitar filtro</a>
                        @else
                            <button type="button" class="btn btn-primary pull-left" data-toggle="modal" data-target="#exampleModalCenter">
                                <i class="fa fa-filter"></i>
                                 Filtrar
                            </button>
                        @endif
                    </div>
                    <div class="box-body">
                        <table id="table" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Tipo de documento</th>
                                <th>Fecha</th>
                                <th>Nivel de acceso</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            @foreach($documents as $document)
                                <tr>
                                    <td>{{$document->name}}</td>
                                    <td>{{$document->description}}</td>
                                    <td>{{$document->document_type->document_type}}</td>
                                    <td>{{$document->date_formated}}</td>
                                    <td>{{$document->access_level->name}}</td>
                                    <td>
                                        <form action="{{route('document.destroy', ['document' => $document->id])}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{route('document.show', ['document' => $document->id])}}" class="btn btn-xs btn-success"><span class="fa fa-eye" style="margin-right: 2px"></span> Mostrar</a>
                                            @if (\Auth::user()->hasRole('manager'))
                                                <a href="{{route('document.edit', ['document' => $document->id])}}" class="btn btn-xs btn-info"><span class="fa fa-edit" style="margin-right: 2px"></span> Editar</a>
                                                <button type="submit" onclick="return confirm('Está seguro que desea eliminar el documento {{$document->name}}?')" class="btn btn-xs btn-danger"><span class="fa fa-remove" style="margin-right: 2px"></span> Eliminar</button>
                                            @endif
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                        </table>
                        <div class="pull-right">
                            {{$documents->render()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal -->
        <div class="modal fade in" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-lg ">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Filtrar</h4>
              </div>
              <div class="modal-body">
                <form action="{{route('document.filter')}}" method="GET">
                  <div class="container-fluid">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="nameFilter">Nombre del documento</label>
                          <input id="nameFilter" name="nameFilter" type="text" class="form-control" placeholder="Título completo o parcial del documento">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                            <label for="authorFilter">Autor del documento</label>
                            <input id="authorFilter" name="authorFilter" type="text" class="form-control" placeholder="Nombre del autor">
                          </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="radio" name="filterTime" id="filterByStage">
                                <label for="filterByStage">Filtrar por etapa cronológica</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="radio" name="filterTime" id="filterByDate">
                                <label for="filterByDate">Filtrar por fechas</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="stagesFilter">Etapas</label>
                          <select id="stagesFilter" name="stagesFilter[]" class="form-control select2 filterSelect" multiple = "multiple" data-placeholder="Selecciona las etapas" style="width: 100%" disabled>
                            @foreach($stages as $stage)
                              <option class="opt" id="{{$stage->id}}">{{$stage->name}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <label for="dateStartFilter">Fecha de inicio</label>
                        <input type="text" id="dateStartFilter" name="dateStartFilter" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask disabled nullable>
                      </div>
                      <div class="col-md-3">
                        <label for="dateEndFilter">Fecha de fin</label>
                        <input type="text" id="dateEndFilter" name="dateEndFilter" class="form-control" data-inputmask="'alias': 'dd-mm-yyyy'" data-mask disabled nullable>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="subtopicsFilter">Subtemas de investigación</label>
                                <select id="subtopicsFilter" name="subtopicsFilter[]" class="form-control select2 filterSelect" multiple = "multiple" data-placeholder="Selecciona los temas de investigación" style="width: 100%">
                                    @foreach($topics as $topic)
                                    <optgroup label="{{$topic->research_topic}}">
                                        @foreach($topic->subtopics as $subtopic)
                                        <option id="{{$subtopic->id}}">{{$subtopic->name}}</option>
                                        @endforeach
                                    </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="document_typesFilter">Tipos de documento</label>
                                <select id="document_typesFilter" name="document_typesFilter[]" class="form-control select2 filterSelect" multiple = "multiple" data-placeholder="Selecciona los tipos de documento" style="width: 100%">
                                  @foreach($resource_types as $resType)
                                  <optgroup class="optgroup" label="{{$resType->resource_type}}">
                                    @foreach($resType->document_types as $docType)
                                    <option class="opt {{$resType->resource_type}}" id="{{$docType->id}}">{{$docType->document_type}}</option>
                                    @endforeach
                                  </optgroup>
                                  @endforeach
                                </select>
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
    </section>

    <script src="{{asset('select2/select2.full.min.js')}}"></script>
    <script src="{{asset('input-mask/jquery.inputmask.js')}}"></script>
    <script src="{{asset('input-mask/jquery.inputmask.date.extensions.js')}}"></script>
    <script src="{{asset('input-mask/jquery.inputmask.extensions.js')}}"></script>

    <script src="{{asset('js/scripts/document/index.js')}}"></script>

@endsection
