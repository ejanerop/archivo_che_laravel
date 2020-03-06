@extends('layouts.app')

@if (\Auth::user()->hasRole('manager'))
    @include('home.manager')
@elseif (\Auth::user()->hasRole('director'))
    @include('home.investigator')
@else
    @include('home.investigator')
@endif

@section('content')

    <section class="content-header">
        <h1></h1>
    </section>

    <section class="content">
        @yield('home')
    </section>
@endsection
