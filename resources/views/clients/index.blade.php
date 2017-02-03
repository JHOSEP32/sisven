@extends('layouts.app')
@section('content')
    <section class="content-header">
        <h1>
            Clientes
            {{--<small>Descripcion</small>--}}
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active"><i class="fa fa-users"></i> Clientes</li>
        </ol>
        <div class="alert-container">
            @if (session()->has('msj'))
                <div class="alert-box success" role="alert">
                    <span class="fa fa-check-circle"></span>
                    {{ session('msj') }}
                </div>
            @elseif (session()->has('errorMsj'))
                <div class="alert-box error" role="alert">
                    <span class="fa fa-ban"></span>
                    {{ session('errorMsj') }}
                </div>
            @endif
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <!-- Your Page Content Here -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Lista de Clientes</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="button-container">
                            <a href="/client/create" class="btn btn-primary"><span class="fa fa-plus-circle"></span>
                                Añadir</a>
                        </div>
                        @if (isset($clients) && $clients->count() > 0)
                            <table class="dtable table table-bordered table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Identificacion</th>
                                    <th>Nombre</th>
                                    <th>Dirección</th>
                                    <th>Celular</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($clients as $cli)
                                    <tr>
                                        <td>{{ $cli->id }}</td>
                                        <td>{{ $cli->dni == NULL ? '---' : $cli->dni }}</td>
                                        <td>{{ $cli->name . ' ' . $cli->lastname }}</td>
                                        <td>{{ $cli->address == NULL ? '---' : $cli->address }}</td>
                                        <td>{{ $cli->phone == NULL ? '---' : $cli->phone }}</td>
                                        <td>
                                            <a href="/client/{{ $cli->id }}" class="btn btn-xs btn-default"
                                               data-toggle="tooltip" data-placement="top" title="Ver">
                                                <span class="fa fa-eye"></span>
                                            </a>
                                            <a href="/client/{{ $cli->id }}/edit" class="btn btn-xs btn-primary"
                                               data-toggle="tooltip" data-placement="top" title="Editar">
                                                <span class="fa fa-pencil"></span>
                                            </a>
                                            <form class="display_inline_block"
                                                  action="{{ route('client.destroy', $cli->id) }}"
                                                  method="POST">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-xs tb-delete"
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="Eliminar">
                                                    <span class="fa fa-trash-o"></span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            No se encontraron registros.
                        @endif
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@endsection