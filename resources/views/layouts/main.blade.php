<!DOCTYPE html>
<html lang="en">

    @include('layouts.header')

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  @include('layouts.navbar')
  @include('layouts.sidebar')
  @yield('content')

  @include('layouts.modal')
  @include('layouts.footer')