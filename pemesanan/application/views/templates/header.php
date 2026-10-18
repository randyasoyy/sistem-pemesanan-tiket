<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Sistem Tiket Online' ?></title>

    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>
<body>

<?php
$ci =& get_instance();
$is_auth_page = ($ci->router->fetch_class() === 'auth');
?>

<?php if (!$is_auth_page): ?>
<nav class="navbar">
    <div class="navbar-inner">
        <a class="navbar-brand" href="<?= base_url() ?>"> TiketOnline</a>

        <div class="navbar-menu">
            <?php if (is_logged_in() && is_admin()): ?>
                <a href="<?= site_url('admin') ?>"> Dashboard</a>
                <a href="<?= site_url('admin/events') ?>"> Event</a>
                <a href="<?= site_url('admin/users') ?>"> User</a>
                <a href="<?= site_url('admin/transactions') ?>"> Transaksi</a>
            <?php elseif (is_logged_in() && is_user()): ?>
                <a href="<?= site_url('home') ?>"> Beranda</a>
                <a href="<?= site_url('my-tickets') ?>"> Tiket Saya</a>
            <?php else: ?>
                <a href="<?= site_url('login') ?>">Login</a>
                <a href="<?= site_url('register') ?>" class="btn-daftar">Daftar</a>
            <?php endif; ?>

            <?php if (is_logged_in()): ?>
                <a href="<?= site_url('logout') ?>" class="logout">
                     Logout (<?= $this->session->userdata('nama') ?>)
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="container">
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success"> <?= $this->session->flashdata('success') ?></div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('info')): ?>
        <div class="alert alert-info"><?= $this->session->flashdata('info') ?></div>
    <?php endif; ?>
<?php endif; ?>