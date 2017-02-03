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
            <li class="active"><i class="fa fa-pencil"></i> Editar</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12 col-lg-6 col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Editar Proveedor</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('provider.update', $provider->id) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="box-body">
                            <div class="form-group {{ $errors->has('nombre') ? ' has-error' : '' }}">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" id="nombre"
                                       placeholder="Nombre" name="nombre" value="{{ old('nombre', $provider->name) }}">
                                <span class="help-block">{{ $errors->first('nombre') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('descripcion') ? ' has-error' : '' }}">
                                <label for="descripcion">Descripción:</label>
                                <textarea name="descripcion" id="descripcion" class="form-control" cols="30"
                                          rows="5"
                                          placeholder="Descripción del producto">{{ old('descripcion', $provider->description) }}</textarea>
                                <span class="help-block">{{ $errors->first('descripcion') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('telefono') ? ' has-error' : '' }}">
                                <label for="telefono">Teléfono:</label>
                                <input type="text" class="form-control" id="telefono"
                                       placeholder="Teléfono" name="telefono"
                                       value="{{ old('telefono', $provider->telephone) }}">
                                <span class="help-block">{{ $errors->first('telefono') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('celular') ? ' has-error' : '' }}">
                                <label for="celular">Celular:</label>
                                <input type="text" class="form-control" id="celular"
                                       placeholder="Celular" name="celular"
                                       value="{{ old('celular', $provider->cellphone) }}">
                                <span class="help-block">{{ $errors->first('celular') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email"
                                       placeholder="Email" name="email" value="{{ old('email', $provider->email) }}">
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('direccion') ? ' has-error' : '' }}">
                                <label for="direccion">Dirección:</label>
                                <input type="text" class="form-control" id="direccion"
                                       placeholder="Dirección" name="direccion"
                                       value="{{ old('direccion', $provider->address) }}">
                                <span class="help-block">{{ $errors->first('direccion') }}</span>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Guardar
                            </button>
                            <a href="/provider" class="btn btn-danger"><span class="fa fa-ban"></span> Cancelar</a>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@endsection