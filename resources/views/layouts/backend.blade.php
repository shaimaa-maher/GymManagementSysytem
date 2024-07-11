<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    {{-- Base Meta Tags --}}
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Custom Meta Tags --}}
    @yield('meta_tags')

    {{-- Title --}}
    <title>
        @yield('title_prefix', config('title_prefix', ''))
        @yield('title', config('title', 'RivalsFitness'))
        @yield('title_postfix', config('title_postfix', ''))
    </title>

    {{-- Custom stylesheets (pre AdminLTE) --}}
    @yield('adminlte_css_pre')

    {{-- Base Stylesheets --}}
    @if(!config('adminlte.enabled_laravel_mix'))
        <link rel="stylesheet" href="{{ asset('public/vendor/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('public/vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
        <link rel="icon" href="{{asset('public/images/logo.png')}}" type="image/png"> 
        {{-- Configured Stylesheets --}}
        @include('adminlte::plugins', ['type' => 'css'])

        <link rel="stylesheet" href="{{ asset('public/vendor/adminlte/dist/css/adminlte.min.css') }}">

        @if(config('adminlte.google_fonts.allowed', true))
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
        @endif
    @else
        <link rel="stylesheet" href="{{ mix(config('adminlte.laravel_mix_css_path', 'css/app.css')) }}">
    @endif

    {{-- Livewire Styles --}}
    @if(config('adminlte.livewire'))
        @if(app()->version() >= 7)
            @livewireStyles
        @else
            <livewire:styles />
        @endif
    @endif

    {{-- Custom Stylesheets (post AdminLTE) --}}
    @yield('adminlte_css')

    {{-- Favicon --}}
    @if(config('adminlte.use_ico_only'))
        <link rel="shortcut icon" href="{{ asset('public/favicons/favicon.ico') }}" />
    @elseif(config('adminlte.use_full_favicon'))
        <link rel="shortcut icon" href="{{ asset('public/favicons/favicon.ico') }}" />
        <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('public/favicons/apple-icon-57x57.png') }}">
        <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('public/favicons/apple-icon-60x60.png') }}">
        <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('public/favicons/apple-icon-72x72.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('public/favicons/apple-icon-76x76.png') }}">
        <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('public/favicons/apple-icon-114x114.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('public/favicons/apple-icon-120x120.png') }}">
        <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('public/favicons/apple-icon-144x144.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('public/favicons/apple-icon-152x152.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('public/favicons/apple-icon-180x180.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/favicons/favicon-16x16.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('public/favicons/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('public/favicons/favicon-96x96.png') }}">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" 
         integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('public/favicons/android-icon-192x192.png') }}">
        <link rel="manifest" crossorigin="use-credentials" href="{{ asset('public/favicons/manifest.json') }}">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="{{ asset('public/favicon/ms-icon-144x144.png') }}">
    @endif

</head>

<body class="@yield('classes_body')" @yield('body_data')>
<div class="wrapper">

<!-- Preloader -->
<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset('public/images/logo.gif')}}" alt="" height="200" width="200"> <h1 style="color: #FFC107;">Rivals Fitness</h1>
</div>


<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>

    <!-- <li class="nav-item d-none d-sm-inline-block">
      <a href="{{route('home')}}" class="nav-link">Home</a>
    </li> -->
  </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-warning elevation-4">

  <!-- Sidebar -->
  <div class="sidebar">

    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info">
        @guest
        <a href="" class="d-block">New User</a>
        @else
        <a href="" class="d-block">
          <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="white" class="bi bi-person-fill" viewBox="0 0 20 20">
           <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
          </svg>
          {{Auth::user()->name}}
        </a>
        @endguest

      </div> 
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar  flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
              with font-awesome or any other icon font library -->
          <li class="nav-item" >
            <a href="{{route('home')}}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }} ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          
          <li class="nav-header mt-4 bg-gray">PEOPLE</li>
          <li class="nav-item">
                <a href="{{route('members.index')}}" class="nav-link {{ request()->routeIs('members.index') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                &nbsp;
                  <p>Members</p>
                </a>
          </li>
          <li class="nav-item">
                <a href="{{route('trainers')}}" class="nav-link {{ request()->routeIs('trainers') ? 'active' : '' }}">
                <i class="fas fa-running"></i>
                &nbsp;
                  <p>Trainers</p>
                </a>
          </li>

          <li class="nav-header mt-4 bg-gray">Registeration</li>
          <li class="nav-item">
                <a href="{{route('attendance.register')}}" class="nav-link {{ request()->routeIs('attendance.register') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-upc-scan" viewBox="0 0 16 16">
                  <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5zM3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-7zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0v-7z"/>
                </svg>
                &nbsp;
                  <p> Register Members </p>
                </a>
          </li>
          <li class="nav-item">
                <a href="{{route('attendance')}}" class="nav-link {{ request()->routeIs('attendance') ? 'active' : '' }}">
                  <i class="fas fa-address-card"></i>
                &nbsp;
                  <p>Attendance</p>
                </a>
          </li>


          <li class="nav-header mt-4 bg-gray">FINANCE</li>
          <li class="nav-item">
                <a href="{{route('finance')}}" class="nav-link {{ request()->routeIs('finance') ? 'active' : '' }}">
                <i class="fas fa-landmark"></i>
                  &nbsp;
                  <p>All Finance</p>
                </a>
          </li>
          <li class="nav-item">
                <a href="{{route('expense')}}" class="nav-link {{ request()->routeIs('expense') ? 'active' : '' }}">
                <i class="fas fa-money-bill-wave"></i>
                  &nbsp;
                  <p>All Expenses</p>
                </a>
          </li>

          <li class="nav-item">
                <a href="{{route('categories')}}" class="nav-link {{ request()->routeIs('categories') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="gray" class="bi bi-tag" viewBox="0 0 16 16">
              <path d="M6 4.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm-1 0a.5.5 0 1 0-1 0 .5.5 0 0 0 1 0z"/>
              <path d="M2 1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 1 6.586V2a1 1 0 0 1 1-1zm0 5.586 7 7L13.586 9l-7-7H2v4.586z"/>
              </svg>
                  &nbsp;
                  <p>Categories</p>
                </a>
          </li>
          
          <!-- logout -->
          <li class="nav-item mt-5">
                <a class="nav-link" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                  <i class="nav-icon fas fa-sign-out-alt"></i>
                  <p>Log Out</p>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
          </li>

        </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <span class="m-0"><i class="fas fa-calendar-alt"></i>&nbsp {{Carbon\Carbon::now()->format('l');}} &nbsp<u>{{Carbon\Carbon::now()->toDateString();}}</u> &nbsp <i class="fas fa-clock"></i>&nbsp <u>{{Carbon\Carbon::now()->setTimeZone("Africa/Cairo")->format('g:i A');}}</u></span><br> 
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
              @yield('breadcrumb')
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->

      <div class="row">
        <b>Subscription Ends In</b> &nbsp <u><p id=counter></p></u> 
      </div>
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">   
    @yield('content')
    </div><!-- /.container-fluid -->
  </section> 
  
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
  <strong>Copyright &copy; 2023 <a href="https://www.bmsc.ws/">BMS</a>.</strong>
   All rights reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>


 


    {{-- Body Content --}}
    @yield('body')

    {{-- Base Scripts --}}
    @if(!config('adminlte.enabled_laravel_mix'))
        <script src="{{ asset('public/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('public/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('public/vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        

        {{-- Configured Scripts --}}
        @include('adminlte::plugins', ['type' => 'js'])

        <script src="{{ asset('public/vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    @else
        <script src="{{ mix(config('adminlte.laravel_mix_js_path', 'js/app.js')) }}"></script>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   

    {{-- Livewire Script --}}
    @if(config('adminlte.livewire'))
        @if(app()->version() >= 7)
            @livewireScripts
        @else
            <livewire:scripts />
        @endif
    @endif

    {{-- Custom Scripts --}}
   
    <script src="{{asset('public/js/main.js')}}"></script>
    @yield('adminlte_js')
   
</body> 

</html>
