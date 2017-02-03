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
            <li class="active"><i class="fa fa-plus-circle"></i> Añadir</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12 col-lg-6 col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Añadir Categoría</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('category.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="box-body">
                            <div class="form-group {{ $errors->has('nombre') ? ' has-error' : '' }}">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" id="nombre"
                                       placeholder="Nombre" name="nombre" value="{{ old('nombre') }}">
                                <span class="help-block">{{ $errors->first('nombre') }}</span>
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