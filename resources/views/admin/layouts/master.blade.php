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
  <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
    crossorigin="anonymous" />
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
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
  </script>
  <script src="{{ asset('template/dist/js/scripts.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
  <script src="{{ asset('template/dist/assets/demo/chart-area-demo.js') }}"></script>
  <script src="{{ asset('template/dist/assets/demo/chart-bar-demo.js') }}"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
  <script src="{{ asset('template/dist/assets/demo/datatables-demo.js') }}"></script>

  @stack('addon-script')
</body>

</html>