@extends('layouts.app')

@section('content')

    <section class="content-header">
        <div class="container">
            <h1>Usuarios</h1>
        </div>
    </section>

    <section class="content">
        <div class="container">
            <table class="table table-bordered">
                <tr class="active">
                    <th>Usuario</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->username}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->roles->name}}</td>
                        <td>
                            <form action="/user/{{$user->id}}" method="post">
                                @csrf
                                @method('DELETE')
                                <a href="/user/{{$user->id}}/edit" class="btn btn-info">Modificar</a>
                                <button type="submit" class="btn btn-danger"> Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </section>

@endsection