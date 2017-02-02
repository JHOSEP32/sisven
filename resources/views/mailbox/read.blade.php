@extends('layouts.app')
@section('content')
    @php
        $mailCount = \App\Http\Controllers\Messages::getMailsCount();
        $importantCount = \App\Http\Controllers\Messages::getImportantMCount();
        $warningCount = \App\Http\Controllers\Messages::getWarningMCount();
        $infoCount = \App\Http\Controllers\Messages::getInfoMCount();
    @endphp
    <section class="content-header">
        <h1>
            Buzón de Mensajes
            <small>
                @if(!$mailCount <= 0)
                    Tienes {{ $mailCount }} {{ $mailCount > 1 ? 'mensajes nuevos' : 'mensaje nuevo' }}
                @else
                    No tienes mensajes nuevos
                @endif
            </small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="/"><i class="fa fa-home"></i> Inicio</a>
            </li>
            <li>
                <a href="/category"><i class="fa fa-tags"></i> Categorías</a>
            </li>
            <li class="active"><i class="fa fa-eye"></i> Leer</li>
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
                            <li>
                                <a href="/mailbox"><i class="fa fa-inbox"></i> <span>Inbox</span>
                                    <span class="pull-right-container">
                                        <small class="label pull-right label-danger"
                                               title="Importante">{{ $importantCount == 0 ? '' : $importantCount }}</small> {{-- Danger --}}
                                        <small class="label pull-right label-warning"
                                               title="Advertencia">{{ $warningCount == 0 ? '' : $warningCount }}</small> {{-- Warning --}}
                                        <small class="label pull-right label-info"
                                               title="Información">{{ $infoCount == 0 ? '' : $infoCount }}</small> {{-- Info --}}
                                    </span>
                                </a>
                            </li>
                            <li><a href="/mailbox/sent"><i class="fa fa-envelope-o"></i> Enviados</a></li>
                            <li><a href="/mailbox/drafts"><i class="fa fa-file-text-o"></i> Archivados</a></li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Leer mensaje</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="mailbox-read-info">
                            <h3>{{ $message->subject }}</h3>
                            <h5>
                                @if ($isMine)
                                    Para :
                                    <a href="/user/{{ $message->rid }}"><b>{{ $message->rname . ' ' . $message->rlastname . ' (' . $message->remail . ')' }}</b></a>
                                    <span class="mailbox-read-time pull-right">{{ $message->datetime }}</span>
                                @else
                                    De:
                                    <a href="/user/{{ $message->sid }}"><b>{{ $message->sname . ' ' . $message->slastname . ' (' . $message->semail . ')' }}</b></a>
                                    <span class="mailbox-read-time pull-right">{{ $message->datetime }}</span>
                                @endif
                            </h5>
                        </div>
                        <!-- /.mailbox-read-info -->
                        <div class="mailbox-read-message">
                            {!! $message->message !!}
                        </div>
                        <!-- /.mailbox-read-message -->
                    </div>
                    <div class="box-footer">
                        <a href="/mailbox" class="btn btn-default"><i class="fa fa-inbox"></i> Volver al Inbox</a>
                        @if(!$isMine)
                            <form class="display_inline_block"
                                  action="{{ route('mailbox.moveToTrash', [$message->id, 'index']) }}"
                                  method="POST">
                                {{ method_field('PUT') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger tb-delete-mail">
                                    <span class="fa fa-trash-o"></span> Eliminar
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
@endsection