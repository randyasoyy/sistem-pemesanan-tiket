<h3 class="section-title mb-3"> Kelola User</h3>

<div class="card">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr><th>ID</th><th>Nama</th><th>Email</th><th>Role</th><th>Dibuat</th><th>Aksi</th></tr>
            </thead>
            <tbody>
            <?php foreach ($users as $u): ?>
                <tr>
                    <td>#<?= $u->id ?></td>
                    <td><strong><?= htmlspecialchars($u->nama) ?></strong></td>
                    <td><?= htmlspecialchars($u->email) ?></td>
                    <td>
                        <span class="badge <?= $u->role === 'admin' ? 'badge-danger' : 'badge-secondary' ?>">
                            <?= strtoupper($u->role) ?>
                        </span>
                    </td>
                    <td class="text-muted small"><?= date('d M Y', strtotime($u->created_at)) ?></td>
                    <td>
                        <?php if ($u->id != $this->session->userdata('user_id')): ?>
                            <a href="<?= site_url('admin/users/toggle_role/' . $u->id) ?>"
                               class="btn btn-sm btn-warning" data-confirm="Ubah role user ini?">UBAH</a>
                            <a href="<?= site_url('admin/users/delete/' . $u->id) ?>"
                               class="btn btn-sm btn-danger" data-confirm="Hapus user ini?">HAPUS</a>
                        <?php else: ?>
                            <span class="badge badge-success">Anda</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>