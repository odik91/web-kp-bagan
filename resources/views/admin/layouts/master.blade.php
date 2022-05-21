<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>@if(isset($title)) {{ $title }} @else {{ 'Dashboard' }} @endif - SI Admin</title>
  <link href="{{ asset('template/dist/css/styles.css') }}" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous">
  </script>
  @stack('addon-header')
</head>

<body class="sb-nav-fixed">
  @include('admin.layouts.navbar')
  <div id="layoutSidenav">
    @include('admin.layouts.sidebar')
    <div id="layoutSidenav_content">
      @yield('content')
      @include('admin.layouts.footer')
    </div>
  </div>
  @stack('addon-script')
</body>

</html>