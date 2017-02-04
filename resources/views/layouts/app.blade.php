<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#367fa9">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.png">
    <!-- Title -->
    <title>{{ config('app.name', 'Sistema Inventario') }}</title>
    <!-- Styles -->
    <link href="/css/main.css" rel="stylesheet">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="/template/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link href="/libs/fa/css/font-awesome.min.css" rel="stylesheet">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/libs/ionicons/ionicons.min.css">
    <!-- Sweet Alert -->
    <link href="/libs/sa/sweetalert.css" rel="stylesheet">
    <!-- Select2 -->
    <link rel="stylesheet" href="/template/plugins/select2/select2.min.css">
    <!-- Datatables -->
    <link rel="stylesheet" href="/libs/datatables/datatables.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="/template/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/template/dist/css/AdminLTE.min.css">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
    <link rel="stylesheet" href="/template/dist/css/skins/skin-blue.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body class="hold-transition skin-blue sidebar-mini fixed">
<div id="loader-wrapper">
    <div id="loader"></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>
<div class="wrapper">

@php
    $mailCount = \App\Http\Controllers\Messages::getMailsCount();
    $importantCount = \App\Http\Controllers\Messages::getImportantMCount();
    $warningCount = \App\Http\Controllers\Messages::getWarningMCount();
    $infoCount = \App\Http\Controllers\Messages::getInfoMCount();
    $mails = \App\Http\Controllers\Messages::getMails(5);
@endphp
<!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="/" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>S</b>I</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Sis</b>Inventario</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Messages: style can be found in dropdown.less-->
                    <li class="dropdown messages-menu">
                        <!-- Menu toggle button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="label bg-red">{{ $mailCount == 0 ? '' : $mailCount }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">{{ $mailCount == 0 ? 'No tienes mensajes nuevos' : 'Tienes ' . $mailCount . ' mensajes nuevos' }}</li>
                            <li>
                                <!-- inner menu: contains the messages -->
                                <ul class="menu">
                                    @if(isset($mails) && count($mails) > 0)
                                        @foreach($mails as $mail)
                                            @php
                                                $labelClass = '';
                                            @endphp
                                            @if($mail->label == 'Informacion')
                                                @php($labelClass = 'bg-info')
                                            @elseif($mail->label == 'Advertencia')
                                                @php($labelClass = 'bg-warning')
                                            @else
                                                @php($labelClass = 'bg-danger')
                                            @endif
                                            <li><!-- start message -->
                                                <a href="/mailbox/{{ $mail->id }}" class="{{ $labelClass }}">
                                                    <div class="pull-left">
                                                        <!-- User Image -->
                                                        <img src="{{ $mail->img_url }}"
                                                             class="img-circle"
                                                             alt="User Image">
                                                    </div>
                                                    <!-- Message title and timestamp -->
                                                    <h4>
                                                        {{ $mail->name . ' ' . $mail->lastname }}
                                                        <small><i class="fa fa-clock-o"></i> {{ $mail->datetime }}
                                                        </small>
                                                    </h4>
                                                    <!-- The message -->
                                                    <p>{{ $mail->subject }}</p>
                                                </a>
                                            </li>
                                            <!-- end message -->
                                        @endforeach
                                    @else
                                        {{--<p>No hay mensajes sin leer.</p>--}}
                                    @endif
                                </ul>
                                <!-- /.menu -->
                            </li>
                            <li class="footer"><a href="/mailbox">Ver todos los mensajes</a></li>
                        </ul>
                    </li>
                    <!-- /.messages-menu -->
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="{{ Auth::user()->img_url }}" class="user-image" alt="User Image">
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{ Auth::user()->name . ' ' . Auth::user()->lastname }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="{{ Auth::user()->img_url }}" class="img-circle" alt="User Image">

                                <p>
                                    {{ Auth::user()->name . ' ' . Auth::user()->lastname }}
                                    <small><span class="label bg-green">{{ Auth::user()->state }}</span></small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="/profile" class="btn btn-default btn-flat">Perfil</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ url('/logout') }}"
                                       onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();"
                                       class="btn btn-default btn-flat">Cerrar Sesión
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ Auth::user()->img_url }}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name . ' ' . Auth::user()->lastname }}</p>
                    <p><span class="label bg-green">{{ Auth::user()->state }}</span></p>
                </div>
            </div>
            <!-- Sidebar Menu -->
            <ul class="sidebar-menu">
                <li class="header">MENÚ</li>
                <!-- Optionally, you can add icons to the links -->
                <li class="active">
                    <a href="/">
                        <i class="fa fa-home"></i> <span>Inicio</span>
                    </a>
                </li>
                <li class="">
                    <a href="/mailbox">
                        <i class="fa fa-envelope"></i> <span>Buzón</span>
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
                <li class="treeview">
                    <a href="#"><i class="fa fa-shopping-cart"></i> <span>Ventas</span>
                        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="/sale/create"><span class="fa fa-circle-o"></span>Añadir Venta</a>
                        </li>
                        <li><a href="/sale"><span class="fa fa-circle-o"></span>Listar Ventas</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-cubes"></i> <span>Productos</span>
                        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="/product/create"><span class="fa fa-circle-o"></span>Añadir Producto</a>
                        </li>
                        <li><a href="/product"><span class="fa fa-circle-o"></span>Listar Productos</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-tags"></i> <span>Categorías</span>
                        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="/category/create"><span class="fa fa-circle-o"></span>Añadir Categoría</a>
                        </li>
                        <li><a href="/category"><span class="fa fa-circle-o"></span>Listar Categorías</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-users"></i> <span>Clientes</span>
                        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="/client/create"><span class="fa fa-circle-o"></span>Añadir Cliente</a>
                        </li>
                        <li><a href="/client"><span class="fa fa-circle-o"></span>Listar Clientes</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-truck"></i> <span>Proveedores</span>
                        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="/provider/create"><span class="fa fa-circle-o"></span>Añadir Proveedor</a>
                        </li>
                        <li><a href="/provider"><span class="fa fa-circle-o"></span>Listar Proveedores</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-users"></i> <span>Usuarios</span>
                        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="/user/create"><span class="fa fa-circle-o"></span>Añadir Usuario</a>
                        </li>
                        <li><a href="/user"><span class="fa fa-circle-o"></span>Listar Usuarios</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-exchange"></i> <span>Movimientos</span>
                        <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="#"><span class="fa fa-circle-o"></span>Listar Movimientos</a></li>
                    </ul>
                </li>
            </ul>
            <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @yield('content')

    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            Trial
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2017 <a href="/">Sebastián Ortiz</a>.</strong> Todos los derechos reservados.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane active" id="control-sidebar-home-tab">
                <h3 class="control-sidebar-heading">Recent Activity</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:;">
                            <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                                <p>Will be 23 on April 24th</p>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- /.control-sidebar-menu -->

                <h3 class="control-sidebar-heading">Tasks Progress</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:;">
                            <h4 class="control-sidebar-subheading">
                                Custom Template Design
                                <span class="pull-right-container">
                  <span class="label label-danger pull-right">70%</span>
                </span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- /.control-sidebar-menu -->

            </div>
            <!-- /.tab-pane -->
            <!-- Stats tab content -->
            <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
            <!-- /.tab-pane -->
            <!-- Settings tab content -->
            <div class="tab-pane" id="control-sidebar-settings-tab">
                <form method="post">
                    <h3 class="control-sidebar-heading">General Settings</h3>

                    <div class="form-group">
                        <label class="control-sidebar-subheading">
                            Report panel usage
                            <input type="checkbox" class="pull-right" checked>
                        </label>

                        <p>
                            Some information about this general settings option
                        </p>
                    </div>
                    <!-- /.form-group -->
                </form>
            </div>
            <!-- /.tab-pane -->
        </div>
    </aside>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<!-- Scripts -->
<!-- jQuery 2.2.3 -->
<script src="/template/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="/template/bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="/template/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/template/plugins/fastclick/fastclick.js"></script>
<!-- Sweet Alerts -->
<script src="/libs/sa/sweetalert.min.js"></script>
<!-- Select2 -->
<script src="/template/plugins/select2/select2.full.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="/template/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="/template/plugins/bootstrap-wysihtml5/es_language_wysihtml5.js"></script>
{{--<!-- Iddle Timer -->--}}
{{--<script src="/libs/idleTimer/idle-timer.1.1.0.min.js"></script>--}}
<!-- AdminLTE App -->
<script src="/template/dist/js/app.min.js"></script>
<!-- DataTables -->
<script src="/libs/datatables/datatables.js"></script>
{{--<script src="/template/plugins/datatables/jquery.dataTables.min.js"></script>--}}
{{--<script src="/template/plugins/datatables/dataTables.bootstrap.min.js"></script>--}}
<!-- Custom Scripts -->
<script src="/js/main.js"></script>
<script src="/js/data.js"></script>
</body>
</html>
