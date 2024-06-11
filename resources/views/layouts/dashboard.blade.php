<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('template/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('template/img/logo_dishub.png')}}">
  <title>
    {{config('app.name')}} - @yield('title')
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{asset('template/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{asset('template/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{asset('template/css/nucleo-svg.css')}}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{asset('template/css/argon-dashboard.css?v=2.0.4')}}" rel="stylesheet" />
  <!-- Data Tables -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap.min.css">
  @stack('css-external')
  @stack('css-internal')
</head>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  <!-- sidebar -->
    @include('layouts._dashboard.sidebar')
  <!-- end sidebar -->
  <main class="main-content position-relative border-radius-lg ">
    <!-- navbar -->
      @include('layouts._dashboard.navbar')
    <!-- end navbar -->
      <!-- content -->
        @yield('content')
      <!-- end content -->
      <!-- footer -->
        @include('layouts._dashboard.footer')
      <!-- end footer -->
    </div>
  </main>

  <!--   Core JS Files   -->
  <script src="{{asset('template/js/core/popper.min.js')}}"></script>
  <script src="{{asset('template/js/core/bootstrap.min.js')}}"></script>
  <script src="{{asset('template/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{asset('template/js/plugins/smooth-scrollbar.min.js')}}"></script>
  <script src="{{asset('template/js/plugins/chartjs.min.js')}}"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('template/js/argon-dashboard.min.js?v=2.0.4')}}"></script>

  <!-- Data Tables -->
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
  <script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
  </script>
  
  @include('sweetalert::alert')
  @stack('javascript-external')
  @stack('javascript-internal')
</body>

</html>