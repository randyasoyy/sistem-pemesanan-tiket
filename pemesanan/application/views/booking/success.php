<div class="row justify-content-center">
    <div class="col-lg-8">

        <div class="card border-success border-2 shadow-sm">
            <div class="card-body p-4 p-md-5 text-center">

                
                <div class="mb-3">
                    <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-success bg-opacity-10"
                        style="width: 90px; height: 90px;">
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 3rem;"></i>
                    </div>
                </div>

                <h3 class="fw-bold text-success mb-2">Pembayaran Berhasil!</h3>
                <p class="text-muted mb-4">
                    Tiket Anda sudah aktif. Tunjukkan kode di bawah saat masuk.
                </p>

                
                <div class="bg-light border border-2 border-primary rounded-3 p-4 mb-4"
                    style="border-style: dashed !important;">
                    <small class="text-muted d-block text-uppercase fw-semibold">Kode Booking</small>
                    <div class="fw-bold text-primary mt-2"
                        style="font-family: 'Courier New', monospace; font-size: 1.8rem; letter-spacing: 3px;">
                        <?= $trx->kode_booking ?>
                    </div>
                </div>

                
                <div class="text-start">
                    <table class="table table-borderless align-middle mb-0">
                        <tr>
                            <th width="40%" class="text-muted fw-normal">
                                <i class="bi bi-person"></i> Nama Pemesan
                            </th>
                            <td class="fw-semibold"><?= htmlspecialchars($trx->nama_pemesan) ?></td>
                        </tr>
                        <tr>
                            <th class="text-muted fw-normal">
                                <i class="bi bi-telephone"></i> No. HP
                            </th>
                            <td><?= htmlspecialchars($trx->no_hp) ?></td>
                        </tr>
                        <tr>
                            <th class="text-muted fw-normal">
                                <i class="bi bi-calendar-event"></i> Event
                            </th>
                            <td class="fw-semibold"><?= htmlspecialchars($trx->nama_event) ?></td>
                        </tr>
                        <tr>
                            <th class="text-muted fw-normal">
                                <i class="bi bi-geo-alt"></i> Lokasi
                            </th>
                            <td><?= htmlspecialchars($trx->lokasi) ?></td>
                        </tr>
                        <tr>
                            <th class="text-muted fw-normal">
                                <i class="bi bi-clock"></i> Tanggal
                            </th>
                            <td><?= date('l, d F Y - H:i', strtotime($trx->tgl_event)) ?></td>
                        </tr>
                        <tr>
                            <th class="text-muted fw-normal">
                                <i class="bi bi-ticket-perforated"></i> Jumlah Tiket
                            </th>
                            <td><?= $trx->jumlah_tiket ?> tiket</td>
                        </tr>
                        <tr>
                            <th class="text-muted fw-normal">
                                <i class="bi bi-credit-card"></i> Metode Bayar
                            </th>
                            <td>
                                <span class="badge bg-secondary">
                                    <?= strtoupper($trx->metode_pembayaran) ?>
                                </span>
                            </td>
                        </tr>
                        <tr class="border-top">
                            <th class="fw-bold fs-5">Total</th>
                            <td class="text-primary fw-bold fs-4">
                                Rp <?= number_format($trx->total_harga, 0, ',', '.') ?>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="alert alert-info small mt-3 text-start">
                    <i class="bi bi-info-circle"></i>
                    Simpan kode booking ini. Tunjukkan kepada petugas saat masuk venue.
                </div>

                <div class="d-grid gap-2 mt-4">
                    <a href="<?= site_url('my-tickets') ?>" class="btn btn-primary py-2 fw-semibold">
                        <i class="bi bi-ticket-detailed"></i> Lihat Semua Tiket Saya
                    </a>
                    <a href="<?= site_url('home') ?>" class="btn btn-outline-secondary">
                        <i class="bi bi-plus-circle"></i> Pesan Tiket Lain
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>