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
            <li class="active"><i class="fa fa-eye"></i> Ver</li>
            <li class="active"><i class="fa fa-cube"></i> {{ $product->name }}</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12 col-lg-6 col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Producto #{{ $product->id }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="button-container">
                            <a href="/product/{{ $product->id }}/edit" class="btn btn-primary">
                                <span class="fa fa-pencil"></span> Editar
                            </a>
                            <form class="display_inline_block" action="{{ route('product.destroy', $product->id) }}"
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
                                    <td>{{ $product->id }}</td>
                                </tr>
                                <tr>
                                    <td>Nombre</td>
                                    <td>{{ $product->name }}</td>
                                </tr>
                                <tr>
                                    <td>Categoríia</td>
                                    <td>{{ $product->cname }}</td>
                                </tr>
                                <tr>
                                    <td>Proveedor</td>
                                    <td>{{ $product->pvname }}</td>
                                </tr>
                                <tr>
                                    <td>Descripción</td>
                                    <td>{{ $product->description }}</td>
                                </tr>
                                <tr>
                                    <td>Precio</td>
                                    <td>${{ $product->price }}.00</td>
                                </tr>
                                <tr>
                                    <td>Stock</td>
                                    <td>{{ $product->stock }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="/product" class="btn btn-default">
                            <span class="fa fa-chevron-circle-left"></span> Volver a 'Productos'
                        </a>
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@endsection