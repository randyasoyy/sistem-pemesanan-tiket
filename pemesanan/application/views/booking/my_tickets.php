<h3>Tiket Saya</h3>

<?php if (empty($transactions)): ?>
    <div class="alert alert-info">
        Anda belum punya tiket.
        <a href="<?= site_url('home') ?>">Pesan sekarang </a>
    </div>
<?php else: ?>
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Kode Booking</th>
                    <th>Event</th>
                    <th>Tanggal</th>
                    <th>Jml</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($transactions as $t): ?>
                <tr>
                    <td><code><?= $t->kode_booking ?></code></td>
                    <td>
                        <strong><?= htmlspecialchars($t->nama_event) ?></strong><br>
                        <small class="text-muted"><?= htmlspecialchars($t->lokasi) ?></small>
                    </td>
                    <td><?= date('d M Y, H:i', strtotime($t->tgl_event)) ?></td>
                    <td><?= $t->jumlah_tiket ?></td>
                    <td>Rp <?= number_format($t->total_harga, 0, ',', '.') ?></td>
                    <td>
                        <?php
                        $badge = [
                            'pending'   => 'warning',
                            'paid'      => 'success',
                            'cancelled' => 'danger',
                        ];
                        ?>
                        <span class="badge bg-<?= $badge[$t->status] ?? 'secondary' ?>">
                            <?= strtoupper($t->status) ?>
                        </span>
                    </td>
                    <td>
                        <?php if ($t->status === 'pending'): ?>
                            <a href="<?= site_url('payment/' . $t->id) ?>"
                               class="btn btn-sm btn-primary">Bayar</a>
                            <a href="<?= site_url('booking/cancel/' . $t->id) ?>"
                               class="btn btn-sm btn-outline-danger"
                               onclick="return confirm('Batalkan pesanan ini?')">Batal</a>
                        <?php elseif ($t->status === 'paid'): ?>
                            <a href="<?= site_url('payment/success/' . $t->id) ?>"
                               class="btn btn-sm btn-success">Lihat Tiket</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>