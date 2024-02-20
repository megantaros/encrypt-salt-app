<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link rel="shortcut icon" type="image/png" href="{{asset('template/src/assets/images/logos/favicon.png')}}" />
  <link rel="stylesheet" href="{{asset('template/src/assets/css/styles.min.css')}}" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css">

  @yield('css')

  {{-- Change color pagination button --}}
  <style>
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
      background: none;
      color: black!important;
      border-radius: 4px;
      border: 1px solid #828282;
    }
  
    .dataTables_wrapper .dataTables_paginate .paginate_button:active {
      background: none;
      color: black!important;
    }
  </style>
</head>

<body>
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="{{route('admin.dashboard')}}" class="text-nowrap logo-img">
            <img src="{{asset('template/src/assets/images/logos/dark-logo.svg')}}" width="180" alt="" />
            {{-- <h5 class="fw-bolder">Aplikasi Dekripsi Enkripsi</h5> --}}
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>

        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Menu</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('admin.dashboard')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard fs-5 "></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('admin.jabatan')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-users fs-5"></i>
                </span>
                <span class="hide-menu">Jabatan</span>
              </a>
            </li>
            {{-- <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('admin.gaji')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-report-money fs-5 "></i>
                </span>
                <span class="hide-menu">Penggajian</span>
              </a>
            </li> --}}
            {{-- <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('admin.karyawan')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-users fs-5"></i>
                </span>
                <span class="hide-menu">Karyawan</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('admin.gaji')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-report-money fs-5 "></i>
                </span>
                <span class="hide-menu">Gaji</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('admin.tunjangan')}}" aria-expanded="false">
                <span>
                  <i class="ti ti-moneybag fs-5 "></i>
                </span>
                <span class="hide-menu">Tunjangan</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="{{route('admin.jabatan')}}" aria-expanded="false">
                <span>
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-star" width="18" height="18" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                    <path d="M6 21v-2a4 4 0 0 1 4 -4h.5" />
                    <path d="M17.8 20.817l-2.172 1.138a.392 .392 0 0 1 -.568 -.41l.415 -2.411l-1.757 -1.707a.389 .389 0 0 1 .217 -.665l2.428 -.352l1.086 -2.193a.392 .392 0 0 1 .702 0l1.086 2.193l2.428 .352a.39 .39 0 0 1 .217 .665l-1.757 1.707l.414 2.41a.39 .39 0 0 1 -.567 .411l-2.172 -1.138z" />
                  </svg>
                </span>
                <span class="hide-menu">Jabatan</span>
              </a>
            </li> --}}
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->

    <!--  Main wrapper -->
    <div class="body-wrapper" style="background-color: #F2F2F7;">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
            <li class="nav-item d-flex align-items-center">
              {{-- <a class="nav-link nav-hover fw-bolder fs-4" href="javascript:void(0)">
                Halaman @yield('title')
                <div class="notification bg-primary rounded-circle"></div>
              </a> --}}
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li class="d-flex h-100">
                <h5 class="fw-bold fs-3 text-center m-0">
                  Hi, {{Auth::user()->nama_admin}}
                </h5>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="{{asset('template/src/assets/images/profile/user-1.jpg')}}" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="{{route('admin.logout')}}" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->

      <div class="min-vh-100 container-fluid">
        @yield('page')
      </div>

      {{-- <div class="py-4 px-6 text-center bg-light w-100 position-absolute bottom-0">
        <p class="mb-0 fs-3">Aplikasi Enkripsi Dekripsi dengan MD5 by <a href="{{route('admin.dashboard')}}" target="_blank" class="pe-1 text-primary text-decoration-underline">Yoandika</a></p>
      </div> --}}
    </div>
  </div>

  <script src="{{asset('template/src/assets/libs/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('template/src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('template/src/assets/js/sidebarmenu.js')}}"></script>
  <script src="{{asset('template/src/assets/js/app.min.js')}}"></script>
  {{-- <script src="{{asset('template/src/assets/libs/apexcharts/dist/apexcharts.min.js')}}"></script> --}}
  {{-- <script src="{{asset('template/src/assets/libs/simplebar/dist/simplebar.js')}}"></script> --}}
  <script src="{{asset('template/src/assets/js/dashboard.js')}}"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js"></script>

  @yield('script')
</body>

</html>