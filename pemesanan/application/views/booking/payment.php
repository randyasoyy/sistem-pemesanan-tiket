<h3> Pembayaran</h3>

<div class="row mt-3">
    <div class="col-md-7">
        <div class="card shadow-sm">
            <div class="card-body">
                <?= form_open('payment/' . $trx->id) ?>
                    <h6 class="mb-3">Pilih Metode Pembayaran</h6>

                    <?php
                    $metodes = [
                        'transfer' => [' Transfer Bank', 'BCA / Mandiri / BNI'],
                        'va'       => [' Virtual Account', 'Otomatis, cepat'],
                        'ewallet'  => [' E-Wallet', 'GoPay / OVO / DANA'],
                        'qris'     => [' QRIS', 'Scan dari aplikasi apa saja'],
                    ];
                    foreach ($metodes as $key => $m): ?>
                        <div class="form-check border rounded p-3 mb-2">
                            <input class="form-check-input" type="radio"
                                   name="metode" id="m_<?= $key ?>"
                                   value="<?= $key ?>" required>
                            <label class="form-check-label w-100" for="m_<?= $key ?>">
                                <strong><?= $m[0] ?></strong><br>
                                <small class="text-muted"><?= $m[1] ?></small>
                            </label>
                        </div>
                    <?php endforeach; ?>

                    <div class="alert alert-warning small mt-3">
                        Ini simulasi pembayaran. Klik "Bayar Sekarang" → status langsung menjadi <strong>PAID</strong>.
                    </div>

                    <button type="submit" class="btn btn-success w-100 btn-lg">
                         Bayar Sekarang
                    </button>
                <?= form_close() ?>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h6 class="mb-3">Detail Transaksi</h6>
                <p class="mb-1"><small class="text-muted">Kode Booking</small><br>
                    <strong><?= $trx->kode_booking ?></strong></p>
                <p class="mb-1"><small class="text-muted">Event</small><br>
                    <strong><?= htmlspecialchars($trx->nama_event) ?></strong></p>
                <p class="mb-1"><small class="text-muted">Tanggal Event</small><br>
                    <?= date('d M Y, H:i', strtotime($trx->tgl_event)) ?></p>
                <p class="mb-1"><small class="text-muted">Jumlah Tiket</small><br>
                    <?= $trx->jumlah_tiket ?> tiket</p>
                <hr>
                <p class="mb-0">
                    <small class="text-muted">Total Bayar</small><br>
                    <span class="h4 text-primary">Rp <?= number_format($trx->total_harga, 0, ',', '.') ?></span>
                </p>
            </div>
        </div>
    </div>
</div>