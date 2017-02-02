@extends('layouts.app')
@section('content')
    <section class="content-header">
        <h1>
            Buzón de Mensajes
            {{--<small>Descripcion</small>--}}
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="/"><i class="fa fa-home"></i> Inicio</a>
            </li>
            <li>
                <a href="/mailbox"><i class="fa fa-envelope"></i> Buzón</a>
            </li>
            <li>
                <a href="/mailbox/drafts"><i class="fa fa-file-text-o"></i> Archivados</a>
            </li>
            <li class="active"><i class="fa fa-pencil"></i> Editar</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <a href="/mailbox/create" class="btn btn-primary btn-block margin-bottom"><span
                            class="fa fa-pencil-square-o"></span> Redactar</a>

                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Carpetas</h3>

                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                            <li class=""><a href="/mailbox"><i class="fa fa-inbox"></i> Inbox
                                    <span class="label label-primary pull-right">12</span></a></li>
                            <li><a href="/mailbox/sent"><i class="fa fa-envelope-o"></i> Enviados</a></li>
                            <li><a href="/mailbox/drafts"><i class="fa fa-file-text-o"></i> Archivados</a></li>
                            <li><a href="/mailbox/trash"><i class="fa fa-trash-o"></i> Papelera</a></li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Editar mensaje</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form id="create-mail" role="form" action="{{ route('mailbox.update', $message->id) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <input id="mail_state" name="mail_state" type="hidden" value="">
                        <div class="box-body">
                            <div class="form-group {{ $errors->has('destinatario') ? ' has-error' : '' }}">
                                <div class="form-group">
                                    <label for="destinatario">Destinatario:</label>
                                    <select id="destinatario" name="destinatario" class="form-control data-select"
                                            style="width: 100%;">
                                        <option value="">Seleccione el destinatario</option>
                                        @foreach($users as $user)
                                            <option {{ $user->id == $message->uid ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name . ' ' . $user->lastname }}</option>
                                        @endforeach
                                    </select>
                                    <span class="help-block">{{ $errors->first('destinatario') }}</span>
                                </div>
                                <div class="form-group {{ $errors->has('asunto') ? ' has-error' : '' }}">
                                    <label for="asunto">Asunto:</label>
                                    <input type="text" class="form-control" id="asunto"
                                           placeholder="Asunto" name="asunto" value="{{ old('asunto', $message->subject) }}">
                                    <span class="help-block">{{ $errors->first('asunto') }}</span>
                                </div>
                                <div class="form-group {{ $errors->has('etiqueta') ? ' has-error' : '' }}">
                                    <label for="etiqueta">Etiqueta:</label>
                                    <select name="etiqueta" id="etiqueta" class="form-control">
                                        <option value="">Seleccione</option>
                                        <option value="Importante" {{ $message->label == 'Importante' ? 'selected' : '' }}>Importante</option>
                                        <option value="Advertencia" {{ $message->label == 'Advertencia' ? 'selected' : '' }}>Advertencia</option>
                                        <option value="Informacion" {{ $message->label == 'Informacion' ? 'selected' : '' }}>Información</option>
                                    </select>
                                    <span class="help-block">{{ $errors->first('etiqueta') }}</span>
                                </div>
                                <div class="form-group {{ $errors->has('mensaje') ? ' has-error' : '' }}">
                                    <label for="mensaje">Mensaje:</label>
                                    <textarea id="mensaje" name="mensaje" class="editor form-control"
                                              placeholder="Cuerpo del mensaje"
                                              style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{!! $message->message !!}</textarea>
                                    <span class="help-block">{{ $errors->first('mensaje') }}</span>
                                </div>
                                <!-- /.form-group -->
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <div class="pull-right">
                                <button id="btn-draft" type="submit" class="btn btn-default"><i
                                            class="fa fa-pencil"></i> Archivar
                                </button>
                                <button id="btn-send" type="submit" class="btn btn-primary"><i class="fa fa-send"></i>
                                    Enviar
                                </button>
                            </div>
                            <a href="/mailbox/drafts" class="btn btn-danger"><i class="fa fa-times"></i> Cancelar</a>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@endsection