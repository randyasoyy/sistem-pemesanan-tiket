<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TiketOnline</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>

<body>

    <div class="auth-wrapper">
        <div class="auth-box">

            <div class="auth-brand">
                <div class="logo"></div>
                <h1>TiketOnline</h1>
                <p>Masuk ke akun Anda</p>
            </div>

            <?= validation_errors('<div class="alert alert-danger">', '</div>') ?>

            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger"> <?= $this->session->flashdata('error') ?></div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('success')): ?>
                <div class="alert alert-success"> <?= $this->session->flashdata('success') ?></div>
            <?php endif; ?>

            <?= form_open('login') ?>
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control"
                    value="<?= set_value('email') ?>"
                    placeholder="nama@email.com" required autofocus>
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control"
                    placeholder="Masukkan password" required>
            </div>

            <button type="submit" class="btn btn-primary btn-block btn-lg">Login</button>
            <?= form_close() ?>

            <div class="auth-footer">
                Belum punya akun? <a href="<?= site_url('register') ?>">Daftar di sini</a>
            </div>

        </div>
    </div>

</body>

</html>