<h3 class="fw-bold mb-4"> Ringkasan</h3>

<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-icon stat-icon-primary"></div>
        <div>
            <div class="stat-label">Total Event</div>
            <div class="stat-value"><?= $total_event ?? 0 ?></div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon stat-icon-info"></div>
        <div>
            <div class="stat-label">Total User</div>
            <div class="stat-value"><?= $total_user ?? 0 ?></div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon stat-icon-success"></div>
        <div>
            <div class="stat-label">Transaksi Paid</div>
            <div class="stat-value"><?= $total_trx ?? 0 ?></div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon stat-icon-warning"></div>
        <div>
            <div class="stat-label">Pendapatan</div>
            <div class="stat-value" style="font-size: 17px;">
                Rp <?= number_format($pendapatan ?? 0, 0, ',', '.') ?>
            </div>
        </div>
    </div>
</div>

<h4 class="fw-bold mb-3 mt-4"> Event per Kategori</h4>

<div class="row">
    <div class="col-4">
        <a href="<?= site_url('admin/events?kategori=konser') ?>" style="text-decoration:none;color:inherit;">
            <div class="card event-card">
                <div class="card-body text-center">
                    <div style="font-size: 3rem;"></div>
                    <h3 class="fw-bold mt-2 mb-0"><?= $total_konser ?? 0 ?></h3>
                    <p class="text-muted mb-0">Konser</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-4">
        <a href="<?= site_url('admin/events?kategori=bioskop') ?>" style="text-decoration:none;color:inherit;">
            <div class="card event-card">
                <div class="card-body text-center">
                    <div style="font-size: 3rem;"></div>
                    <h3 class="fw-bold mt-2 mb-0"><?= $total_bioskop ?? 0 ?></h3>
                    <p class="text-muted mb-0">Bioskop</p>
                </div>
            </div>
        </a>
    </div>
    <div class="col-4">
        <a href="<?= site_url('admin/events?kategori=transportasi') ?>" style="text-decoration:none;color:inherit;">
            <div class="card event-card">
                <div class="card-body text-center">
                    <div style="font-size: 3rem;"></div>
                    <h3 class="fw-bold mt-2 mb-0"><?= $total_transport ?? 0 ?></h3>
                    <p class="text-muted mb-0">Transportasi</p>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="mt-4 d-flex gap-2">
    <a href="<?= site_url('admin/events/create') ?>" class="btn btn-primary">
         Tambah Event Baru
    </a>
    <a href="<?= site_url('admin/events') ?>" class="btn btn-light">
         Semua Event
    </a>
</div>