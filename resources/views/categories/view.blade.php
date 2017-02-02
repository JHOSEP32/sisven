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
                <a href="/category"><i class="fa fa-tags"></i> Categorías</a>
            </li>
            <li class="active"><i class="fa fa-eye"></i> Ver</li>
            <li class="active"><i class="fa fa-tag"></i> {{ $category->name }}</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12 col-lg-6 col-md-6">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">Categoría #{{ $category->id }}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="button-container">
                            <a href="/category/{{ $category->id }}/edit" class="btn btn-primary">
                                <span class="fa fa-pencil"></span> Editar
                            </a>
                            <form class="display_inline_block" action="{{ route('category.destroy', $category->id) }}"
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
                                    <td>{{ $category->id }}</td>
                                </tr>
                                <tr>
                                    <td>Nombre</td>
                                    <td>{{ $category->name }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="/category" class="btn btn-default">
                            <span class="fa fa-chevron-circle-left"></span> Volver a 'Categorías'
                        </a>
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@endsection