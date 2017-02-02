@extends('layouts.app')
@section('content')
    <section class="content-header">
        <h1>
            Categorías
            {{--<small>Descripcion</small>--}}
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="/"><i class="fa fa-home"></i> Inicio</a>
            </li>
            <li>
                <a href="/user"><i class="fa fa-users"></i> Usuarios</a>
            </li>
            <li class="active"><i class="fa fa-eye"></i> Ver</li>
            <li class="active"><i class="fa fa-user"></i> {{ $user->name }}</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12 col-lg-6 col-md-6">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Usuario #{{ $user->id }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="button-container">
                            <a href="/user/{{ $user->id }}/edit" class="btn btn-primary">
                                <span class="fa fa-pencil"></span> Editar
                            </a>
                            <form class="display_inline_block" action="{{ route('user.destroy', $user->id) }}"
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
                                    <td>{{ $user->id }}</td>
                                </tr>
                                <tr>
                                    <td>Identificación</td>
                                    <td>{{ $user->dni }}</td>
                                </tr>
                                <tr>
                                    <td>Nombre</td>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <td>Apellidos</td>
                                    <td>{{ $user->lastname }}</td>
                                </tr>
                                <tr>
                                    <td>Celular</td>
                                    <td>{{ $user->phone }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td>Estado</td>
                                    <td><span class="label bg-green">{{ $user->state }}</span></td>
                                </tr>
                                <tr>
                                    <td>Imagen</td>
                                    <td><img src="{{ $user->img_url }}" alt="" class="img-circle img-responsive preview-img"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="/user" class="btn btn-default">
                            <span class="fa fa-chevron-circle-left"></span> Volver a 'Usuarios'
                        </a>
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@endsection