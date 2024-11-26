<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet" />
  @livewireStyles

  <style>
    /* Sidebar and styling */
    .sidebar {
      background: linear-gradient(180deg, #1C4CB1, #140124);
      transition: all 0.3s ease-in-out;
    }

    .sidebar.collapsed {
      width: 80px;
      transition: width 0.3s ease;
    }

    .sidebar.collapsed .nav-item {
      text-align: center;
    }

    .sidebar.collapsed .nav-item a {
      padding-left: 0;
    }

    .sidebar.collapsed .nav-item span {
      display: none;
    }

    .sidebar-toggler {
      cursor: pointer;
      margin-left: 10px;
    }

    .navbar-nav .user-profile {
      display: flex;
      align-items: center;
    }

    .sidebar-brand {
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 10px;
    }

    /* Logo style */
    .logo-image {
      max-width: 130px;
      height: auto;
      transition: transform 0.5s ease, opacity 0.5s ease;
    }

    .sidebar.collapsed .logo-image {
      max-width: 60px; /* Adjust the size when collapsed */
      opacity: 0.8;
    }

    /* Animation when hovering */
    .logo-image:hover {
      transform: scale(1.1);
    }

    @keyframes fadeInScale {
      0% {
        opacity: 0;
        transform: scale(0.8);
      }
      100% {
        opacity: 1;
        transform: scale(1);
      }
    }
  </style>
</head>

<body id="page-top">

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="sidebar">
      <!-- Sidebar content -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('user.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15"></div>
        <div class="sidebar-brand"><img src="{{ asset('images/WHITE.png') }}" alt="Logo" class="logo-image"></div>
      </a>

      <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-fw fa-tachometer-alt"></i><span>Dashboard</span></a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('admin.users') }}"><i class="fas fa-fw fa-user"></i><span>Users</span></a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('admin.logs') }}"><i class="fas fa-fw fa-chart-line"></i><span>Logs</span></a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('admin.settings') }}"><i class="fas fa-fw fa-cogs"></i><span>Settings</span></a></li>
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3 sidebar-toggler"><i class="fa fa-bars"></i></button>
          <h4 class="h4 mb-0 text-gray-700 font-weight-bold">AICS Reporting Management System</h4>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" data-toggle="dropdown"><span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span><img class="img-profile rounded-circle" src="https://icons.veryicon.com/png/o/miscellaneous/yuanql/icon-admin.png"></a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Logout</a>
              </div>
            </li>
          </ul>
        </nav>

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <main>
            {{ $slot }}
          </main>
        </div>
      </div>
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span> DSWD Region XI {{ date('Y') }}</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->
    </div>

  </div>
  <!-- End of Page Wrapper -->

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('admin_assets/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('admin_assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('admin_assets/js/sb-admin-2.min.js') }}"></script>
  <script>
    const sidebar = document.querySelector('#sidebar');
    const sidebarToggler = document.querySelector('.sidebar-toggler');
    sidebarToggler.addEventListener('click', () => sidebar.classList.toggle('collapsed'));
  </script>

  @livewireScripts
</body>
</html>
