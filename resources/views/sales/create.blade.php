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
                    <div class="box-body">
                        <!-- form start -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="box box-default">
                                    <div class="box-header with-border">
                                        <h3 class="box-title">Detalles de la factura</h3>
                                    </div>
                                    <div class="box-body">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>ID</label>
                                                <p id="fac_id"></p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Fecha</label>
                                                <p>{{ date('Y-m-d') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <form role="form" onsubmit="return false">
                                    <div class="box box-default">
                                        <div class="box-header with-border">
                                            <h3 class="box-title">Detalles del Cliente</h3>
                                        </div>
                                        <div class="box-body">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="cliente">Cliente:</label>
                                                    <select id="cliente" name="cliente"
                                                            class="form-control input-sm clients-data-select"
                                                            style="width: 100%;" required>
                                                        <option value="">Seleccione el cliente</option>
                                                        @foreach($clients as $cli)
                                                            <option value="{{ $cli->id }}">{{ $cli->name . ' ' . $cli->lastname }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- form start -->
                        <form role="form" onsubmit="return false">
                            <div class="box box-default">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Detalles del producto</h3>
                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="producto">Producto:</label>
                                                <select id="producto" name="producto"
                                                        class="form-control input-sm products-data-select"
                                                        style="width: 100%;" required>
                                                    <option value="">Seleccione el producto</option>
                                                    @foreach($products as $prod)
                                                        <option value="{{ $prod->id }}" {{ $prod->id == old('producto') ? 'selected' : '' }}>{{ $prod->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="prod_descripcion">Descripción:</label>
                                                <textarea type="text" class="form-control input-sm"
                                                          id="prod_descripcion"
                                                          placeholder="Nombre" name="prod_descripcion" rows="1"
                                                          disabled></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="prod_precio">Precio:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon input-sm"><i class="fa fa-usd"></i></span>
                                                    <input type="text" class="form-control input-sm" id="prod_precio"
                                                           placeholder="Precio" name="prod_precio" value="" disabled>
                                                    <span class="input-group-addon input-sm">.00</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="prod_stock">Stock:</label>
                                                <input type="text" class="form-control input-sm" id="prod_stock"
                                                       placeholder="Stock" name="prod_stock" value="" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="prod_cant">Cantidad:</label>
                                                <input type="number" class="form-control input-sm" id="prod_cant"
                                                       name="prod_cant" min="1" value="1" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="prod_desc">Descuento:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon input-sm"><i class="fa fa-percent"></i></span>
                                                    <input type="number" class="form-control input-sm" id="prod_desc"
                                                           name="prod_desc" min="0" max="100" value="0" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <button id="addProductBtn" type="submit"
                                            class="btn btn-primary pull-right"><span
                                                class="fa fa-plus-circle"></span> Añadir
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="box box-default">
                            <div class="box-header with-border">
                                <h3 class="box-title">Lista</h3>
                            </div>
                            <div class="box-body table-responsive no-padding">
                                <div class="col-md-12">
                                    <table id="products-list"
                                           class="table table-hover table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nombre</th>
                                            <th>Precio</th>
                                            <th>Cant.</th>
                                            <th>%</th>
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
                                <button id="btn-clean-list" type="button" class="btn btn-sm btn-primary"><span
                                            class="fa fa-trash"></span> Limpiar
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary"><span class="fa fa-plus-circle"></span> Añadir
                        </button>
                        <a href="/category" class="btn btn-danger"><span class="fa fa-ban"></span> Cancelar</a>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        </div>
    </section>
@endsection