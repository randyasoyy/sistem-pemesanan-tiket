<div class="d-flex-between mb-3">
    <h3 class="section-title mb-0"> Kelola Event</h3>
    <a href="<?= site_url('admin/events/create') ?>" class="btn btn-success">
         Tambah Event
    </a>
</div>

<div class="filter-buttons mb-3">
    <a href="<?= site_url('admin/events') ?>"
       class="btn btn-sm <?= empty($kategori_aktif) ? 'btn-primary' : 'btn-light' ?>">Semua</a>
    <a href="<?= site_url('admin/events?kategori=konser') ?>"
       class="btn btn-sm <?= ($kategori_aktif ?? '') === 'konser' ? 'btn-primary' : 'btn-light' ?>"> Konser</a>
    <a href="<?= site_url('admin/events?kategori=bioskop') ?>"
       class="btn btn-sm <?= ($kategori_aktif ?? '') === 'bioskop' ? 'btn-primary' : 'btn-light' ?>"> Bioskop</a>
    <a href="<?= site_url('admin/events?kategori=transportasi') ?>"
       class="btn btn-sm <?= ($kategori_aktif ?? '') === 'transportasi' ? 'btn-primary' : 'btn-light' ?>"> Transportasi</a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Event</th>
                    <th>Kategori</th>
                    <th>Tanggal</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($events)): ?>
                <tr><td colspan="7" class="text-center text-muted" style="padding: 40px;">Belum ada event</td></tr>
            <?php else: ?>
                <?php foreach ($events as $e): ?>
                    <?php
                        $badge = $e->kategori === 'konser' ? 'badge-danger'
                               : ($e->kategori === 'bioskop' ? 'badge-primary' : 'badge-success');
                    ?>
                    <tr>
                        <td>#<?= $e->id ?></td>
                        <td><strong><?= htmlspecialchars($e->nama_event) ?></strong><br>
                            <small class="text-muted"> <?= htmlspecialchars($e->lokasi) ?></small></td>
                        <td><span class="badge <?= $badge ?>"><?= ucfirst($e->kategori) ?></span></td>
                        <td><?= date('d M Y', strtotime($e->tanggal)) ?></td>
                        <td>Rp <?= number_format($e->harga, 0, ',', '.') ?></td>
                        <td><?= $e->stok ?></td>
                        <td>
                            <a href="<?= site_url('admin/events/edit/' . $e->id) ?>" class="btn btn-sm btn-warning"></a>
                            <a href="<?= site_url('admin/events/delete/' . $e->id) ?>" class="btn btn-sm btn-danger"
                               data-confirm="Hapus event ini?"></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>