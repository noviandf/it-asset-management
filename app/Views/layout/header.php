<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITools System</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;700&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-dark: #0f172a;       /* Background Utama Gelap */
            --card-dark: #1e293b;     /* Warna Kartu */
            --text-main: #e2e8f0;     /* Warna Teks Utama */
            --text-muted-custom: #cbd5e1; /* Warna Teks Deskripsi (Terang) */
            
            --accent-blue: #3b82f6;
            --accent-purple: #8b5cf6;
            --border-color: #334155;
        }

        body {
            background-color: var(--bg-dark);
            color: var(--text-main);
            font-family: 'Inter', sans-serif;
        }

        .text-muted {
            color: var(--text-muted-custom) !important; 
            opacity: 0.8;
        }
        .text-white-50 {
            color: rgba(255, 255, 255, 0.75) !important;
        }

        /* Navbar Custom */
        .navbar-custom {
            background-color: var(--card-dark) !important;
            border-bottom: 1px solid var(--border-color);
            box-shadow: 0 4px 20px rgba(0,0,0,0.4);
        }
        .navbar-brand {
            font-family: 'JetBrains Mono', monospace;
            font-weight: 700;
            color: var(--accent-blue) !important;
            letter-spacing: -1px;
        }
        .nav-link {
            color: var(--text-muted-custom) !important;
            transition: 0.3s;
        }
        .nav-link:hover, .nav-link.active {
            color: #fff !important;
            text-shadow: 0 0 10px rgba(255,255,255,0.3);
        }

        /* Card Style */
        .card-custom {
            background-color: var(--card-dark);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.3);
        }
        .card-header-custom {
            background: rgba(15, 23, 42, 0.5);
            border-bottom: 1px solid var(--border-color);
            padding: 1.5rem;
        }

        /* --- PERBAIKAN UTAMA TABEL (ANTI PUTIH) --- */
        .table-dark-custom {
            --bs-table-bg: transparent; 
            background-color: transparent !important; /* Paksa Transparan */
            color: var(--text-main) !important;
            border-color: var(--border-color);
        }
        
        /* Paksa semua sel (td) dan header (th) menjadi transparan backgroundnya */
        .table-dark-custom th, 
        .table-dark-custom td {
            background-color: transparent !important; 
            color: var(--text-main);
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
        }

        /* Style khusus Header Tabel */
        .table-dark-custom thead th {
            background-color: rgba(15, 23, 42, 0.8) !important; /* Gelap semi-transparan */
            color: var(--accent-blue) !important;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            border-bottom: 2px solid var(--border-color);
        }

        /* Efek Hover (Saat kursor diarahkan ke baris) */
        .table-hover tbody tr:hover td {
            background-color: rgba(59, 130, 246, 0.1) !important; /* Biru tipis */
            color: #fff !important;
            transition: background-color 0.2s;
        }
        /* ------------------------------------------ */
        
        /* Tombol Neon */
        .btn-neon {
            background: linear-gradient(135deg, var(--accent-blue), var(--accent-purple));
            border: none;
            color: white;
            box-shadow: 0 0 10px rgba(59, 130, 246, 0.3);
        }
        .btn-neon:hover {
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.6);
            color: white;
        }
        
        /* Form Label Fix */
        .form-label.text-muted {
            color: var(--text-muted-custom) !important;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom mb-4 py-3">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="<?= site_url('/dashboard') ?>">
        <span class="bg-primary bg-opacity-25 text-primary rounded p-1 me-2 border border-primary border-opacity-25">
            <i class="bi bi-display"></i>
        </span>
        <span style="letter-spacing: -0.5px;">ITools<span class="text-white-50">_Mon</span></span>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarContent">
      <?php if (session()->get('isLoggedIn')): ?>
      
      <ul class="navbar-nav ms-4 mb-2 mb-lg-0 gap-1">
        <li class="nav-item">
          <a class="nav-link <?= uri_string() == 'catatanit' ? 'active text-white' : '' ?>" href="<?= site_url('catatanit') ?>">
            <i class="bi bi-activity me-1 text-success"></i> Data PC
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= uri_string() == 'catatankerusakan' ? 'active text-white' : '' ?>" href="<?= site_url('catatankerusakan') ?>">
            <i class="bi bi-exclamation-octagon me-1 text-danger"></i> Issues & Fix
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= uri_string() == 'catatanplanning' ? 'active text-white' : '' ?>" href="<?= site_url('catatanplanning') ?>">
            <i class="bi bi-calendar-week me-1 text-warning"></i> Planning
          </a>
        </li>
        <li class="nav-item border-start border-secondary ps-3 ms-2">
          <a class="nav-link <?= uri_string() == 'barang' ? 'active text-white' : '' ?>" href="<?= site_url('barang') ?>">
            <i class="bi bi-server me-1 text-info"></i> IT Assets
          </a>
        </li>
      </ul>

      <div class="navbar-nav ms-auto align-items-center">
          <span class="text-white me-3 small">Hi, <?= session()->get('username') ?></span>
          <a href="<?= site_url('/logout') ?>" class="btn btn-outline-danger btn-sm rounded-pill px-3">
            <i class="bi bi-power"></i>
          </a>
      </div>

      <?php endif; ?>
    </div>
  </div>
</nav>

<div class="container pb-5">
    <?php if(session()->getFlashdata('success')): ?>
        <div class="alert alert-success bg-opacity-25 border-success text-success d-flex align-items-center mb-4">
            <i class="bi bi-check-circle-fill me-2"></i> <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if(session()->getFlashdata('error')): ?>
        <div class="alert alert-danger bg-opacity-25 border-danger text-danger d-flex align-items-center mb-4">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>