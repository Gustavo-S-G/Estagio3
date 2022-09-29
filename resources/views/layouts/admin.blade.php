<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="icon" type="imagem/png" href="imagens/LogoPersis.png" />
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="sidebar-mini" style="height: auto;">
    <div class="wrapper" id="app">
        {{-- Navbar --}}
        <nav class="main-header navbar navbar-expand navbar-dark">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">Inicio</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contato</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item d-none d-sm-inline-block">

                    <a href="{{ route('logout') }}" class="nav-link"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"
                        style="color: #f00;">
                        <p>
                            <i class="nav-icon fas fa-power-off"></i>
                            Sair
                        </p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>

        {{-- Sidebar --}}
        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="{{ url('imagens/LogoPersis.png') }}" alt=""
                    class="brand-image img-circle elevation-3">
                <span class="brand-text font-weight-light">Persis</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="" class="img-circle elevation-2" alt="">
                        {{-- <img src="{{ asset('img/avatar.jpg') }}" class="img-circle elevation-2" alt="User Image"> --}}
                    </div>
                    <div class="info">
                        {{-- <a href="#" class="d-block">Gerente</a> --}}
                        <a href="#" class="d-block">{{ auth()->user()->name }}</a>
                    </div>
                </div>

                <div class="form-inline">
                    {{-- Search --}}
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">

                        {{-- <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chalkboard"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li> --}}

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>
                                    Management
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('Criar usuário')
                                <li class="nav-item">
                                    <a href="{{ route('user.index') }}" class="nav-link">
                                        <i class="fas fa-users-cog nav-icon"></i>
                                        <p>Usuários</p>
                                    </a>
                                </li>
                                @endcan
                                @can('Criar função')
                                <li class="nav-item">
                                    <a href="{{ route('role.index') }}" class="nav-link">
                                        <i class="fas fa-bomb nav-icon"></i>
                                        <p>Funções</p>
                                    </a>
                                </li>
                                @endcan
                                @can('Criar permissão')
                                <li class="nav-item">
                                    <a href="{{ route('permission.index') }}" class="nav-link">
                                        <i class="fas fa-bomb nav-icon"></i>
                                        <p>Permissões</p>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('user.profile') }}" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Perfil
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('schedule.index') }}" class="nav-link">
                                <i class="fas fa-regular fa-calendar nav-icon"></i>
                                <p>Agenda</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fas fa-image nav-icon"></i>
                                <p>Alterar foto de perfil</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('user.GetPassword') }}" class="nav-link">
                                <i class="fas fa-lock nav-icon"></i>
                                <p>Alterar senha</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();"
                                style="color: #f00;">
                                <i class="nav-icon fas fa-power-off"></i>
                                <p>
                                    Sair
                                </p>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </a>
                        </li>

                    </ul>
                </nav>

            </div>

        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="min-height: 523px;">

            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">@yield('pageName')</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">@yield('title')</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->


            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    @include('partials.alert')
                    @yield('content')
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->

        </div>


        <aside class="control-sidebar control-sidebar-dark" style="display: none;">

            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>

        {{-- Footer --}}
        <footer class="main-footer">

            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>

            <strong>Copyright ©2022 <a href="https://www.persisinternet.com.br">Persis Internet</a>.</strong> All
            rights reserved.
        </footer>
        <div id="sidebar-overlay"></div>
    </div>
    <!-- ./wrapper -->
</body>

</html>
