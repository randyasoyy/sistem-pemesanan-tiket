<h3 class="fw-bold mb-4"><i class="bi bi-people"></i> Kelola User</h3>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th width="60">ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Dibuat</th>
                    <th width="100">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $u): ?>
                    <tr>
                        <td><?= $u->id ?></td>
                        <td class="fw-semibold"><?= htmlspecialchars($u->nama) ?></td>
                        <td><?= htmlspecialchars($u->email) ?></td>
                        <td>
                            <span class="badge bg-<?= $u->role === 'admin' ? 'danger' : 'secondary' ?>">
                                <?= $u->role ?>
                            </span>
                        </td>
                        <td><?= $u->created_at ?></td>
                        <td>
                            <?php if ($u->id != $this->session->userdata('user_id')): ?>
                                <a href="<?= site_url('admin/users/delete/' . $u->id) ?>"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Hapus user ini?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            <?php else: ?>
                                <span class="text-muted small">—</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>