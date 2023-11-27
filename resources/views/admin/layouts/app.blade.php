<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>General Dashboard &mdash; Stisla</title>
  <!-- Start GA -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'UA-94034622-3');
  </script>
  <!-- /END GA -->
</head>
@include('admin.includes.styles')

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <!-- Navbar -->
      @include('admin.includes.navbar')
      <!-- Navbar -->
      <!-- sidebar -->
      @include('admin.includes.sidebar')
      <!-- sidebar -->
      <!-- Main Content -->
      <div class="main-content">
        @yield('conteudo')
      </div>
      <!-- Footer -->
      @include('admin.includes.footer')
      <!-- Footer -->
    </div>
  </div>
  <!-- General JS Scripts -->
  @include('admin.includes.scripts')
      <!-- Sweet Alert Js -->
      @include('sweetalert::alert')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @stack('scripts')
</body>

</html>