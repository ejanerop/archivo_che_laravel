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
                        <span id="toggle" class="glyphicon glyphicon-chevron-left" style="color: #ffffff"></span>
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
                                    <div class="pull-left"></div>
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
                    </ul>
                </div>

        </nav>

        </header>

            <script id="toggler">
                function toggleToggler() {
                    if( $('span#toggle').hasClass('glyphicon-chevron-left')){
                        $('span#toggle').removeClass('glyphicon-chevron-left').addClass('glyphicon-chevron-right');
                    }else {
                        $('span#toggle').removeClass('glyphicon-chevron-right').addClass('glyphicon-chevron-left');
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
                    <li id="start" class="li active"><a href="/home"><span>Inicio</span> <span class="glyphicon glyphicon-home pull-right"></span></a></li>
                    <li class="header"> Gestión</li>
                    <li id="user" class="li treeview">
                        <a href="#"><span>Usuarios</span><span class="glyphicon glyphicon-user pull-right"></span></a>
                        <ul class="treeview-menu">
                            <li id="userCreate"><a href="/user/create">Nuevo Usuario <span class="glyphicon glyphicon-plus pull-right"></span></a></li>
                            <li id="userList"><a href="/user">Lista de usuarios <span class="glyphicon glyphicon-list pull-right"></span></a></li>
                        </ul>
                    </li>
                    <li id="document" class="li treeview">
                        <a href="#"><span>Documentos</span> <span class="glyphicon glyphicon-file pull-right"></span></a>
                        <ul class="treeview-menu">
                            <li id="documentCreate"><a href="/document/create">Nuevo Documento <span class="glyphicon glyphicon-plus pull-right"></span></a></li>
                            <li id="documentList"><a href="/document">Lista de documentos <span class="glyphicon glyphicon-list pull-right"></span></a></li>
                        </ul>
                    </li>
                    <li id="topic" class="li treeview">
                        <a href="#"><span>Temas de investigación</span> <span class="glyphicon glyphicon-book pull-right"></span></a>
                        <ul class="treeview-menu">
                            <li id="topicCreate"><a href="/research_topic/create">Nuevo tema <span class="glyphicon glyphicon-plus pull-right"></span></a></li>
                            <li id="topicList"><a href="/research_topic">Lista de temas <span class="glyphicon glyphicon-list pull-right"></span></a></li>
                        </ul>
                    </li>
                    <li id="subtopic" class="li treeview">
                        <a href="#"><span>Subtemas de investigación</span> <span class="glyphicon glyphicon-bookmark pull-right"></span></a>
                        <ul class="treeview-menu">
                            <li id="subtopicCreate"><a href="/subtopic/create">Nuevo Subtema <span class="glyphicon glyphicon-plus pull-right"></span></a></li>
                            <li id="subtopicList"><a href="/subtopic">Lista de subtemas <span class="glyphicon glyphicon-list pull-right"></span></a></li>
                        </ul>
                    </li>
                    <li id="document_type" class="li treeview">
                        <a href="#"><span>Tipos de documentos</span> <span class="glyphicon glyphicon-list-alt pull-right"></span></a>
                        <ul class="treeview-menu">
                            <li id="typeCreate"><a href="/document_type/create">Nuevo tipo de documento<span class="glyphicon glyphicon-plus pull-right"></span></a></li>
                            <li id="typeList"><a href="/document_type">Lista de tipos <span class="glyphicon glyphicon-list pull-right"></span></a></li>
                        </ul>
                    </li>
                </ul><!-- /.sidebar-menu -->

            </section><!-- /.sidebar -->
        </aside>

        @endsection

