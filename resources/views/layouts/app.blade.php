<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SIMONTI') - Sistem Monitoring Internship</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --bg-primary: #f0f4f8;
            --bg-secondary: #ffffff;
            --bg-card: #ffffff;
            --bg-card-hover: #f8fafc;
            --bg-card-light: #e8f4fc;
            --border-color: #e2e8f0;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --text-muted: #94a3b8;
            --accent-blue: #1e3a5f;
            --accent-blue-light: #2d5a8e;
            --accent-purple: #7c3aed;
            --accent-pink: #ec4899;
            --accent-green: #16a34a;
            --accent-red: #dc2626;
            --accent-yellow: #d97706;
            --accent-cyan: #0891b2;
            --gradient-primary: linear-gradient(135deg, #1e3a5f, #2d5a8e);
            --gradient-sidebar: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.06);
            --shadow-md: 0 4px 12px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 10px 30px rgba(0, 0, 0, 0.1);
            --shadow-card: 0 2px 8px rgba(0, 0, 0, 0.06);
            --sidebar-width: 260px;
            --sidebar-collapsed: 72px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-primary);
            color: var(--text-primary);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            position: fixed; left: 0; top: 0; bottom: 0;
            width: var(--sidebar-width);
            background: var(--gradient-sidebar);
            border-right: 1px solid var(--border-color);
            z-index: 1000;
            transition: var(--transition);
            display: flex; flex-direction: column;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.04);
        }

        .sidebar-header {
            padding: 24px 20px;
            border-bottom: 1px solid var(--border-color);
            display: flex; align-items: center; gap: 12px;
        }

        .sidebar-logo {
            width: 38px; height: 38px;
            background: var(--gradient-primary);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-weight: 800; font-size: 14px; color: #ffffff;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(30, 58, 95, 0.25);
        }

        .sidebar-brand { overflow: hidden; transition: var(--transition); }
        .sidebar-brand h1 { font-size: 18px; font-weight: 700; letter-spacing: -0.5px; white-space: nowrap; color: var(--text-primary); }
        .sidebar-brand p { font-size: 11px; color: var(--text-muted); white-space: nowrap; margin-top: 2px; }

        .sidebar-nav { flex: 1; padding: 16px 12px; overflow-y: auto; }

        .nav-section { margin-bottom: 8px; }
        .nav-section-title {
            font-size: 10px; font-weight: 600; text-transform: uppercase;
            letter-spacing: 1.5px; color: var(--text-muted);
            padding: 8px 12px 6px; white-space: nowrap; overflow: hidden;
        }

        .nav-link {
            display: flex; align-items: center; gap: 12px;
            padding: 10px 12px; border-radius: 10px;
            color: var(--text-secondary); text-decoration: none;
            transition: var(--transition);
            font-size: 13.5px; font-weight: 500;
            margin-bottom: 2px; position: relative; overflow: hidden;
        }

        .nav-link:hover {
            background: var(--bg-card-light);
            color: var(--accent-blue);
            transform: translateX(3px);
        }

        .nav-link.active {
            background: var(--gradient-primary);
            color: white;
            box-shadow: 0 4px 12px rgba(30, 58, 95, 0.25);
        }

        .nav-link i {
            width: 20px; text-align: center;
            font-size: 15px; flex-shrink: 0;
        }

        .nav-link span { white-space: nowrap; overflow: hidden; transition: var(--transition); }

        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid var(--border-color);
        }

        .user-info {
            display: flex; align-items: center; gap: 10px;
            padding: 10px; border-radius: 10px;
            background: var(--bg-card-light);
        }

        .user-avatar {
            width: 36px; height: 36px;
            border-radius: 8px;
            background: var(--gradient-primary);
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 14px; flex-shrink: 0;
            color: #ffffff;
        }

        .user-details { overflow: hidden; }
        .user-name { font-size: 13px; font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; color: var(--text-primary); }
        .user-role { font-size: 11px; color: var(--text-muted); text-transform: capitalize; }

        /* ===== MAIN CONTENT ===== */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 24px 32px;
            min-height: 100vh;
            transition: var(--transition);
        }

        .topbar {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 28px;
        }

        .topbar h2 {
            font-size: 24px; font-weight: 700; letter-spacing: -0.5px;
            color: var(--text-primary);
        }

        .topbar-right { display: flex; align-items: center; gap: 12px; }

        .btn-logout {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 8px 16px; border-radius: 8px;
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: var(--accent-red);
            font-size: 13px; font-weight: 500;
            cursor: pointer; transition: var(--transition);
            text-decoration: none;
        }

        .btn-logout:hover {
            background: #fee2e2;
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(220, 38, 38, 0.15);
        }

        /* ===== CARDS ===== */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px; margin-bottom: 28px;
        }

        .stat-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 24px;
            transition: var(--transition);
            position: relative; overflow: hidden;
            box-shadow: var(--shadow-card);
        }

        .stat-card::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0;
            height: 3px;
            background: var(--gradient-primary);
            opacity: 0; transition: var(--transition);
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: #cbd5e1;
        }

        .stat-card:hover::before { opacity: 1; }

        .stat-icon {
            width: 48px; height: 48px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px; margin-bottom: 16px;
        }

        .stat-icon.blue { background: #e8f4fc; color: var(--accent-blue); }
        .stat-icon.green { background: #ecfdf5; color: var(--accent-green); }
        .stat-icon.purple { background: #f3e8ff; color: var(--accent-purple); }
        .stat-icon.pink { background: #fce7f3; color: var(--accent-pink); }
        .stat-icon.yellow { background: #fef3c7; color: var(--accent-yellow); }
        .stat-icon.cyan { background: #e0f7fa; color: var(--accent-cyan); }
        .stat-icon.red { background: #fef2f2; color: var(--accent-red); }

        .stat-value { font-size: 28px; font-weight: 800; margin-bottom: 4px; letter-spacing: -1px; color: var(--text-primary); }
        .stat-label { font-size: 13px; color: var(--text-secondary); font-weight: 500; }

        /* ===== TABLE ===== */
        .card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 24px;
            box-shadow: var(--shadow-card);
        }

        .card-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border-color);
            display: flex; justify-content: space-between; align-items: center;
            background: #fafbfc;
        }

        .card-header h3 { font-size: 16px; font-weight: 600; color: var(--text-primary); }

        .card-body { padding: 20px 24px; }

        .table-wrapper { overflow-x: auto; }

        table {
            width: 100%; border-collapse: collapse;
            font-size: 13.5px;
        }

        thead th {
            text-align: left; padding: 12px 16px;
            font-weight: 600; font-size: 12px;
            text-transform: uppercase; letter-spacing: 0.8px;
            color: var(--text-muted);
            border-bottom: 2px solid var(--border-color);
            white-space: nowrap;
            background: #fafbfc;
        }

        tbody td {
            padding: 14px 16px;
            border-bottom: 1px solid #f1f5f9;
            color: var(--text-secondary);
        }

        tbody tr {
            transition: var(--transition);
        }

        tbody tr:hover {
            background: #f8fafc;
        }

        tbody tr:last-child td { border-bottom: none; }

        /* ===== BADGES ===== */
        .badge {
            display: inline-flex; align-items: center; gap: 4px;
            padding: 4px 10px; border-radius: 6px;
            font-size: 11px; font-weight: 600;
            text-transform: uppercase; letter-spacing: 0.5px;
        }

        .badge-hadir { background: #ecfdf5; color: var(--accent-green); }
        .badge-sakit { background: #fef3c7; color: var(--accent-yellow); }
        .badge-izin { background: #e0f7fa; color: var(--accent-cyan); }
        .badge-alfa { background: #fef2f2; color: var(--accent-red); }
        .badge-pending { background: #fef3c7; color: var(--accent-yellow); }
        .badge-submitted { background: #ecfdf5; color: var(--accent-green); }
        .badge-graded { background: #e8f4fc; color: var(--accent-blue); }

        /* ===== BUTTONS ===== */
        .btn {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 10px 20px; border-radius: 10px;
            font-size: 13px; font-weight: 600;
            cursor: pointer; transition: var(--transition);
            text-decoration: none; border: none;
            font-family: 'Inter', sans-serif;
        }

        .btn:hover { transform: translateY(-2px); box-shadow: var(--shadow-md); }

        .btn-primary {
            background: var(--gradient-primary);
            color: white;
            box-shadow: 0 4px 12px rgba(30, 58, 95, 0.25);
        }

        .btn-primary:hover {
            box-shadow: 0 6px 18px rgba(30, 58, 95, 0.35);
        }

        .btn-success {
            background: linear-gradient(135deg, #16a34a, #15803d);
            color: white;
        }

        .btn-danger {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            color: white;
        }

        .btn-warning {
            background: linear-gradient(135deg, #d97706, #b45309);
            color: white;
        }

        .btn-sm {
            padding: 6px 12px; font-size: 12px; border-radius: 8px;
        }

        .btn-outline {
            background: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-secondary);
        }

        .btn-outline:hover {
            border-color: var(--accent-blue);
            color: var(--accent-blue);
            background: #e8f4fc;
        }

        .btn-icon {
            width: 34px; height: 34px; padding: 0;
            display: inline-flex; align-items: center; justify-content: center;
            border-radius: 8px; font-size: 13px;
        }

        /* ===== FORMS ===== */
        .form-group { margin-bottom: 20px; }

        .form-label {
            display: block; font-size: 13px; font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 6px;
        }

        .form-control {
            width: 100%; padding: 10px 14px;
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: 10px;
            color: var(--text-primary);
            font-size: 14px; font-family: 'Inter', sans-serif;
            transition: var(--transition);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--accent-blue);
            box-shadow: 0 0 0 3px rgba(30, 58, 95, 0.1);
        }

        .form-control::placeholder { color: var(--text-muted); }

        select.form-control {
            appearance: none;
            background-color: #ffffff;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%2394a3b8' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            padding-right: 36px;
        }

        textarea.form-control { resize: vertical; min-height: 100px; }

        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 16px;
        }

        .form-error {
            color: var(--accent-red);
            font-size: 12px; margin-top: 4px;
        }

        /* ===== ALERTS ===== */
        .alert {
            padding: 14px 18px; border-radius: 12px;
            margin-bottom: 20px; font-size: 13px;
            display: flex; align-items: center; gap: 10px;
            animation: slideDown 0.3s ease;
        }

        .alert-success {
            background: #ecfdf5;
            border: 1px solid #bbf7d0;
            color: var(--accent-green);
        }

        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: var(--accent-red);
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ===== PROGRESS BAR ===== */
        .progress-bar-bg {
            width: 100%; height: 8px;
            background: #e2e8f0;
            border-radius: 4px; overflow: hidden;
        }

        .progress-bar-fill {
            height: 100%; border-radius: 4px;
            background: var(--gradient-primary);
            transition: width 1s ease;
        }

        /* ===== PAGINATION ===== */
        .pagination {
            display: flex; gap: 6px;
            justify-content: center;
            padding: 16px 0;
            list-style: none;
        }

        .pagination a, .pagination span {
            padding: 8px 14px; border-radius: 8px;
            font-size: 13px; font-weight: 500;
            text-decoration: none; transition: var(--transition);
            color: var(--text-secondary);
            border: 1px solid var(--border-color);
            background: #ffffff;
        }

        .pagination .active span {
            background: var(--gradient-primary);
            color: white; border-color: transparent;
        }

        .pagination a:hover {
            background: var(--bg-card-light);
            border-color: var(--accent-blue);
            color: var(--accent-blue);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .main-content { margin-left: 0; padding: 16px; }
            .stat-grid { grid-template-columns: 1fr 1fr; }
            .form-row { grid-template-columns: 1fr; }
            .topbar { flex-direction: column; gap: 12px; align-items: flex-start; }
        }

        .mobile-toggle {
            display: none;
            background: #ffffff;
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            padding: 10px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            box-shadow: var(--shadow-sm);
        }

        @media (max-width: 768px) {
            .mobile-toggle { display: block; }
        }

        .overlay {
            display: none; position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.3); z-index: 999;
        }

        .overlay.active { display: block; }

        /* ===== CLOCK BUTTON ===== */
        .clock-btn {
            padding: 20px 40px;
            border-radius: 16px;
            font-size: 18px; font-weight: 700;
            cursor: pointer; border: none;
            font-family: 'Inter', sans-serif;
            transition: var(--transition);
            display: inline-flex; align-items: center; gap: 12px;
        }

        .clock-in {
            background: linear-gradient(135deg, #16a34a, #15803d);
            color: white;
            box-shadow: 0 4px 16px rgba(22, 163, 74, 0.25);
        }

        .clock-in:hover { box-shadow: 0 6px 20px rgba(22, 163, 74, 0.35); transform: translateY(-3px); }

        .clock-out {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            color: white;
            box-shadow: 0 4px 16px rgba(220, 38, 38, 0.25);
        }

        .clock-out:hover { box-shadow: 0 6px 20px rgba(220, 38, 38, 0.35); transform: translateY(-3px); }

        .clock-disabled {
            background: #f1f5f9;
            color: var(--text-muted);
            cursor: not-allowed;
            border: 1px solid var(--border-color);
        }

        /* ===== FILE UPLOAD ===== */
        .file-upload {
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            transition: var(--transition);
            cursor: pointer;
            background: #fafbfc;
        }

        .file-upload:hover {
            border-color: var(--accent-blue);
            background: #e8f4fc;
        }

        .file-upload input[type="file"] { display: none; }

        .file-upload-label {
            cursor: pointer;
            display: flex; flex-direction: column;
            align-items: center; gap: 8px;
        }

        .file-upload-icon { font-size: 32px; color: var(--text-muted); }
        .file-upload-text { font-size: 13px; color: var(--text-secondary); }
        .file-name-display { font-size: 13px; color: var(--accent-blue); margin-top: 8px; font-weight: 500; }

        /* Actions */
        .actions { display: flex; gap: 6px; }
        .text-center { text-align: center; }
        .mt-3 { margin-top: 12px; }
        .mt-4 { margin-top: 16px; }
        .mb-3 { margin-bottom: 12px; }
        .mb-4 { margin-bottom: 16px; }
        .d-flex { display: flex; }
        .gap-2 { gap: 8px; }
        .gap-3 { gap: 12px; }
        .justify-between { justify-content: space-between; }
        .items-center { align-items: center; }
        .flex-wrap { flex-wrap: wrap; }

        .empty-state {
            text-align: center; padding: 48px 20px;
            color: var(--text-muted);
        }
        .empty-state i { font-size: 48px; margin-bottom: 16px; display: block; }
        .empty-state p { font-size: 14px; }
    </style>
</head>
<body>
    @auth
    <!-- Sidebar -->
    <div class="overlay" id="overlay" onclick="toggleSidebar()"></div>
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">SM</div>
            <div class="sidebar-brand">
                <h1>SIMONTI</h1>
                <p>Monitoring Internship</p>
            </div>
        </div>

        <nav class="sidebar-nav">
            @if(auth()->user()->isAdmin())
            <div class="nav-section">
                <div class="nav-section-title">Menu Admin</div>
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-th-large"></i><span>Dashboard</span>
                </a>
                <a href="{{ route('admin.pembimbing.index') }}" class="nav-link {{ request()->routeIs('admin.pembimbing.*') ? 'active' : '' }}">
                    <i class="fas fa-user-tie"></i><span>Kelola Pembimbing</span>
                </a>
            </div>
            @endif

            @if(auth()->user()->isPembimbing())
            <div class="nav-section">
                <div class="nav-section-title">Menu Pembimbing</div>
                <a href="{{ route('pembimbing.dashboard') }}" class="nav-link {{ request()->routeIs('pembimbing.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-th-large"></i><span>Dashboard</span>
                </a>
                <a href="{{ route('pembimbing.peserta.index') }}" class="nav-link {{ request()->routeIs('pembimbing.peserta.*') ? 'active' : '' }}">
                    <i class="fas fa-user-graduate"></i><span>Kelola Peserta</span>
                </a>
                <a href="{{ route('pembimbing.absensi.index') }}" class="nav-link {{ request()->routeIs('pembimbing.absensi.*') ? 'active' : '' }}">
                    <i class="fas fa-clipboard-check"></i><span>Absensi Peserta</span>
                </a>
                <a href="{{ route('pembimbing.tugas.index') }}" class="nav-link {{ request()->routeIs('pembimbing.tugas.*') ? 'active' : '' }}">
                    <i class="fas fa-tasks"></i><span>Kelola Tugas</span>
                </a>
                <a href="{{ route('pembimbing.rekap.index') }}" class="nav-link {{ request()->routeIs('pembimbing.rekap.*') ? 'active' : '' }}">
                    <i class="fas fa-chart-bar"></i><span>Rekap & Nilai</span>
                </a>
            </div>
            @endif

            @if(auth()->user()->isPeserta())
            <div class="nav-section">
                <div class="nav-section-title">Menu Peserta</div>
                <a href="{{ route('peserta.dashboard') }}" class="nav-link {{ request()->routeIs('peserta.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-th-large"></i><span>Dashboard</span>
                </a>
                <a href="{{ route('peserta.absensi.index') }}" class="nav-link {{ request()->routeIs('peserta.absensi.*') ? 'active' : '' }}">
                    <i class="fas fa-clock"></i><span>Absensi</span>
                </a>
                <a href="{{ route('peserta.tugas.index') }}" class="nav-link {{ request()->routeIs('peserta.tugas.*') ? 'active' : '' }}">
                    <i class="fas fa-book"></i><span>Tugas Saya</span>
                </a>
                <a href="{{ route('peserta.profil.ubahPassword') }}" class="nav-link {{ request()->routeIs('peserta.profil.*') ? 'active' : '' }}">
                    <i class="fas fa-key"></i><span>Ubah Password</span>
                </a>
            </div>
            @endif
        </nav>

        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">{{ strtoupper(substr(auth()->user()->nama, 0, 2)) }}</div>
                <div class="user-details">
                    <div class="user-name">{{ auth()->user()->nama }}</div>
                    <div class="user-role">{{ auth()->user()->role }}</div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <div class="topbar">
            <div class="d-flex items-center gap-3">
                <button class="mobile-toggle" onclick="toggleSidebar()">
                    <i class="fas fa-bars"></i>
                </button>
                <h2>@yield('page-title', 'Dashboard')</h2>
            </div>
            <div class="topbar-right">
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
        @endif

        @yield('content')
    </main>
    @endauth

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('overlay').classList.toggle('active');
        }

        // File upload preview
        document.querySelectorAll('.file-upload input[type="file"]').forEach(input => {
            input.addEventListener('change', function() {
                const display = this.closest('.file-upload').querySelector('.file-name-display');
                if (display && this.files[0]) {
                    display.textContent = this.files[0].name;
                }
            });
        });

        // Auto-hide alerts
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(-10px)';
                setTimeout(() => el.remove(), 300);
            });
        }, 5000);
    </script>
</body>
</html>
