@extends('layouts.app')
@section('content')
    <section class="content-header">
        <h1>
            Ventas
            {{--<small>Descripcion</small>--}}
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="/"><i class="fa fa-home"></i> Inicio</a>
            </li>
            <li>
                <a href="/sale"><i class="fa fa-shopping-cart"></i> Ventas</a>
            </li>
            <li class="active"><i class="fa fa-plus-circle"></i> Añadir</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Añadir Venta</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('category.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="col-md-8">
                                <div class="box box-default">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Detalles del producto</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="col-md-9">
                                            <div class="form-group {{ $errors->has('producto') ? ' has-error' : '' }}">
                                                <label for="producto">Producto:</label>
                                                <select id="producto" name="producto"
                                                        class="form-control input-sm products-data-select"
                                                        style="width: 100%;">
                                                    <option value="">Seleccione el producto</option>
                                                    @foreach($products as $prod)
                                                        <option value="{{ $prod->id }}" {{ $prod->id == old('producto') ? 'selected' : '' }}>{{ $prod->name }}</option>
                                                    @endforeach
                                                </select>
                                                <span class="help-block">{{ $errors->first('producto') }}</span>
                                            </div>
                                            <input id="prod_nombre" name="prod_nombre" type="hidden">
                                            <div class="form-group">
                                                <label for="prod_descripcion">Descripción:</label>
                                                <textarea type="text" class="form-control input-sm"
                                                          id="prod_descripcion"
                                                          placeholder="Nombre" name="prod_descripcion" rows="2"
                                                          disabled></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="prod_precio">Precio:</label>
                                                <input type="text" class="form-control input-sm" id="prod_precio"
                                                       placeholder="Precio" name="prod_precio" value="" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label for="prod_stock">Stock:</label>
                                                <input type="text" class="form-control input-sm" id="prod_stock"
                                                       placeholder="Stock" name="prod_stock" value="" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button id="addProductBtn" type="button" class="btn btn-primary pull-right"><span
                                                    class="fa fa-plus-circle"></span> Añadir
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="box box-default">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Lista</h3>
                                    </div>
                                    <div class="box-body table-responsive no-padding">
                                        <div class="col-md-12">
                                            <table id="products-list" class="table table-hover table-striped table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Cant.</th>
                                                    <th>Nombre</th>
                                                    <th>Precio</th>
                                                    <th>Total</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="box-footer">
                                        <button type="button" class="btn btn-sm btn-primary"><span class="fa fa-trash"></span> Limpiar</button>
                                    </div>
                                </div>
                            </div>
                            {{--<div class="box box-default">--}}
                            {{--<div class="box-header with-border">--}}
                            {{--<h3 class="box-title">Cliente</h3>--}}
                            {{--</div>--}}
                            {{--<div class="box-body">--}}
                            {{--<div class="form-group {{ $errors->has('nombre') ? ' has-error' : '' }}">--}}
                            {{--<label for="nombre">Nombre:</label>--}}
                            {{--<input type="text" class="form-control" id="nombre"--}}
                            {{--placeholder="Nombre" name="nombre" value="{{ old('nombre') }}">--}}
                            {{--<span class="help-block">{{ $errors->first('nombre') }}</span>--}}
                            {{--</div>--}}
                            {{--<div class="form-group {{ $errors->has('cliente') ? ' has-error' : '' }}">--}}
                            {{--<label for="cliente">Proveedor:</label>--}}
                            {{--<select id="cliente" name="cliente" class="form-control clients-data-select"--}}
                            {{--style="width: 100%;">--}}
                            {{--<option value="">Seleccione el cliente</option>--}}
                            {{--@foreach($clients as $cli)--}}
                            {{--<option value="{{ $cli->id }}" {{ $cli->id == old('cliente') ? 'selected' : '' }}>{{ $cli->name . ' ' . $cli->lastname }}</option>--}}
                            {{--@endforeach--}}
                            {{--</select>--}}
                            {{--<span class="help-block">{{ $errors->first('cliente') }}</span>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
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