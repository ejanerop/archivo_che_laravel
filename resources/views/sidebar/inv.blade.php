@section('sidebar_items')

    <li class="header">Gestión</li>
    <li id="document" class="li treeview">
        <a href="#"><span>Documentos</span> <span class="fa fa-file-text pull-right"></span></a>
        <ul class="treeview-menu">
            <li id="documentList"><a href="{{route('document.index')}}">Lista de documentos <span class="fa fa-list-ul pull-right"></span></a></li>
        </ul>
    </li>
    <li id="petition" class="li treeview">
        <a href="#"><span>Solicitudes</span> <span class="fa fa-book pull-right"></span></a>
        <ul class="treeview-menu">
            <li id="petitionCreate"><a href="{{route('petition.create')}}">Realizar solicitud <span class="fa fa-send pull-right"></span></a></li>
            <li id="petitionOwn"><a href="{{route('petition.myPetitions')}}">Mis solicitudes <span class="fa fa-user pull-right"></span></a></li>
        </ul>
    </li>

@endsection
