<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Court Hub | Admin Dashboard</title>

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
    .nav-sidebar .nav-item .nav-link {
      margin-bottom: 5px;
      border-radius: 8px;
      transition: all 0.3s ease;
    }
    .nav-sidebar .nav-item .nav-link:hover {
      background-color: rgba(255, 107, 0, 0.1);
      transform: translateX(5px);
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
    .table-action-btn {
      color: #ff6b00;
      transition: all 0.3s ease;
    }
    .table-action-btn:hover {
      color: #ff8533;
      transform: translateY(-2px);
    }

    /* Content Area Styles */
    .content-wrapper {
      background-color: #f8f9fa;
    }
    
    .card {
      background: white;
      border: 1px solid rgba(255, 107, 0, 0.2);
      transition: all 0.3s ease;
    }
    
    /* Table Styles */
    .table thead th {
      background: linear-gradient(135deg, #000000 0%, #1a1a1a 100%);
      color: white;
      border: none;
    }
    
    .table tbody tr:hover {
      background-color: rgba(255, 107, 0, 0.05);
    }
    
    /* Action Buttons */
    .btn-primary {
      background: linear-gradient(135deg, #ff6b00 0%, #ff8533 100%);
      border: none;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .btn-primary:hover {
      background: linear-gradient(135deg, #ff8533 0%, #ff6b00 100%);
      transform: translateY(-2px);
    }
    
    /* Card Headers */
    .card-header {
      background: linear-gradient(135deg, #000000 0%, #1a1a1a 100%);
      color: white;
      border-bottom: 2px solid #ff6b00;
    }
    
    /* Form Controls */
    .form-control:focus {
      border-color: #ff6b00;
      box-shadow: 0 0 0 0.2rem rgba(255, 107, 0, 0.25);
    }
    
    /* Pagination */
    .page-item.active .page-link {
      background-color: #ff6b00;
      border-color: #ff6b00;
    }
    
    .page-link {
      color: #ff6b00;
    }
    
    .page-link:hover {
      color: #ff8533;
    }
    
    /* Status Labels */
    .badge-success {
      background-color: #ff6b00;
    }
    
    .badge-pending {
      background-color: #1a1a1a;
    }
    
    /* Search Box */
    .search-box {
      border: 1px solid rgba(255, 107, 0, 0.2);
      border-radius: 20px;
      padding: 8px 15px;
    }
    
    .search-box:focus {
      border-color: #ff6b00;
      box-shadow: 0 0 0 0.2rem rgba(255, 107, 0, 0.25);
    }
    
    /* Custom Cards for Dashboard */
    .info-box {
      background: white;
      border-left: 4px solid #ff6b00;
    }
    
    .info-box-icon {
      background: linear-gradient(135deg, #ff6b00 0%, #ff8533 100%);
      color: white;
    }
    
    /* Modal Styles */
    .modal-header {
      background: linear-gradient(135deg, #000000 0%, #1a1a1a 100%);
      color: white;
      border-bottom: 2px solid #ff6b00;
    }
    
    .modal-footer {
      border-top: 1px solid rgba(255, 107, 0, 0.2);
    }
    
    /* Alert Messages */
    .alert-success {
      background-color: rgba(255, 107, 0, 0.1);
      border-left: 4px solid #ff6b00;
      color: #000000;
    }
    
    /* Custom Scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
    }
    
    ::-webkit-scrollbar-track {
      background: #f1f1f1;
    }
    
    ::-webkit-scrollbar-thumb {
      background: #ff6b00;
      border-radius: 4px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
      background: #ff8533;
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

    /* Venue image styles */
    .venues-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
        padding: 1rem;
    }

    .venue-card {
        display: flex;
        flex-direction: column;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        overflow: hidden;
        background: white;
        transition: transform 0.2s ease;
    }

    .venue-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .venue-image-container {
        position: relative;
        width: 100%;
        padding-top: 66.67%; /* 3:2 Aspect Ratio */
        overflow: hidden;
    }

    .venue-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100% !important;
        height: 100% !important;
        object-fit: cover;
        object-position: center;
    }

    /* Card content styling */
    .venue-content {
        padding: 1.5rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .venue-content h4 {
        color: #333;
        font-size: 1.2rem;
        margin-bottom: 0.5rem;
    }

    .venue-content p {
        margin-bottom: 0.5rem;
        font-size: 0.9rem;
    }

    .venue-content .text-muted {
        color: #666 !important;
    }

    .venue-content .text-primary {
        color: #ff6b00 !important;
        font-weight: bold;
    }

    .venue-content i {
        width: 20px;
        text-align: center;
        color: #ff6b00;
    }

    /* Make description text not too long */
    .venue-content .description {
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }
  </style>

  <!-- Add these in the head section -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script src="https://js.stripe.com/v3/"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <i class="fas fa-shield-alt fa-4x animation__shake" style="color: #1e3c72"></i>
    <h3 class="mt-3">Admin Dashboard</h3>
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
      <i class="fas fa-shield-alt fa-2x brand-image elevation-3" style="color: #ffc371; opacity: 0.8"></i>
      <span class="brand-text font-weight-light">Court Hub</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <i class="fas fa-user-shield fa-2x" style="color: #ffc371"></i>
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
                <a href="{{ route('admin.home') }}" class="nav-link {{ Request::is('admin/home*') ? 'active' : '' }}">
                  <i class="fas fa-tachometer-alt nav-icon"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{ route('admin.users.index') }}" class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}">
                  <i class="fas fa-users nav-icon"></i>
                  <p>List of Users</p>
                </a>
              </li>
           
            <li class="nav-item">
                <a href="{{ route('admin.venues.index') }}" class="nav-link {{ Request::is('admin/venues*') ? 'active' : '' }}">
                  <i class="fas fa-map-marker-alt nav-icon"></i>
                  <p>List of Venues</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('admin.bookings.index') }}" class="nav-link {{ Request::is('admin/bookings*') ? 'active' : '' }}">
                  <i class="fas fa-calendar-check nav-icon"></i>
                  <p>List of Bookings</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('admin.payments.index') }}" class="nav-link {{ Request::is('admin/payments*') ? 'active' : '' }}">
                  <i class="fas fa-money-bill-wave nav-icon"></i>
                  <p>List of Payments</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('admin.feedbacks.index') }}" class="nav-link {{ Request::is('admin/feedbacks*') ? 'active' : '' }}">
                  <i class="fas fa-comments nav-icon"></i>
                  <p>List of Feedbacks</p>
                </a>
              </li>
                          
            </ul>

            

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
</body>
</html>
