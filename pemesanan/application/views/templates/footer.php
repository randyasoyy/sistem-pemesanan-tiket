<?php

$ci =& get_instance();
$is_auth_page = ($ci->router->fetch_class() === 'auth');
?>

<?php if (!$is_auth_page): ?>
</div>

<footer class="footer">
    <small> <?= date('Y') ?> TiketOnline — MVP Sistem Pemesanan Tiket</small>
</footer>
<?php endif; ?>

<script src="<?= base_url('assets/js/main.js') ?>"></script>
</body>
</html>