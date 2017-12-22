<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" >
    <!-- <link href="/css/app.css" rel="stylesheet"> -->
    <link href="{{ URL::asset('css/bootstrap.ubuntu.min.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ URL::asset('css/jquery.dataTables.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ URL::asset('css/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ URL::asset('css/selectize.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ URL::asset('css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" >
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    
    @yield('styles')
    <style>
    .loader {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('images/page-loader.gif') 50% 50% no-repeat rgb(249,249,249);
    }
    </style>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('configuration.site_name') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Right Side Of Navbar -->
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        {!! $MenuUtama->asUl(['class' => 'nav navbar-nav'],['class'=>'dropdown-menu']) !!}
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}"><i class="fa fa-sign-in"></i> Login</a></li>
                            <li><a href="{{ url('/register') }}"> Registrasi</a></li>
                        @else
                            @role('admin')
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <i class="fa fa-pencil"></i> Editor <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    {!! Html::smartNavBackend(url('/admin/post'), 'Berita','fa fa-pencil') !!}
                                    {!! Html::smartNavBackend(url('/admin/page'), 'Halaman','fa fa-book') !!}
                                    {!! Html::smartNavBackend(url('/admin/menu'), 'Menu','fa fa-book') !!}
                                    {!! Html::smartNavBackend(url('/admin/slider'), 'Slider','fa fa-image') !!}
                                    {!! Html::smartNavBackend(url('/admin/social'), 'Social','fa fa-facebook') !!}
                                    {!! Html::smartNavBackend(url('/admin/album'), 'Album Foto','fa fa-camera-retro') !!}
                                    {!! Html::smartNavBackend(url('/admin/file'), 'File & PDF','fa fa-file') !!}
                                    {!! Html::smartNavBackend(url('/admin/setting'), 'Setting','fa fa-cog') !!}
                                    {!! Html::smartNavBackend(url('/admin/member'), 'Member','fa fa-users') !!}
                                </ul>
                            </li>
                            @endrole
                            <li><a href="{{ url('/settings/profile') }}"><i class="fa fa-user"></i> Profil</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out"></i> Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        <div style="padding-top:70px;">
        @include('layouts._flash')
        @yield('content')
        </div>
    </div>

    
    <!-- Scripts -->
    <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/selectize.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript" src="{{ URL::asset('js/custom.js') }}"></script>
    @yield('scripts')
</body>
</html>
