<?= view('layout/header') ?>

<div class="card card-custom">
    <div class="card-header-custom d-flex justify-content-between align-items-center">
        <h4 class="m-0 text-white"><i class="bi bi-calendar-check me-2"></i>IT Planning & To-Do</h4>
        <a href="<?= site_url('catatanplanning/create') ?>" class="btn btn-neon btn-sm px-3 rounded-pill">
            <i class="bi bi-plus-lg me-1"></i> Buat Plan
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-dark-custom table-hover m-0 align-middle">
                <thead>
                    <tr>
                        <th class="ps-4">No</th>
                        <th>Rencana Kegiatan</th>
                        <th>Target Tanggal</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($catatan_planning as $p): ?>
                    <tr>
                        <td class="ps-4 text-muted"><?= $no++ ?></td>
                        <td>
                            <div class="fw-bold text-white mb-1"><?= esc($p['judul']) ?></div>
                            <small class="text-white-50"><?= esc($p['deskripsi']) ?></small>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-clock me-2 text-primary"></i>
                                <?= date('d M Y', strtotime($p['tanggal'])) ?>
                            </div>
                        </td>
                        <td>
                            <?php if ($p['status'] == 'Terlaksana'): ?>
                                <span class="badge bg-success bg-opacity-25 text-success border border-success px-3 rounded-pill">
                                    <i class="bi bi-check-all me-1"></i> DONE
                                </span>
                            <?php else: ?>
                                <span class="badge bg-warning bg-opacity-10 text-warning border border-warning px-3 rounded-pill">
                                    <i class="bi bi-hourglass-split me-1"></i> PENDING
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="text-end pe-4">
                            <div class="btn-group">
                                <a href="<?= site_url('catatanplanning/edit/' . $p['id']) ?>" class="btn btn-outline-warning btn-sm"><i class="bi bi-pencil"></i></a>
                                <a href="<?= site_url('catatanplanning/delete/' . $p['id']) ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')"><i class="bi bi-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= view('layout/footer') ?>