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
            <li class="active"><i class="fa fa-plus-circle"></i> Añadir</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12 col-lg-6 col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Añadir Cliente</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('client.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group {{ $errors->has('identificacion') ? ' has-error' : '' }}">
                                <label for="identificacion">Identificación:</label>
                                <input type="text" class="form-control" id="identificacion"
                                       placeholder="Identificación" name="identificacion" value="{{ old('identificacion') }}">
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
                            <div class="form-group {{ $errors->has('direccion') ? ' has-error' : '' }}">
                                <label for="direccion">Dirección:</label>
                                <input type="text" class="form-control" id="direccion"
                                       placeholder="Dirección" name="direccion" value="{{ old('direccion') }}">
                                <span class="help-block">{{ $errors->first('direccion') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('celular') ? ' has-error' : '' }}">
                                <label for="celular">Celular:</label>
                                <input type="text" class="form-control" id="celular"
                                       placeholder="Celular" name="celular" value="{{ old('celular') }}">
                                <span class="help-block">{{ $errors->first('celular') }}</span>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary"><span class="fa fa-plus-circle"></span> Añadir
                            </button>
                            <a href="/category" class="btn btn-danger"><span class="fa fa-ban"></span> Cancelar</a>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@endsection