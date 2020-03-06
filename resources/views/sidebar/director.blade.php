@section('sidebar_items')

    <li class="header">Gestión</li>
    <li id="document" class="li treeview">
        <a href="#"><span>Documentos</span> <span class="fa fa-file-text pull-right"></span></a>
        <ul class="treeview-menu">
            <li id="documentList"><a href="{{route('document.index')}}">Lista de documentos <span class="fa fa-list-ul pull-right"></span></a></li>
        </ul>
    </li>
    <li class="header">Actividad de usuarios</li>
    <li id="log" class="li treeview">
        <a href="#"><span>Registro de actividad</span> <span class="fa fa-exchange pull-right"></span></a>
        <ul class="treeview-menu">
            <li id="logList"><a href="{{route('log.index')}}">Lista de acciones<span class="fa fa-list-ul pull-right"></span></a></li>
            <li id="logStats"><a href="{{route('log.stats')}}">Datos de uso<span class="fa fa-bar-chart pull-right"></span></a></li>
        </ul>
    </li>

@endsection
