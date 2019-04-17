@extends('layouts.app')

@section('content')

    <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Inicio</a></li>
                <li class="breadcrumb-item"><a href="">Temas</a></li>
                <li class="breadcrumb-item"><a href="">Crear</a></li>
            </ol>
    </div>
    <div class="container">
        <table class="table table-bordered">
            <tr class="active">
                <th>Tema de investigación</th>
                <th>Descripción</th>
                <th>Cantidad de documentos</th>
                <th>Acciones</th>
            </tr>

                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>15</td>
                    <td> <button class="btn-outline-info">Modificar</button> <button class="btn-outline-danger">Eliminar</button> </td>
                </tr>

        </table>
    </div>

@endsection