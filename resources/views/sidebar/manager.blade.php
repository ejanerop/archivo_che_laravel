@section('sidebar_items')

    <li class="header">Administración</li>
    <li id="user" class="li treeview">
        <a href="#"><span>Usuarios</span><span class="fa fa-users pull-right"></span></a>
        <ul class="treeview-menu">
            <li id="userCreate"><a href="{{route('user.create')}}">Nuevo Usuario <span class="fa fa-plus pull-right"></span></a></li>
            <li id="userList"><a href="{{route('user.index')}}">Lista de usuarios <span class="fa fa-list-ul pull-right"></span></a></li>
            <li id="userTrashed"><a href="{{route('user.trashed')}}">Usuarios eliminados <span class="fa fa-recycle pull-right"></span></a></li>
        </ul>
    </li>
    <li class="header">Gestión</li>
    <li id="document" class="li treeview">
        <a href="#"><span>Documentos</span> <span class="fa fa-file-text pull-right"></span></a>
        <ul class="treeview-menu">
            <li id="documentCreate"><a href="{{route('document.create')}}">Nuevo Documento <span class="fa fa-plus pull-right"></span></a></li>
            <li id="documentList"><a href="{{route('document.index')}}">Lista de documentos <span class="fa fa-list-ul pull-right"></span></a></li>
        </ul>
    </li>
    <li id="author" class="li treeview">
        <a href="#"><span>Autores</span> <span class="fa fa-file-text pull-right"></span></a>
        <ul class="treeview-menu">
            <li id="authorCreate"><a href="{{route('author.create')}}">Nuevo autor <span class="fa fa-plus pull-right"></span></a></li>
            <li id="authorList"><a href="{{route('author.index')}}">Lista de autores <span class="fa fa-list-ul pull-right"></span></a></li>
        </ul>
    </li>
    <li id="topic" class="li treeview">
        <a href="#"><span>Temas de investigación</span> <span class="fa fa-book pull-right"></span></a>
        <ul class="treeview-menu">
            <li id="topicCreate"><a href="{{route('research_topic.create')}}">Nuevo tema <span class="fa fa-plus pull-right"></span></a></li>
            <li id="topicList"><a href="{{route('research_topic.index')}}">Lista de temas <span class="fa fa-list-ul pull-right"></span></a></li>
        </ul>
    </li>
    <li id="subtopic" class="li treeview">
        <a href="#"><span>Subtemas de investigación</span> <span class="fa fa-bookmark pull-right"></span></a>
        <ul class="treeview-menu">
            <li id="subtopicCreate"><a href="{{route('subtopic.create')}}">Nuevo Subtema <span class="fa fa-plus pull-right"></span></a></li>
            <li id="subtopicList"><a href="{{route('subtopic.index')}}">Lista de subtemas <span class="fa fa-list-ul pull-right"></span></a></li>
        </ul>
    </li>
    <li id="document_type" class="li treeview">
        <a href="#"><span>Tipos de documentos</span> <span class="fa fa-tags pull-right"></span></a>
        <ul class="treeview-menu">
            <li id="typeCreate"><a href="{{route('document_type.create')}}">Nuevo tipo de documento<span class="fa fa-plus pull-right"></span></a></li>
            <li id="typeList"><a href="{{route('document_type.index')}}">Lista de tipos <span class="fa fa-list-ul pull-right"></span></a></li>
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
    <li id="petition" class="li treeview">
        <a href="#"><span>Solicitudes</span> <span class="fa fa-book pull-right"></span></a>
        <ul class="treeview-menu">
            <li id="petitionList"><a href="{{route('petition.index')}}">Lista de solicitudes <span class="fa fa-list-ul pull-right"></span></a></li>
        </ul>
    </li>

@endsection
