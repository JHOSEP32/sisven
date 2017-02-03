@extends('layouts.app')
@section('content')
    <section class="content-header">
        <h1>
            Clientes
            {{--<small>Descripcion</small>--}}
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="/"><i class="fa fa-home"></i> Inicio</a>
            </li>
            <li>
                <a href="/category"><i class="fa fa-users"></i> Clientes</a>
            </li>
            <li class="active"><i class="fa fa-eye"></i> Ver</li>
            <li class="active"><i class="fa fa-tag"></i> {{ $client->name }}</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12 col-lg-6 col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Cliente #{{ $client->id }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="button-container">
                            <a href="/client/{{ $client->id }}/edit" class="btn btn-primary">
                                <span class="fa fa-pencil"></span> Editar
                            </a>
                            <form class="display_inline_block" action="{{ route('client.destroy', $client->id) }}"
                                  method="POST">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger tb-delete">
                                    <span class="fa fa-trash-o"></span> Eliminar
                                </button>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered">
                                <tbody>
                                <tr>
                                    <td>ID</td>
                                    <td>{{ $client->id }}</td>
                                </tr>
                                <tr>
                                    <td>Identificación</td>
                                    <td>{{ $client->dni == NULL ? '---' : $client->dni }}</td>
                                </tr>
                                <tr>
                                    <td>Nombre</td>
                                    <td>{{ $client->name }}</td>
                                </tr>
                                <tr>
                                    <td>Apellidos</td>
                                    <td>{{ $client->lastname }}</td>
                                </tr>
                                <tr>
                                    <td>Dirección</td>
                                    <td>{{ $client->address == NULL ? '---' : $client->address }}</td>
                                </tr>
                                <tr>
                                    <td>Celular</td>
                                    <td>{{ $client->phone == NULL ? '---' : $client->phone }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="/client" class="btn btn-default">
                            <span class="fa fa-chevron-circle-left"></span> Volver a 'Clientes'
                        </a>
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@endsection