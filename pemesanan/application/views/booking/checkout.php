<div class="checkout-wrapper">
    <a href="<?= site_url('detail/' . $event->id) ?>" class="btn btn-sm btn-light mb-3">
        ← Kembali
    </a>

    <h3 class="section-title"> Form Pemesanan Tiket</h3>

    <div class="row mt-3">
        <div class="col-7">
            <div class="card">
                <div class="card-body">
                    <?= validation_errors('<div class="alert alert-danger">', '</div>') ?>

                    <?= form_open('booking/' . $event->id) ?>
                    <h4 class="mb-3">Data Pemesan</h4>

                    <div class="form-group">
                        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama_pemesan" class="form-control"
                            value="<?= set_value('nama_pemesan', $this->session->userdata('nama')) ?>" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">No. HP <span class="text-danger">*</span></label>
                        <input type="text" name="no_hp" class="form-control"
                            value="<?= set_value('no_hp') ?>"
                            placeholder="08123456789" required>
                    </div>

                    <hr>
                    <h4 class="mb-3">Jumlah Tiket</h4>

                    <div class="form-group">
                        <label class="form-label">
                            Jumlah <span class="text-danger">*</span>
                            <span class="text-muted small">(maks <?= $event->stok ?>)</span>
                        </label>
                        <input type="number" name="jumlah_tiket" id="jumlah"
                            class="form-control"
                            value="<?= set_value('jumlah_tiket', 1) ?>"
                            min="1" max="<?= $event->stok ?>" required>
                        <input type="hidden" id="harga-satuan" value="<?= (int)$event->harga ?>">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Catatan (opsional)</label>
                        <textarea name="catatan" class="form-control" rows="3"
                            placeholder="Contoh: kursi baris depan"><?= set_value('catatan') ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-success btn-block btn-lg">
                        Lanjut ke Pembayaran →
                    </button>
                    <?= form_close() ?>
                </div>
            </div>
        </div>

        <div class="col-5">
            <div class="card sticky">
                <div class="card-body">
                    <h4 class="mb-3">Ringkasan Pesanan</h4>
                    <p class="fw-bold mb-1"><?= htmlspecialchars($event->nama_event) ?></p>
                    <p class="small text-muted mb-1"> <?= htmlspecialchars($event->lokasi) ?></p>
                    <p class="small text-muted mb-3"> <?= date('d M Y, H:i', strtotime($event->tanggal)) ?></p>
                    <hr>
                    <div class="d-flex-between mb-2">
                        <span class="text-muted">Harga satuan</span>
                        <span>Rp <?= number_format($event->harga, 0, ',', '.') ?></span>
                    </div>
                    <div class="d-flex-between mb-2">
                        <span class="text-muted">Jumlah</span>
                        <span><span id="qty_display">1</span> tiket</span>
                    </div>
                    <hr>
                    <div class="d-flex-between">
                        <strong>TOTAL</strong>
                        <strong class="text-primary" style="font-size: 20px;" id="total_display">
                            Rp <?= number_format($event->harga, 0, ',', '.') ?>
                        </strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>