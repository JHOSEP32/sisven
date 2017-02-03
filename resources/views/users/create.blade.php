@extends('layouts.app')
@section('content')
    <section class="content-header">
        <h1>
            Usuarios
            {{--<small>Descripcion</small>--}}
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="/"><i class="fa fa-home"></i> Inicio</a>
            </li>
            <li>
                <a href="/category"><i class="fa fa-users"></i> Usuarios</a>
            </li>
            <li class="active"><i class="fa fa-plus-circle"></i> Añadir</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12 col-lg-6 col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Añadir Usuario</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form id="create-user-form" role="form" action="{{ route('user.store') }}" method="post"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group {{ $errors->has('identificacion') ? ' has-error' : '' }}">
                                <label for="identificacion">Identificación:</label>
                                <input type="text" class="form-control" id="identificacion"
                                       placeholder="Identificación" name="identificacion"
                                       value="{{ old('identificacion') }}">
                                <span class="help-block">{{ $errors->first('identificacion') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('nombre') ? ' has-error' : '' }}">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" id="nombre"
                                       placeholder="Nombre" name="nombre" value="{{ old('nombre') }}">
                                <span class="help-block">{{ $errors->first('nombre') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('apellidos') ? ' has-error' : '' }}">
                                <label for="apellidos">Apellidos:</label>
                                <input type="text" class="form-control" id="apellidos"
                                       placeholder="Apellidos" name="apellidos" value="{{ old('apellidos') }}">
                                <span class="help-block">{{ $errors->first('apellidos') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('celular') ? ' has-error' : '' }}">
                                <label for="celular">Celular:</label>
                                <input type="tel" class="form-control" id="celular"
                                       placeholder="Celular" name="celular" value="{{ old('celular') }}">
                                <span class="help-block">{{ $errors->first('celular') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email"
                                       placeholder="Email" name="email" value="{{ old('email') }}">
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('contrasena') ? ' has-error' : '' }}">
                                <label for="contrasena">Contraseña:</label>
                                <input type="password" class="form-control" id="contrasena"
                                       placeholder="Contraseña" name="contrasena" value="{{ old('contrasena') }}">
                                <span class="help-block">{{ $errors->first('contrasena') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('contrasena_confirmation') ? ' has-error' : '' }}">
                                <label for="contrasena_confirmation">Confirmar Contraseña:</label>
                                <input type="password" class="form-control" id="contrasena_confirmation"
                                       placeholder="Confirmar Contraseña" name="contrasena_confirmation"
                                       value="{{ old('contrasena_confirmation') }}">
                                <span class="help-block">{{ $errors->first('contrasena_confirmation') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('estado') ? ' has-error' : '' }}">
                                <label for="estado">Estado:</label>
                                <select id="estado" name="estado" class="form-control">
                                    <option value="">Seleccione</option>
                                    <option value="Admin" {{ old('estado') == 'Admin' ? 'selected' : '' }}>
                                        Administrador
                                    </option>
                                    <option value="Estandar" {{ old('estado') == 'Estandar' ? 'selected' : '' }}>
                                        Estándar
                                    </option>
                                </select>
                                <span class="help-block">{{ $errors->first('estado') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="imagen">Imagen:</label>
                                <input id="imagen" name="imagen" type="file">
                            </div>
                            <div class="form-group">
                                <label>Vista previa:</label>
                                <img src="/img/user_profile.png" alt=""
                                     class="preview-img img-responsive img-circle img-bordered">
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary"><span class="fa fa-plus-circle"></span> Añadir
                            </button>
                            <a href="/user" class="btn btn-danger"><span class="fa fa-ban"></span> Cancelar</a>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@endsection