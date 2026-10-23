<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ITools System</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css" rel="stylesheet">
    
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
    
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;700&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
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
          <a class="nav-link <?= uri_string() == 'asetit' ? 'active text-white' : '' ?>" href="<?= site_url('asetit') ?>">
            <i class="bi bi-server me-1 text-info"></i> IT Assets
          </a>
        </li>
        <?php if(session()->get('username') == 'admin'): ?>
        <li class="nav-item ps-1">
          <a class="nav-link <?= uri_string() == 'user' ? 'active text-white' : '' ?>" href="<?= site_url('user') ?>">
            <i class="bi bi-people me-1 text-primary"></i> Users
          </a>
        </li>
        <?php endif; ?>
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