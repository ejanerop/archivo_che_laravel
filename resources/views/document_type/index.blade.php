@extends('layouts.app')

@section('content')

    <section class="content-header">
        <div class="container"><h3>Tipos de documento</h3></div>
    </section>

    <section class="content">
        <div class="row">
            <div id="alert-div" class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><span class="fa fa-checked"></span></h4>
                        <strong>{{ session('success') }}</strong>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><span class="fa fa-ban"></span></h4>
                        <strong>{{ session('error') }}</strong>
                    </div>
                @endif
            </div>
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <a href="{{route('document_type.create')}}" class="btn btn-success pull-right"><span class="fa fa-plus"></span></a>
                    </div>
                    <div class="box-body">
                        <table id="table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tipo de documento</th>
                        <th>Tipo de recurso</th>
                        <th>Cantidad de documentos</th>
                        <th>Acciones</th>
                    </tr>
                 </thead>
            @foreach($document_types as $type)
                <tr>
                    <td>{{$type->document_type}}</td>
                    <td>{{$type->resource_type->resource_type}}</td>
                    <td>{{$type->documents_count}}</td>
                    <td>
                        <form action="{{route('document_type.destroy', ['document_type' =>  $type->id])}}" method="post">
                            @csrf
                            @method('DELETE')
                            <a href="{{route('document_type.edit', ['document_type' =>  $type->id])}}" class="btn btn-xs btn-info"><span class="fa fa-edit" style="margin-right: 2px"></span> Editar</a>
                            <button type="submit"  onclick="return confirm('Está seguro que desea eliminar el tipo de documento {{$type->document_type}}?')" class="btn btn-xs btn-danger"><span class="fa fa-remove" style="margin-right: 2px"></span> Eliminar</button>
                        </form>
                    </td>
                    </tr>
            @endforeach
        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(function () {
            $('#table').DataTable();
            $('li.li').removeClass('active');
            $('li#document_type').addClass('active');
            $('li#typeList').addClass('active');
        });
    </script>

@endsection
