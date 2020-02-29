@extends('layouts.template')

        @section('header')

            <header class="main-header">

        <a class="logo" href="{{ url('/') }}">
            <span class="logo-mini">CHE</span>
            <span class="logo-lg">{{ config('app.name', 'Laravel') }}</span>
        </a>

        <nav class="navbar navbar-static-top" role="navigation" style="max-height: 50px">

                <!-- Sidebar toggle button-->
            <ul class="nav navbar-nav pull-left">
                <li>
                    <a href="#" data-toggle="offcanvas" role="button" onclick="toggleToggler()">
                        <span id="toggle" class="fa fa-chevron-left" style="color: #ffffff"></span>
                    </a>
                </li>
            </ul>

            <div class="navbar-custom-menu">

                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            @guest
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Inicio de sesión
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a>
                            @if (Route::has('register'))
                                <a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                            </div>

                        @else


                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->username }}  <span class="caret"></span>
                            </a>


                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li class="user-header">
                                    <img src="/user.png" class="img-circle" alt="User Image">
                                    <p>
                                        {{Auth::user()->username}}
                                        <small>{{\App\User::where('username', Auth::user()->username)->first()->roles->name}}</small>
                                    </p>
                                </li>
                                <li class="user-body"></li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a class="btn btn-default btn-flat" href="{{route('user.profile',Auth::user()->id)}}">
                                            {{ __('Pefil') }}
                                        </a>
                                    </div>
                                    <div class="pull-right">
                                        <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            {{ __('Cerrar sesión') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        @endguest
                        </li>
                        <li>
                            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                        </li>
                    </ul>
                </div>

        </nav>

        </header>

            <script id="toggler">
                function toggleToggler() {
                    if( $('span#toggle').hasClass('fa-chevron-left')){
                        $('span#toggle').removeClass('fa-chevron-left').addClass('fa-chevron-right');
                    }else {
                        $('span#toggle').removeClass('fa-chevron-right').addClass('fa-chevron-left');
                    }
                }
            </script>

        @endsection

        @section('sidebar')

            <aside class="main-sidebar">
            <!-- Inner sidebar -->
            <section class="sidebar">
                <!-- Sidebar Menu -->
                <ul class="sidebar-menu">
                    <li id="start" class="li active"><a href="{{route('home')}}"><span>Inicio</span><span class="fa fa-home pull-right"></span></a></li>
                    @if(\Illuminate\Support\Facades\Auth::user()->hasRole('admin'))
                    <li class="header">Administración</li>
                    <li id="user" class="li treeview">
                        <a href="#"><span>Usuarios</span><span class="fa fa-users pull-right"></span></a>
                        <ul class="treeview-menu">
                            <li id="userCreate"><a href="{{route('user.create')}}">Nuevo Usuario <span class="fa fa-plus pull-right"></span></a></li>
                            <li id="userList"><a href="{{route('user.index')}}">Lista de usuarios <span class="fa fa-list-ul pull-right"></span></a></li>
                        </ul>
                    </li>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->hasRole('manager'))
                    <li class="header">Gestión</li>
                    <li id="document" class="li treeview">
                        <a href="#"><span>Documentos</span> <span class="fa fa-file-text pull-right"></span></a>
                        <ul class="treeview-menu">
                            <li id="documentCreate"><a href="{{route('document.create')}}">Nuevo Documento <span class="fa fa-plus pull-right"></span></a></li>
                            <li id="documentList"><a href="{{route('document.index')}}">Lista de documentos <span class="fa fa-list-ul pull-right"></span></a></li>
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
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->hasRole('director'))

                    @endif

                </ul><!-- /.sidebar-menu -->

            </section><!-- /.sidebar -->
        </aside>

        @endsection

