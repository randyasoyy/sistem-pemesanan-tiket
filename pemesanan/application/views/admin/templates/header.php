<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($page_title) ? $page_title : 'Admin' ?> — TiketOnline</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body>


<aside class="admin-sidebar" id="sidebar">
    <div class="brand">
        <span></span>
        <span>TiketOnline</span>
        <span class="badge-admin">ADMIN</span>
    </div>

    <nav class="menu">
        <div class="menu-label">Menu Utama</div>
        <a href="<?= site_url('admin') ?>"
           class="menu-item <?= $this->uri->segment(2) == '' || $this->uri->segment(2) == 'dashboard' ? 'active' : '' ?>">
             Dashboard
        </a>

        <div class="menu-label">Manajemen</div>
        <a href="<?= site_url('admin/events') ?>"
           class="menu-item <?= $this->uri->segment(2) == 'events' ? 'active' : '' ?>">
             Kelola Event
        </a>
        <a href="<?= site_url('admin/users') ?>"
           class="menu-item <?= $this->uri->segment(2) == 'users' ? 'active' : '' ?>">
             Kelola User
        </a>
        <a href="<?= site_url('admin/transactions') ?>"
           class="menu-item <?= $this->uri->segment(2) == 'transactions' ? 'active' : '' ?>">
             Transaksi
        </a>

        <div class="menu-label">Lainnya</div>
        <a href="<?= site_url('home') ?>" class="menu-item" target="_blank">
             Lihat Situs
        </a>
        <a href="<?= site_url('logout') ?>" class="menu-item logout">
             Logout
        </a>
    </nav>

    <div class="sidebar-footer">
        <small>© <?= date('Y') ?> TiketOnline<br>v1.0 MVP</small>
    </div>
</aside>


<div class="admin-main">

    <header class="admin-topbar">
        <div class="d-flex gap-2 align-center">
            <button class="sidebar-toggle" onclick="document.getElementById('sidebar').classList.toggle('show')">
                
            </button>
            <h1 class="page-title"><?= isset($page_title) ? $page_title : 'Dashboard' ?></h1>
        </div>

        <div class="user-info">
            <div class="text-right">
                <div class="fw-bold small"><?= $this->session->userdata('nama') ?></div>
                <div class="text-muted" style="font-size: 12px;">Administrator</div>
            </div>
            <div class="avatar">
                <?= strtoupper(substr($this->session->userdata('nama'), 0, 1)) ?>
            </div>
        </div>
    </header>

    <main class="admin-content">
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success"> <?= $this->session->flashdata('success') ?></div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger"> <?= $this->session->flashdata('error') ?></div>
        <?php endif; ?>