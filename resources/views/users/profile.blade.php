@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Perfil
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active"><i class="fa fa-user-circle"></i> Perfil</li>
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
            <div class="col-md-8">

                <div class="box box-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-primary">
                        <h3 class="widget-user-username">{{ $user->name . ' ' . $user->lastname }}</h3>
                        <h5 class="widget-user-desc"><span class="label bg-green">{{ $user->state }}</span></h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle" src="{{ $user->img_url }}" alt="User Avatar">
                    </div>
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">3,200</h5>
                                    <span class="description-text">SALES</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">13,000</h5>
                                    <span class="description-text">FOLLOWERS</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">35</h5>
                                    <span class="description-text">PRODUCTS</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.widget-user -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#info" data-toggle="tab">Información</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="info">
                            <p>Información Personal</p>
                            <table class="table table-bordered table-striped table-hover">
                                <tbody>
                                <tr>
                                    <td>Identificación</td>
                                    <td>{{ $user->dni }}</td>
                                </tr>
                                <tr>
                                    <td>Nombre</td>
                                    <td>{{ $user->name . ' ' . $user->lastname }}</td>
                                </tr>
                                <tr>
                                    <td>Celular</td>
                                    <td><a href="callto:{{ $user->phone }}">{{ $user->phone }}</a></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                                </tr>
                                <tr>
                                    <td>Estado</td>
                                    <td><span class="label bg-green">{{ $user->state }}</span></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Cambiar foto de perfil</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.box-tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <img src="{{ $user->img_url }}" alt=""
                                     class="img-circle img-bordered img-responsive preview-img center-block">
                                <form id="update-photo-form" action="{{ route('profile.updatePhoto', $user->id) }}"
                                      method="post" enctype="multipart/form-data">
                                    {{ method_field('PUT') }}
                                    {{ csrf_field() }}
                                    <input id="userImg" type="text" value="{{ $user->img_url }}" hidden>
                                    <div class="form-group {{ $errors->has('imagen') ? ' has-error' : '' }}">
                                        <label for="imagen">Imagen:</label>
                                        <input id="imagen" name="imagen" type="file">
                                        <span class="help-block">{{ $errors->first('imagen') }}</span>
                                    </div>
                                    <button type="submit" class="btn btn-primary"><span
                                                class="fa fa-save"></span> Guardar
                                    </button>
                                </form>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Cambiar contraseña</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                class="fa fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.box-tools -->
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <form action="{{ route('profile.updatePassword', $user->id) }}" method="post">
                                    {{ method_field('PUT') }}
                                    {{ csrf_field() }}
                                    <div class="form-group {{ $errors->has('contrasena_actual') ? ' has-error' : '' }}">
                                        <label for="contrasena_actual">Contraseña actual:</label>
                                        <input type="password" class="form-control" id="contrasena_actual"
                                               placeholder="Contraseña actual" name="contrasena_actual"
                                               value="{{ old('contrasena_actual') }}">
                                        <span class="help-block">{{ $errors->first('contrasena_actual') }}</span>
                                    </div>
                                    <div class="form-group {{ $errors->has('contrasena') ? ' has-error' : '' }}">
                                        <label for="contrasena">Contraseña nueva:</label>
                                        <input type="password" class="form-control" id="contrasena"
                                               placeholder="Contraseña nueva" name="contrasena"
                                               value="{{ old('contrasena') }}">
                                        <span class="help-block">{{ $errors->first('contrasena') }}</span>
                                    </div>
                                    <div class="form-group {{ $errors->has('contrasena_confirmation') ? ' has-error' : '' }}">
                                        <label for="contrasena_confirmation">Confirmar Contraseña:</label>
                                        <input type="password" class="form-control" id="contrasena_confirmation"
                                               placeholder="Confirmar Contraseña" name="contrasena_confirmation"
                                               value="{{ old('contrasena_confirmation') }}">
                                        <span class="help-block">{{ $errors->first('contrasena_confirmation') }}</span>
                                    </div>
                                    <button type="submit" class="btn btn-primary"><span
                                                class="fa fa-save"></span> Guardar
                                    </button>
                                </form>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Actualizar datos personales</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>
                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form class="" method="post"
                              action="{{ route('profile.update', $user->id) }}">
                            {{ method_field('PUT') }}
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="identificacion"
                                       class="control-label">Identificación</label>
                                <input type="text" class="form-control" id="identificacion"
                                       name="identificacion"
                                       placeholder="Identificación"
                                       value="{{ old('identificacion', $user->dni) }}" disabled>
                                <span class="help-block">{{ $errors->first('identificacion') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="nombre" class="control-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre"
                                       placeholder="Nombre"
                                       value="{{ old('nombre', $user->name) }}" required>
                                <span class="help-block">{{ $errors->first('nombre') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="apellidos" class="control-label">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos"
                                       placeholder="Apellidos"
                                       value="{{ old('apellidos', $user->lastname) }}" required>
                                <span class="help-block">{{ $errors->first('apellidos') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="celular" class="control-label">Celular</label>
                                <input type="tel" class="form-control" id="celular" name="celular"
                                       placeholder="Celular"
                                       value="{{ old('celular', $user->phone) }}" required>
                                <span class="help-block">{{ $errors->first('celular') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="email" class="control-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                       placeholder="Email"
                                       value="{{ old('email', $user->email) }}" disabled>
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    <span class="fa fa-save"></span> Guardar
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
@endsection