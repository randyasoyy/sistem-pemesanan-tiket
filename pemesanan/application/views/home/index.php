<div class="filter-bar">
    <h3> Event Tersedia</h3>
    <div class="filter-buttons">
        <a href="<?= site_url('home') ?>"
           class="btn btn-sm <?= empty($kategori_aktif) ? 'btn-primary' : 'btn-light' ?>">Semua</a>
        <a href="<?= site_url('home?kategori=konser') ?>"
           class="btn btn-sm <?= $kategori_aktif === 'konser' ? 'btn-primary' : 'btn-light' ?>"> Konser</a>
        <a href="<?= site_url('home?kategori=bioskop') ?>"
           class="btn btn-sm <?= $kategori_aktif === 'bioskop' ? 'btn-primary' : 'btn-light' ?>">Bioskop</a>
        <a href="<?= site_url('home?kategori=transportasi') ?>"
           class="btn btn-sm <?= $kategori_aktif === 'transportasi' ? 'btn-primary' : 'btn-light' ?>"> Transportasi</a>
    </div>
</div>

<?php if (empty($events)): ?>
    <div class="alert alert-warning">Belum ada event tersedia saat ini.</div>
<?php else: ?>
    <div class="card-grid">
        <?php foreach ($events as $e): ?>
            <?php
                $badge = $e->kategori === 'konser' ? 'badge-danger'
                       : ($e->kategori === 'bioskop' ? 'badge-primary' : 'badge-success');
                $icon  = $e->kategori === 'konser' ? ''
                       : ($e->kategori === 'bioskop' ? '' : '');
            ?>
            <div class="event-card">
                <div class="event-card-body">
                    <span class="badge <?= $badge ?>"><?= $icon ?> <?= ucfirst($e->kategori) ?></span>

                    <h5><?= htmlspecialchars($e->nama_event) ?></h5>

                    <?php if ($e->kategori === 'konser' && !empty($e->artis)): ?>
                        <p class="meta"> <?= htmlspecialchars($e->artis) ?></p>
                    <?php elseif ($e->kategori === 'bioskop' && !empty($e->studio)): ?>
                        <p class="meta"> <?= htmlspecialchars($e->studio) ?></p>
                    <?php elseif ($e->kategori === 'transportasi' && !empty($e->asal)): ?>
                        <p class="meta"><?= htmlspecialchars($e->asal) ?>  <?= htmlspecialchars($e->tujuan) ?></p>
                    <?php endif; ?>

                    <p class="meta"> <?= htmlspecialchars($e->lokasi) ?></p>
                    <p class="meta"> <?= date('d M Y, H:i', strtotime($e->tanggal)) ?></p>

                    <p class="price">Rp <?= number_format($e->harga, 0, ',', '.') ?></p>

                    <p class="meta">
                        Sisa stok:
                        <span class="badge <?= $e->stok > 10 ? 'badge-success' : 'badge-warning' ?>">
                            <?= $e->stok ?>
                        </span>
                    </p>
                </div>
                <div class="footer">
                    <a href="<?= site_url('detail/' . $e->id) ?>"
                       class="btn btn-primary btn-sm btn-block">Lihat Detail & Pesan</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>