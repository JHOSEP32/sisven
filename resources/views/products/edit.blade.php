@extends('layouts.app')
@section('content')
    <section class="content-header">
        <h1>
            Productos
            {{--<small>Descripcion</small>--}}
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="/"><i class="fa fa-home"></i> Inicio</a>
            </li>
            <li>
                <a href="/product"><i class="fa fa-cubes"></i> Productos</a>
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
                        <h3 class="box-title">Editar Producto</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('product.update', $product->id) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="box-body">
                            <div class="form-group {{ $errors->has('nombre') ? ' has-error' : '' }}">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" id="nombre"
                                       placeholder="Nombre" name="nombre" value="{{ old('nombre', $product->name) }}">
                                <span class="help-block">{{ $errors->first('nombre') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('categoria') ? ' has-error' : '' }}">
                                <label for="categoria">Categoría:</label>
                                <select id="categoria" name="categoria" class="form-control data-select"
                                        style="width: 100%;">
                                    <option value="">Seleccione la categoría</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ $cat->id == $product->cid ? 'selected' : '' }}>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">{{ $errors->first('categoria') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('proveedor') ? ' has-error' : '' }}">
                                <label for="proveedor">Proveedor:</label>
                                <select id="proveedor" name="proveedor" class="form-control data-select"
                                        style="width: 100%;">
                                    <option value="">Seleccione el proveedor</option>
                                    @foreach($providers as $prov)
                                        <option value="{{ $prov->id }}" {{ $prov->id == $product->pvid ? 'selected' : '' }}>{{ $prov->name }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block">{{ $errors->first('proveedor') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('descripcion') ? ' has-error' : '' }}">
                                <label for="descripcion">Descripción:</label>
                                <textarea name="descripcion" id="descripcion" class="form-control" cols="30"
                                          rows="5"
                                          placeholder="Descripción del producto">{{ old('descripcion', $product->description) }}</textarea>
                                <span class="help-block">{{ $errors->first('descripcion') }}</span>
                            </div>
                            <div class="form-group {{ $errors->has('precio') ? ' has-error' : '' }}">
                                <label for="precio">Precio:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">$</span>
                                    <input type="text" class="form-control" id="precio"
                                           placeholder="Precio" name="precio" value="{{ old('precio', $product->price) }}">
                                    <span class="input-group-addon">.00</span>
                                </div>
                                <span class="help-block">{{ $errors->first('precio') }}</span>
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span> Guardar
                            </button>
                            <a href="/product" class="btn btn-danger"><span class="fa fa-ban"></span> Cancelar</a>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@endsection