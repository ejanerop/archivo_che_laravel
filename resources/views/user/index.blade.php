@extends('layouts.app')

@section('content')

    <section class="content-header">
        <div class="container">
            <h1>Usuarios</h1>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header"></div>
                    <div class="box-body">
                        <table id="table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Usuario</th>
                                    <th>Correo</th>
                                    <th>Rol</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->username}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->roles->name}}</td>
                                    <td>
                                        <form action="/user/{{$user->id}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a href="/user/{{$user->id}}/edit" class="btn btn-info btn-flat">Modificar</a>
                                            <button type="submit" class="btn btn-danger btn-flat"> Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(function () {
            $('#table').DataTable();
        });
    </script>

@endsection