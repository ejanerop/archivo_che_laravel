@extends('layouts.template')

@if (\Auth::user()->hasRole('manager'))
    @include('sidebar.manager')
@elseif (\Auth::user()->hasRole('director'))
    @include('sidebar.director')
@elseif (\Auth::user()->hasRole('inv.ext') || \Auth::user()->hasRole('inv.int'))
    @include('sidebar.inv')
@elseif (\Auth::user()->hasRole('guest'))
    @include('sidebar.guest')
@else
    @include('sidebar.coord')
@endif

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
                    <li id="start" class="li active"><a href="{{route('home')}}"><span>Inicio</span><span class="fa fa-home pull-right"></span></a></li>\

                    @yield('sidebar_items')

                </ul><!-- /.sidebar-menu -->

            </section><!-- /.sidebar -->
        </aside>

        @endsection

