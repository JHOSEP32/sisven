@extends('layouts.app')
@section('content')
    <section class="content-header">
        <h1>
            Proveedores
            {{--<small>Descripcion</small>--}}
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="/"><i class="fa fa-home"></i> Inicio</a>
            </li>
            <li>
                <a href="/category"><i class="fa fa-truck"></i> Proveedores</a>
            </li>
            <li class="active"><i class="fa fa-eye"></i> Ver</li>
            <li class="active"><i class="fa fa-tag"></i> {{ $provider->name }}</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12 col-lg-6 col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Proveedor #{{ $provider->id }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="button-container">
                            <a href="/provider/{{ $provider->id }}/edit" class="btn btn-primary">
                                <span class="fa fa-pencil"></span> Editar
                            </a>
                            <form class="display_inline_block" action="{{ route('provider.destroy', $provider->id) }}"
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
                                    <td>{{ $provider->id }}</td>
                                </tr>
                                <tr>
                                    <td>Nombre</td>
                                    <td>{{ $provider->name }}</td>
                                </tr>
                                <tr>
                                    <td>Descripción</td>
                                    <td>{{ $provider->description }}</td>
                                </tr>
                                <tr>
                                    <td>Teléfono</td>
                                    <td>{{ $provider->telephone == NULL ? '---' : $provider->telephone }}</td>
                                </tr>
                                <tr>
                                    <td>Celular</td>
                                    <td>{{ $provider->cellphone == NULL ? '---' : $provider->cellphone }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{ $provider->email == NULL ? '---' : $provider->email }}</td>
                                </tr>
                                <tr>
                                    <td>Dirección</td>
                                    <td>{{ $provider->address == NULL ? '---' : $provider->address }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="/provider" class="btn btn-default">
                            <span class="fa fa-chevron-circle-left"></span> Volver a 'Proveedores'
                        </a>
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@endsection