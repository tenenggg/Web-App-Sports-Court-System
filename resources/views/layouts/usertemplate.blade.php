<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Court Hub | User Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.min.css') }}">

  <!-- Add custom styles -->
  <style>
    .main-header {
      background: linear-gradient(135deg, #000000 0%, #1a1a1a 100%);
    }
    .main-header .nav-link {
      color: #ffffff !important;
    }
    .brand-link {
      background: linear-gradient(135deg, #000000 0%, #1a1a1a 100%);
    }
    .sidebar-dark-primary {
      background: #000000;
    }
    .nav-sidebar .nav-item .nav-link.active {
      background-color: rgba(255, 107, 0, 0.2);
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      border-left: 3px solid #ff6b00;
      color: #ffffff !important;
    }
    .card {
      border-radius: 15px;
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      border: 1px solid rgba(255, 107, 0, 0.2);
    }
    .btn-danger {
      background: linear-gradient(135deg, #ff6b00 0%, #ff8533 100%);
      border: none;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .content-wrapper {
      background-color: #f4f6f9;
    }
    .nav-sidebar .nav-link:hover {
      background-color: rgba(255, 107, 0, 0.1);
    }
    .nav-sidebar .nav-icon {
      color: #ff6b00;
    }
    .brand-link .brand-image {
      border-color: #ff6b00;
    }
    .user-panel .image i {
      color: #ff6b00;
    }
    .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active {
      color: #ffffff !important;
      font-weight: 600;
    }

    /* Override any default colors */
    .btn-success, 
    .btn-info, 
    .btn-warning,
    .btn-secondary,
    .btn-primary {
        background: linear-gradient(135deg, #ff6b00 0%, #ff8533 100%) !important;
        border: none !important;
        color: white !important;
    }

    .text-success,
    .text-primary,
    .text-info {
        color: #ff6b00 !important;
    }

    .bg-success,
    .bg-info,
    .bg-primary {
        background: linear-gradient(135deg, #ff6b00 0%, #ff8533 100%) !important;
    }

    .alert {
        background-color: rgba(255, 107, 0, 0.1) !important;
        border-left: 4px solid #ff6b00 !important;
        color: #000000 !important;
    }

    .nav-pills .nav-link.active {
        background-color: #ff6b00 !important;
    }

    .dropdown-item.active, 
    .dropdown-item:active {
        background-color: #ff6b00 !important;
    }

    /* Table cell colors */
    .table td {
        color: #000000 !important;
    }

    /* Form elements */
    .form-control {
        border: 1px solid rgba(255, 107, 0, 0.2) !important;
    }

    .form-control:focus {
        border-color: #ff6b00 !important;
    }

    /* Preloader color fix */
    .preloader i {
        color: #ff6b00 !important;
    }

    /* Fix any remaining blue colors */
    a {
        color: #ff6b00;
    }

    a:hover {
        color: #ff8533;
    }

    /* Status badges */
    .badge {
        background-color: #ff6b00 !important;
        color: white !important;
    }

    .badge-secondary {
        background-color: #1a1a1a !important;
    }

    /* Card title colors */
    .card-title {
        color: #000000 !important;
    }

    /* Input group addons */
    .input-group-text {
        background-color: #1a1a1a !important;
        color: white !important;
        border: 1px solid #1a1a1a !important;
    }

    /* Select2 and other plugin overrides */
    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #ff6b00 !important;
        color: white !important;
    }

    /* Calendar/Date picker colors */
    .daterangepicker td.active, 
    .daterangepicker td.active:hover {
        background-color: #ff6b00 !important;
    }

    /* Chart colors */
    .chart-color-1 { background-color: #ff6b00 !important; }
    .chart-color-2 { background-color: #ff8533 !important; }
    .chart-color-3 { background-color: #1a1a1a !important; }

    /* Small text colors */
    .text-muted {
        color: rgba(0, 0, 0, 0.6) !important;
    }

    /* Navbar button colors */
    .btn-navbar {
        background-color: rgba(255, 107, 0, 0.1) !important;
        border: 1px solid rgba(255, 107, 0, 0.2) !important;
    }

    .btn-navbar:hover {
        background-color: rgba(255, 107, 0, 0.2) !important;
    }

    /* Additional fixes for user template */
    .navbar-light .navbar-nav .nav-link {
        color: #ff6b00 !important;
    }

    .navbar-light .navbar-nav .nav-link:hover {
        color: #ff8533 !important;
    }

    .form-control-navbar {
        background-color: rgba(255, 107, 0, 0.1) !important;
        border-color: rgba(255, 107, 0, 0.2) !important;
    }

    .form-control-navbar::placeholder {
        color: rgba(0, 0, 0, 0.6) !important;
    }

    /* Fix any remaining colors in the booking section */
    .booking-slot.available {
        background-color: rgba(255, 107, 0, 0.1) !important;
        border: 1px solid #ff6b00 !important;
    }

    .booking-slot.selected {
        background-color: #ff6b00 !important;
        color: white !important;
    }

    .booking-slot.unavailable {
        background-color: #1a1a1a !important;
        color: white !important;
    }

    /* Make all sidebar text white with orange on hover */
    .nav-sidebar .nav-link {
      color: rgba(255, 255, 255, 0.8) !important;
    }
    
    .nav-sidebar .nav-link:hover {
      color: #ff6b00 !important;
    }
    
    /* Keep icon orange */
    .nav-sidebar .nav-link .nav-icon {
      color: #ff6b00 !important;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <i class="fas fa-basketball-ball fa-4x animation__shake" style="color: #1e3c72"></i>
    <h3 class="mt-3">Court Hub</h3>
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <i class="fas fa-basketball-ball fa-2x brand-image elevation-3" style="color: #ffc371; opacity: 0.8"></i>
      <span class="brand-text font-weight-light">Court Hub</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <i class="fas fa-user-circle fa-2x" style="color: #ffc371"></i>
        </div>
        <div class="info">
          <a href="#" class="d-block text-white">Welcome, {{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <li class="nav-item">
                <a href="{{ route('user.home') }}" class="nav-link {{ Request::is('user/home*') ? 'active' : '' }}">
                  <i class="fas fa-home nav-icon"></i>
                  <p>Dashboard</p>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="{{ route('user.bookcourts.index') }}" class="nav-link {{ Request::is('user/bookcourts*') ? 'active' : '' }}">
                  <i class="fas fa-calendar-plus nav-icon"></i>
                  <p>Book your Court</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('user.bookinghistory.index') }}" class="nav-link {{ Request::is('user/bookinghistory*') ? 'active' : '' }}">
                  <i class="fas fa-history nav-icon"></i>
                  <p>Booking History</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('user.feedbacks.index') }}" class="nav-link {{ Request::is('user/feedbacks*') ? 'active' : '' }}">
                    <i class="fas fa-comment nav-icon"></i>
                    <p>Send Feedback</p>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="{{ route('user.profile.edit') }}" class="nav-link {{ Request::is('user/profile*') ? 'active' : '' }}">
                  <i class="fas fa-user nav-icon"></i>
                  <p>My Profile</p>
                </a>
            </li>

            <li class="nav-item">
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
              <a href="#" 
                 class="btn btn-danger btn-sm text-white"
                 onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Log Out
              </a>
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
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-lg-10"> <!-- Adjust the column width to make it wide -->
          <!-- Custom tabs (Charts with tabs)-->
          <div class="card">
           
            <div class="card-body">
              <div class="tab-content p-0">
                <!-- Main content goes here -->
                @yield('content')
              </div>
            </div><!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div><!-- /.col-lg-10 -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.Main content -->
</div>
<!-- ./wrapper -->


            
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('admin/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('admin/plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('admin/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('admin/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('admin/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('admin/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('admin/dist/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('admin/dist/js/pages/dashboard.js') }}"></script>

@stack('scripts')
</body>
</html>
