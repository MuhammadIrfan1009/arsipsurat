<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    
    <title>E-Komdigi</title>
    
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    
    <!-- Icons & Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    
    <!-- Helpers & Config -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- Custom CSS untuk gaya aktif -->
    <style>
        .menu-item.active .menu-link {
            background-color: #e0e7ff;
            color: #4f46e5;
        }
        .menu-item.active .menu-icon {
            color: #4f46e5;
        }
        .bg-label-baru {
    background-color: #007bff; /* Blue for "baru" */
}

.bg-label-diproses {
    background-color: #ffc107; /* Yellow for "diproses" */
}

.bg-label-selesai {
    background-color: #28a745; /* Green for "selesai" */
}

    </style>
</head>
<body>
    <div id="wrapper" class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Sidebar -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="#" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <!-- SVG Logo (dapat diisi sesuai kebutuhan) -->
                        </span>
                        <span class="app-brand-text demo menu-text fw-bolder ms-2">E-Komdigi</span>
                    </a>
                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <!-- Sidebar Menu -->
                <ul class="menu-inner py-1">
                    <!-- Dashboard -->
                    <li class="menu-item {{ request()->is('home') ? 'active' : '' }}">
                        <a href="{{ route('home') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div>Dashboard</div>
                        </a>
                    </li>

                    <!-- Surat Masuk -->
                    <li class="menu-item {{ request()->is('suratMasuk*') ? 'active' : '' }}">
                        <a href="{{ route('suratMasuk.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-envelope"></i>
                            <div>Surat Masuk</div>
                        </a>
                    </li>

                    <!-- Cek Akses (Admin Only) -->
                    @if (Auth::check() && Auth::user()->role == 'admin')
                    <li class="menu-item {{ Route::is('user_approval.index') ? 'active' : '' }}">
                        <a href="{{ route('user_approval.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-check-shield"></i>
                            <div>Cek Akses</div>
                        </a>
                    </li>

                    @endif


                   <!-- Logout -->
                <li class="menu-item">
                    <form id="logout-form" action="{{ route('auth.logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <!-- Using anchor tag instead of button -->
                        <a href="#" class="menu-link text-danger" onclick="document.getElementById('logout-form').submit();" style="text-decoration: none;">
                            <i class="menu-icon tf-icons bx bx-power-off"></i>
                            <div>Logout</div>
                        </a>
                    </form>
                </li>


                </ul>
            </aside>
            <!-- /Sidebar -->
            
            <div class="layout-page">
                <div class="container-fluid mt-4">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
</body>
</html>
