<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>User Dashboard</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <script src="{{ asset('js/app.js') }}" defer></script>
  <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet" />
  <!-- jQuery and Popper.js (necessary for Bootstrap 4) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <!-- Bootstrap JS (Bootstrap 4) -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


  @livewireStyles

  <style>
    /* Custom Sidebar with Gradient */
    .sidebar {
      background: linear-gradient(180deg, #1C4CB1, #140124);
      transition: all 0.3s ease-in-out;
    }

    .sidebar.collapsed {
      width: 80px;
      transition: width 0.3s ease;
    }

    /* Styling for the sidebar items when collapsed */
    .sidebar.collapsed .nav-item {
      text-align: center;
    }

    .sidebar.collapsed .nav-item a {
      padding-left: 0;
    }

    /* Styling for the collapsed sidebar icons */
    .sidebar.collapsed .nav-item a i {
      margin-right: 0;
      font-size: 1.5rem;
    }

    /* Hide text when sidebar is collapsed */
    .sidebar.collapsed .nav-item span {
      display: none;
    }

    /* Styling for toggle button */
    .sidebar-toggler {
      .sidebar-toggler {
    cursor: pointer;
    margin-left: 10px; /* Adjust this value to reduce the distance */

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

  .logo-image {
    max-width: 100%;
    height: auto;
    display: flex;
    transition: transform 0.5s ease, opacity 0.5s ease;
    opacity: 0;
    transform: scale(0.8);
    animation: fadeInScale 0.5s forwards; /* Animation on page load */
  }

  /* Add hover effect to the logo */
  .logo-image:hover {
    transform: scale(1.1); /* Slightly enlarge the image on hover */
  }

  /* Keyframes for fade-in and scale-up effect */
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

  /* Adjust spacing between the logo and sidebar items */
  .sidebar-brand-icon {
    margin-right: 10px;
  }

  </style>
</head>

<body id="page-top">

  <div id="wrapper">


    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="sidebar">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon rotate-n-15"></div>
        <div class="sidebar-brand">
          <img src="{{ asset('images/WHITE.png') }}" alt="Logo" class="logo-image">
        </div>
      </a>

      <hr class="sidebar-divider" style="margin: 1.0rem 0;">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="{{ route('user.dashboard') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <hr class="sidebar-divider" style="margin: 1.0rem 0;">
      <div class="sidebar-heading">Interface</div>
      <hr class="sidebar-divider" style="margin: 1.0rem 0;">

      <!-- Nav Item - Documents -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('user.document') }}">
          <i class="fas fa-fw fa-folder"></i>
          <span>Documents</span>
        </a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('user.BeneficiaryTable') }}">
          <i class="fas fa-fw fa-table"></i>
          <span>Tables</span>
        </a>
      </li>

      <!-- Nav Item - Reporting -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('user.ReportingTable') }}">
          <i class="fas fa-fw fa-chart-line"></i>
          <span>Reporting</span>
        </a>
      </li>

      <!-- Nav Item - Recycle Bin -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('user.recyclebin') }}">
          <i class="fas fa-fw fa-trash"></i>
          <span>Recycle Bin</span>
        </a>
      </li>

      <hr class="sidebar-divider" style="margin: 1.0rem 0;">
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3 sidebar-toggler">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Title -->
          <h4 class="h4 mb-0 text-gray-700 font-weight-bold">AICS Reporting Management System</h4>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">USER</span>
                <img class="img-profile rounded-circle" src="https://icons.veryicon.com/png/o/miscellaneous/yuanql/icon-admin.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                      <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                      Logout
                    </a>

              </div>
            </li>
          </ul>
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <main>
            {{ $slot }}
          </main>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
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
          <h5 class="modal-title" id="exampleModalLabel">Are you sure you want to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close"style="color: #000; border: none; outline: none;">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          @livewire('user.logout')
        </div>
      </div>
    </div>
  </div>

  <!-- JavaScript -->
  <script src="{{ asset('admin_assets/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('admin_assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('admin_assets/js/sb-admin-2.min.js') }}"></script>
  <script src="{{ asset('admin_assets/vendor/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('admin_assets/js/demo/chart-area-demo.js') }}"></script>
  <script src="{{ asset('admin_assets/demo/chart-pie-demo.js') }}"></script>

  <script>
    // Sidebar toggle script
    const sidebar = document.querySelector('#sidebar');
    const sidebarToggler = document.querySelector('.sidebar-toggler');

    sidebarToggler.addEventListener('click', () => {
      sidebar.classList.toggle('collapsed');
    });
  </script>

  @livewireScripts
</body>

</html>
