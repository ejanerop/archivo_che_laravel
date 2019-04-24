@extends('layouts.template')

        @section('header')
        <script id="toggler">
                function toggleToggler() {
                    if( $('span#toggle').hasClass('glyphicon-backward')){
                        $('span#toggle').removeClass('glyphicon-backward').addClass('glyphicon-forward');
                    }else {
                        $('span#toggle').removeClass('glyphicon-forward').addClass('glyphicon-backward');
                    }
                }
            </script>

        <header class="main-header">

        <a class="logo" href="{{ url('/') }}">
            <span class="logo-mini">CHE</span>
            <span class="logo-lg">{{ config('app.name', 'Laravel') }}</span>
        </a>

        <nav class="navbar navbar-static-top" role="navigation" style="max-height: 50px">

                <!-- Sidebar toggle button-->
                <a href="#" data-toggle="offcanvas" role="button" onclick="toggleToggler()">
                    <span id="toggle" class="glyphicon glyphicon-backward" style="color: #ffffff"></span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">


                        @guest
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        @endguest
                        </li>
                    </ul>
                </div>

        </nav>

        </header>

        @endsection

        @section('sidebar')

        <aside class="main-sidebar">
        <!-- Inner sidebar -->
        <section class="sidebar">
            <!-- Sidebar Menu -->
            <ul class="sidebar-menu">
                <li class="active"><a href="/home"><span>Inicio</span> <span class="glyphicon glyphicon-home pull-right"></span></a></li>
                <li class="header"> Gestión</li>
                <li class="treeview">
                    <a href="#"><span>Usuarios</span><span class="glyphicon glyphicon-user pull-right"></span></a>
                    <ul class="treeview-menu">
                        <li><a href="/user/create">Nuevo Usuario</a></li>
                        <li><a href="/user">Lista de usuarios</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><span>Documentos</span> <span class="glyphicon glyphicon-file pull-right"></span></a>
                    <ul class="treeview-menu">
                        <li><a href="/document/create">Nuevo Documento</a></li>
                        <li><a href="/document">Lista de documentos</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><span>Temas de investigación</span> <span class="glyphicon glyphicon-book pull-right"></span></a>
                    <ul class="treeview-menu">
                        <li><a href="/research_topic/create">Nuevo tema de investigación</a></li>
                        <li><a href="/research_topic">Lista de temas</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><span>Subtemas de investigación</span> <span class="glyphicon glyphicon-bookmark pull-right"></span></a>
                    <ul class="treeview-menu">
                        <li><a href="/subtopic/create">Nuevo Subtema</a></li>
                        <li><a href="/subtopic">Lista de subtemas</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><span>Tipos de documentos</span> <span class="glyphicon glyphicon-th-list pull-right"></span></a>
                    <ul class="treeview-menu">
                        <li><a href="/document_type/create">Nuevo tipo de documento</a></li>
                        <li><a href="/document_type">Lista de tipos de documento</a></li>
                    </ul>
                </li>
            </ul><!-- /.sidebar-menu -->

        </section><!-- /.sidebar -->
    </aside>

        @endsection

