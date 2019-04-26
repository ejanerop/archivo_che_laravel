@extends('layouts.app')

@section('content')

    <section class="content-header">
        <div class="container">
            <h3>Usuarios</h3>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><span class="glyphicon glyphicon-ok"></span></h4>
                        <strong>{{ session('success') }}</strong>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4></h4>
                        <strong>{{ session('error') }}</strong>
                    </div>
                @endif
                <div class="box box-primary">
                    <div class="box-header">
                        <a href="{{route('user.create')}}" class="btn btn-flat btn-success pull-right"><span class="glyphicon glyphicon-plus"></span>Nuevo</a>
                    </div>
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