<h3 class="section-title mb-3"> Transaksi</h3>

<div class="filter-buttons mb-3">
    <a href="<?= site_url('admin/transactions') ?>"
       class="btn btn-sm <?= empty($status_aktif) ? 'btn-primary' : 'btn-light' ?>">Semua</a>
    <a href="<?= site_url('admin/transactions?status=pending') ?>"
       class="btn btn-sm <?= ($status_aktif ?? '') === 'pending' ? 'btn-warning' : 'btn-light' ?>">Pending</a>
    <a href="<?= site_url('admin/transactions?status=paid') ?>"
       class="btn btn-sm <?= ($status_aktif ?? '') === 'paid' ? 'btn-success' : 'btn-light' ?>">Paid</a>
    <a href="<?= site_url('admin/transactions?status=cancelled') ?>"
       class="btn btn-sm <?= ($status_aktif ?? '') === 'cancelled' ? 'btn-danger' : 'btn-light' ?>">Cancelled</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Kode</th><th>User</th><th>Event</th>
                    <th>Qty</th><th>Total</th><th>Status</th><th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($transactions)): ?>
                <tr><td colspan="7" class="text-center text-muted" style="padding: 40px;">Belum ada transaksi</td></tr>
            <?php else: ?>
                <?php foreach ($transactions as $t): ?>
                    <?php
                        $badge = ['pending' => 'badge-warning', 'paid' => 'badge-success', 'cancelled' => 'badge-danger'][$t->status] ?? 'badge-secondary';
                    ?>
                    <tr>
                        <td><code><?= $t->kode_booking ?></code></td>
                        <td><?= htmlspecialchars($t->user_nama) ?></td>
                        <td><?= htmlspecialchars($t->nama_event) ?></td>
                        <td><?= $t->jumlah_tiket ?></td>
                        <td class="fw-bold">Rp <?= number_format($t->total_harga, 0, ',', '.') ?></td>
                        <td><span class="badge <?= $badge ?>"><?= strtoupper($t->status) ?></span></td>
                        <td>
                            <?php if ($t->status === 'pending'): ?>
                                <a href="<?= site_url('admin/transactions/cancel/' . $t->id) ?>"
                                   class="btn btn-sm btn-danger" data-confirm="Batalkan transaksi?">❌</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>