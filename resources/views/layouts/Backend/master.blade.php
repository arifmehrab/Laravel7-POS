<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('assets/Backend/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('assets/Backend/css/sb-admin-2.min.css') }}" rel="stylesheet">
  <!-- select2 min css -->
  <link href="{{ asset('assets/Backend/select2/css/select2.min.css') }}" rel="stylesheet">
  <!--- extra page source ----->
  @stack('css')
</head>

<body id="page-top">
      
      @include('layouts.Backend.partials.sidebar')
      @include('layouts.Backend.partials.topnavigation')

      <!-- Begin Page Content -->
        <div class="container-fluid">
            @yield('content')
       </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; ArifMehrab 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="{{ route('logout') }}"
          onclick="event.preventDefault();
           document.getElementById('logout-form').submit();"
          >
          Logout
                                      
          </a>
           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('assets/Backend/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/Backend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('assets/Backend/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('assets/Backend/js/sb-admin-2.min.js') }}"></script>

  <!-- Page level plugins -->
  <script src="{{ asset('assets/Backend/vendor/chart.js/Chart.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('assets/Backend/js/demo/chart-area-demo.js') }}"></script>
  <script src="{{ asset('assets/Backend/js/demo/chart-pie-demo.js') }}"></script>
  <script src="{{ asset('assets/Backend/js/handlebars.min.js') }}"></script>
  <!--- Notify js Start --->
  <script src="{{ asset('assets/Backend/js/notify.js') }}"></script>
  <!-- Select2 js -->
  <script src="{{ asset('assets/Backend/select2/js/select2.min.js') }}"></script>
  @stack('js')
  @stack('ajax')
  <!---- Success Message -->
  @if(session()->has('success'))
    <script type="text/javascript">
      $(function(){
        $.notify("{{ session()->get('success') }}",{globalPosition:'top right',className:'success'});
      });
    </script>
  @endif
  <!---- Error Message -->
  @if(session()->has('error'))
    <script type="text/javascript">
      $(function(){
        $.notify("{{ session()->get('error') }}",{globalPosition:'top right',className:'error'});
      });
    </script>
  @endif
<!--- Notify js End --->
<!---- Select2 ---->
<script type="text/javascript">
  $(document).ready(function(){
     $(".select2").select2();
  });
</script>
</body>

</html>
