<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - TiketOnline</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
</head>

<body>

    <div class="auth-wrapper auth-register">
        <div class="auth-box" style="max-width: 500px;">

            <div class="auth-brand">
                <div class="logo"></div>
                <h1>Buat Akun Baru</h1>
                <p>Pilih tipe akun yang sesuai</p>
            </div>

            <?= validation_errors('<div class="alert alert-danger">', '</div>') ?>

            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger"> <?= $this->session->flashdata('error') ?></div>
            <?php endif; ?>

            <?= form_open('register') ?>

          
            <div class="form-group">
                <label class="form-label fw-bold">Daftar Sebagai <span class="text-danger">*</span></label>

                <div class="role-picker">
                    <label class="role-card" data-role="user">
                        <input type="radio" name="role" value="user"
                            class="role-radio"
                            <?= set_value('role', 'user') === 'user' ? 'checked' : '' ?> required>
                        <div class="role-icon"></div>
                        <div class="role-name">User</div>
                        <div class="role-desc">Pesan tiket</div>
                    </label>

                    <label class="role-card" data-role="admin">
                        <input type="radio" name="role" value="admin"
                            class="role-radio"
                            <?= set_value('role') === 'admin' ? 'checked' : '' ?>>
                        <div class="role-icon"></div>
                        <div class="role-name">Admin</div>
                        <div class="role-desc">Kelola sistem</div>
                    </label>
                </div>
            </div>

           
            <div class="form-group admin-code-field" id="adminCodeField">
                <label class="form-label"> Kode Rahasia Admin <span class="text-danger">*</span></label>
                <input type="text" name="admin_code" class="form-control"
                    value="<?= set_value('admin_code') ?>"
                    placeholder="Masukkan kode dari administrator">
                <div class="form-hint"> Kode diperlukan untuk mencegah pendaftaran admin sembarangan.</div>
            </div>

            <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control"
                    value="<?= set_value('nama') ?>"
                    placeholder="Contoh: Budi Santoso" required autofocus>
            </div>

            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control"
                    value="<?= set_value('email') ?>"
                    placeholder="nama@email.com" required>
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control"
                    placeholder="Minimal 6 karakter" required>
            </div>

            <div class="form-group">
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirm" class="form-control"
                    placeholder="Ulangi password" required>
            </div>

            <button type="submit" class="btn btn-success btn-block btn-lg">
                Daftar Sekarang
            </button>

            <?= form_close() ?>

            <div class="auth-footer">
                Sudah punya akun? <a href="<?= site_url('login') ?>">Login di sini</a>
            </div>

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleCards = document.querySelectorAll('.role-card');
            const adminField = document.getElementById('adminCodeField');
            const adminInput = document.querySelector('input[name="admin_code"]');

            function updateAdminField(role) {
                if (role === 'admin') {
                    adminField.style.display = 'block';
                    if (adminInput) adminInput.required = true;
                } else {
                    adminField.style.display = 'none';
                    if (adminInput) {
                        adminInput.required = false;
                        adminInput.value = '';
                    }
                }
            }

            roleCards.forEach(function(card) {
                card.addEventListener('click', function() {
                    const radio = card.querySelector('.role-radio');
                    radio.checked = true;
                    roleCards.forEach(function(c) {
                        c.classList.toggle('selected', c === card);
                    });
                    updateAdminField(radio.value);
                });
            });

            let current = 'user';
            document.querySelectorAll('.role-radio').forEach(function(r) {
                if (r.checked) current = r.value;
            });
            updateAdminField(current);
            roleCards.forEach(function(c) {
                c.classList.toggle('selected', c.dataset.role === current);
            });
        });
    </script>

</body>

</html>