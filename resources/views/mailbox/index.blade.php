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
            <li><a href="/"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active"><i class="fa fa-envelope"></i> Buzón</li>
        </ol>
        <div class="alert-container">
            @if (session()->has('msj'))
                <div class="alert-box success" role="alert">
                    <span class="fa fa-check-circle"></span>
                    {{ session('msj') }}
                </div>
            @elseif (session()->has('errorMsj'))
                <div class="alert-box error" role="alert">
                    <span class="fa fa-ban"></span>
                    {{ session('errorMsj') }}
                </div>
            @endif
        </div>
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
                            <li class="active">
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
                        <h3 class="box-title">Inbox</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                            <table class="table dtable table-hover table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>De</th>
                                    <th>Asunto</th>
                                    <th>Etiqueta</th>
                                    <th>Estado</th>
                                    <th>Fecha</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($mails as $mail)
                                    <tr>
                                        <td class="mailbox-name"><a
                                                    href="/mailbox/{{$mail->id}}">{{ $mail->name . ' ' . $mail->lastname }}</a>
                                        </td>
                                        <td class="mailbox-subject"><b>{{ $mail->subject }}</b>
                                        </td>
                                        <td>
                                            @if($mail->label == 'Informacion')
                                                <span class="label label-info">{{ $mail->label }}</span>
                                            @elseif ($mail->label == 'Advertencia')
                                                <span class="label label-warning">{{ $mail->label }}</span>
                                            @else
                                                <span class="label label-danger">{{ $mail->label }}</span>
                                            @endif
                                        </td>
                                        <td><span class="fa {{ $mail->opened == TRUE ? 'fa-envelope-open' : 'fa-envelope' }}"
                                                  data-toggle="tooltip" data-placement="top"
                                                  title="{{ $mail->opened == TRUE ? 'Leido' : 'Sin leer' }}"></span>
                                        </td>
                                        <td class="mailbox-date">{{ $mail->datetime }}</td>
                                        <td>
                                            <a href="/mailbox/{{ $mail->id }}" class="btn btn-xs btn-default"
                                               data-toggle="tooltip" data-placement="top" title="Ver">
                                                <span class="fa fa-eye"></span>
                                            </a>
                                            <form class="display_inline_block"
                                                  action="{{ route('mailbox.moveToTrash', [$mail->id, 'index']) }}"
                                                  method="POST">
                                                {{ method_field('PUT') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-xs tb-delete-mail"
                                                        data-toggle="tooltip" data-placement="top"
                                                        title="Eliminar">
                                                    <span class="fa fa-trash-o"></span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <!-- /.table -->
                        </div>
                        <!-- /.mail-box-messages -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /. box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@endsection