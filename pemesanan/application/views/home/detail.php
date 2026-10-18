<a href="<?= site_url('home') ?>" class="btn btn-sm btn-outline-secondary mb-3">← Kembali</a>

<div class="row">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-body">
                <span class="badge bg-<?= $event->kategori === 'konser' ? 'danger' : ($event->kategori === 'bioskop' ? 'primary' : 'success') ?> mb-2">
                    <?= ucfirst($event->kategori) ?>
                </span>
                <h2><?= htmlspecialchars($event->nama_event) ?></h2>
                <hr>
                <table class="table table-sm table-borderless">
                    <tr>
                        <th width="150"> Lokasi</th>
                        <td><?= htmlspecialchars($event->lokasi) ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td><?= date('l, d F Y - H:i', strtotime($event->tanggal)) ?></td>
                    </tr>
                    <tr>
                        <th> Harga</th>
                        <td class="fw-bold text-primary">Rp <?= number_format($event->harga, 0, ',', '.') ?></td>
                    </tr>
                    <tr>
                        <th> Sisa Stok</th>
                        <td>
                            <span class="badge bg-<?= $event->stok > 10 ? 'success' : ($event->stok > 0 ? 'warning' : 'danger') ?>">
                                <?= $event->stok ?> tiket
                            </span>
                        </td>
                    </tr>
                </table>
                <hr>
                <h6>Deskripsi</h6>
            
                <?php if ($event->kategori === 'konser'): ?>
                    <hr>
                    <h5 class="fw-bold"> Info Konser</h5>
                    <table class="table table-sm">
                        <?php if ($event->artis): ?>
                            <tr>
                                <th width="150">Artis</th>
                                <td><?= htmlspecialchars($event->artis) ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if ($event->jam_mulai): ?>
                            <tr>
                                <th>Jam Mulai</th>
                                <td><?= $event->jam_mulai ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if ($event->kelas_tiket): ?>
                            <tr>
                                <th>Kelas Tiket</th>
                                <td><?= htmlspecialchars($event->kelas_tiket) ?></td>
                            </tr>
                        <?php endif; ?>
                    </table>
                <?php elseif ($event->kategori === 'bioskop'): ?>
                    <hr>
                    <h5 class="fw-bold"> Info Bioskop</h5>
                    <table class="table table-sm">
                        <?php if ($event->studio): ?>
                            <tr>
                                <th width="150">Studio</th>
                                <td><?= htmlspecialchars($event->studio) ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if ($event->jam_mulai): ?>
                            <tr>
                                <th>Jam Tayang</th>
                                <td><?= $event->jam_mulai ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if ($event->durasi_menit): ?>
                            <tr>
                                <th>Durasi</th>
                                <td><?= $event->durasi_menit ?> menit</td>
                            </tr>
                        <?php endif; ?>
                    </table>
                <?php elseif ($event->kategori === 'transportasi'): ?>
                    <hr>
                    <h5 class="fw-bold"> Info Perjalanan</h5>
                    <table class="table table-sm">
                        <?php if ($event->asal && $event->tujuan): ?>
                            <tr>
                                <th width="150">Rute</th>
                                <td><?= htmlspecialchars($event->asal) ?> → <?= htmlspecialchars($event->tujuan) ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if ($event->jenis_kendaraan): ?>
                            <tr>
                                <th>Kendaraan</th>
                                <td><?= htmlspecialchars($event->jenis_kendaraan) ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if ($event->jam_mulai): ?>
                            <tr>
                                <th>Berangkat</th>
                                <td><?= $event->jam_mulai ?></td>
                            </tr>
                        <?php endif; ?>
                        <?php if ($event->jam_tiba): ?>
                            <tr>
                                <th>Tiba</th>
                                <td><?= $event->jam_tiba ?></td>
                            </tr>
                        <?php endif; ?>
                    </table>
                <?php endif; ?>
                <p><?= nl2br(htmlspecialchars($event->deskripsi ?? '-')) ?></p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm sticky-top" style="top: 20px;">
            <div class="card-body text-center">
                <h5>Pesan Tiket</h5>
                <p class="display-6 text-primary">
                    Rp <?= number_format($event->harga, 0, ',', '.') ?>
                </p>
                <?php if ($event->stok > 0): ?>
                    <a href="<?= site_url('booking/' . $event->id) ?>" class="btn btn-success btn-lg w-100">
                        Pesan Sekarang
                    </a>
                <?php else: ?>
                    <button class="btn btn-secondary btn-lg w-100" disabled>Stok Habis</button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php if (!empty($rekomendasi)): ?>
    <hr class="my-4">
    <h5>Event Serupa</h5>
    <div class="row">
        <?php foreach ($rekomendasi as $r): ?>
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h6><?= htmlspecialchars($r->nama_event) ?></h6>
                        <p class="small text-muted mb-2"><?= date('d M Y', strtotime($r->tanggal)) ?> · <?= htmlspecialchars($r->lokasi) ?></p>
                        <a href="<?= site_url('detail/' . $r->id) ?>" class="btn btn-sm btn-outline-primary">Lihat</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>