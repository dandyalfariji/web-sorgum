<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Sorgumology</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom Admin Aesthetics -->
    <style>
        :root {
            --admin-primary: #059669;
            --admin-primary-hover: #047857;
            --admin-dark-bg: #064e3b;
            --admin-sidebar-bg: #022c22;
            --admin-sidebar-hover: #064e3b;
            --admin-card-bg: #ffffff;
            --admin-body-bg: #f1f5f9;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--admin-body-bg);
            color: #334155;
            min-height: 100vh;
        }

        .sidebar {
            width: 260px;
            min-height: calc(100vh - 60px);
            background-color: var(--admin-sidebar-bg);
            transition: all 0.3s ease;
        }

        .sidebar .nav-link {
            color: #94a3b8;
            padding: 0.75rem 1.25rem;
            margin: 0.2rem 0.75rem;
            border-radius: 0.5rem;
            font-weight: 500;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            transition: all 0.2s ease-in-out;
        }

        .sidebar .nav-link:hover {
            background-color: var(--admin-sidebar-hover);
            color: #f8fafc;
            transform: translateX(3px);
        }

        .sidebar .nav-link.active {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #ffffff !important;
            box-shadow: 0 4px 12px rgba(5, 150, 105, 0.35);
        }

        .sidebar .nav-link i {
            font-size: 1.15rem;
            margin-right: 0.75rem;
            width: 22px;
            text-align: center;
        }

        .sidebar-heading {
            color: #64748b;
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            padding: 1.25rem 1.5rem 0.5rem 1.5rem;
            text-transform: uppercase;
        }

        .navbar-custom {
            background-color: #ffffff;
            height: 60px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .navbar-brand-custom {
            width: 260px;
            background-color: var(--admin-dark-bg);
            height: 60px;
            display: flex;
            align-items: center;
            padding-left: 1.5rem;
            color: #ffffff;
            font-weight: 700;
            letter-spacing: -0.02em;
        }

        .main-content {
            flex-grow: 1;
            padding: 1.75rem;
            overflow-y: auto;
            width: calc(100% - 260px);
        }

        .card {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.05), 0 1px 2px 0 rgba(0, 0, 0, 0.03);
            transition: all 0.2s ease;
        }

        .btn-primary {
            background-color: var(--admin-primary);
            border-color: var(--admin-primary);
            box-shadow: 0 2px 4px rgba(5, 150, 105, 0.2);
        }

        .btn-primary:hover {
            background-color: var(--admin-primary-hover);
            border-color: var(--admin-primary-hover);
        }

        .badge {
            padding: 0.4em 0.75em;
            font-weight: 600;
            font-size: 0.75rem;
            border-radius: 0.375rem;
        }

        /* Improved Table Aesthetics */
        .table-hover tbody tr:hover {
            background-color: #ecfdf5 !important;
            transition: background-color 0.2s ease;
        }
        .table img {
            border-radius: 0.5rem;
            object-fit: cover;
            border: 1px solid #e2e8f0;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                width: 100%;
                min-height: auto;
            }
            .main-content {
                width: 100%;
            }
            .navbar-brand-custom {
                width: auto;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom sticky-top p-0">
        <div class="container-fluid p-0">
            <a class="navbar-brand-custom text-decoration-none" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-shield-lock-fill me-2 fs-5" style="color: #6ee7b7;"></i>
                <span>Sorgumology Admin</span>
            </a>
            
            <button class="navbar-toggler me-3" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="d-none d-lg-flex ms-auto pe-4 align-items-center">
                <a href="{{ url('/') }}" target="_blank" class="btn btn-sm btn-light border me-3 text-secondary">
                    <i class="bi bi-globe me-1"></i> Lihat Website
                </a>
                <div class="dropdown">
                    <button class="btn btn-sm btn-light border dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown">
                        <div class="text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 28px; height: 28px; background-color: var(--admin-primary);">
                            <i class="bi bi-person-fill small"></i>
                        </div>
                        <span class="fw-semibold small">{{ auth()->user()->name ?? 'Administrator' }}</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger small">
                                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- App Wrapper -->
    <div class="d-flex flex-column flex-lg-row" style="min-height: calc(100vh - 60px);">
        
        <!-- Sidebar Navigation -->
        <aside class="sidebar collapse d-lg-block" id="sidebarMenu">
            <div class="py-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-grid-1x2-fill"></i> Dashboard
                        </a>
                    </li>

                    <div class="sidebar-heading">Konten Utama (CMS)</div>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}" href="{{ route('admin.articles.index') }}">
                            <i class="bi bi-file-earmark-text-fill"></i> Artikel / News
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}" href="{{ route('admin.products.index') }}">
                            <i class="bi bi-bag-check-fill"></i> Produk Marketplace
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.company-pages.*') ? 'active' : '' }}" href="{{ route('admin.company-pages.index') }}">
                            <i class="bi bi-building"></i> Halaman Perusahaan
                        </a>
                    </li>

                    <div class="sidebar-heading">Komponen Homepage</div>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.hero-sections.*') ? 'active' : '' }}" href="{{ route('admin.hero-sections.index') }}">
                            <i class="bi bi-badge-ad-fill"></i> Hero Banners & CTA
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.features.*') ? 'active' : '' }}" href="{{ route('admin.features.index') }}">
                            <i class="bi bi-stars"></i> Fitur Keunggulan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.team-members.*') ? 'active' : '' }}" href="{{ route('admin.team-members.index') }}">
                            <i class="bi bi-people-fill"></i> Anggota Tim
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.partners.*') ? 'active' : '' }}" href="{{ route('admin.partners.index') }}">
                            <i class="bi bi-handbag-fill"></i> Mitra / Partner
                        </a>
                    </li>

                    <div class="sidebar-heading">Layout & Navigasi</div>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.headers.*') ? 'active' : '' }}" href="{{ route('admin.headers.index') }}">
                            <i class="bi bi-menu-button-wide-fill"></i> Header Navigation
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.footers.*') ? 'active' : '' }}" href="{{ route('admin.footers.index') }}">
                            <i class="bi bi-layout-sidebar-reverse"></i> Footer Settings
                        </a>
                    </li>
                </ul>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="main-content">
            <div class="container-fluid pb-4 p-0">
                
                <!-- Page Header & Action Buttons -->
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mb-4">
                    <div>
                        <h3 class="fw-bold mb-1">@yield('title', 'Dashboard')</h3>
                        <p class="text-muted small mb-0">Kelola data dan konten aplikasi Sorgumology dengan cepat.</p>
                    </div>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        @yield('header_action')
                    </div>
                </div>

                <!-- Alert Messages -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                            <div>{{ session('success') }}</div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
                            <div>{{ session('error') }}</div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Yield Content -->
                @yield('content')

            </div>
        </main>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
</body>
</html>
