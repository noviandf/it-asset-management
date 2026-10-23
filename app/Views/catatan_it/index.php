<?= view('layout/header') ?>

<div class="card card-custom">
    <div class="card-header-custom d-flex justify-content-between align-items-center">
        <h4 class="m-0 text-white"><i class="bi bi-display me-2"></i>Daftar PC & Remote</h4>
        <a href="<?= site_url('catatanit/create') ?>" class="btn btn-neon btn-sm px-3 rounded-pill">
            <i class="bi bi-plus-lg me-1"></i> Tambah PC
        </a>
    </div>
    
    <div class="card-body p-0">
        <!-- Filter Buttons -->
        <div class="px-3 py-3 border-bottom border-secondary bg-dark bg-opacity-25 d-flex gap-2 flex-wrap">
            <span class="text-muted small align-self-center me-2"><i class="bi bi-funnel"></i> Lokasi:</span>
            <button class="btn btn-sm btn-primary active dt-filter-btn" data-filter="all">Semua</button>
            <button class="btn btn-sm btn-outline-secondary dt-filter-btn" data-filter="Ruang Agent">Ruang Agent</button>
            <button class="btn btn-sm btn-outline-secondary dt-filter-btn" data-filter="Ruang Management">Ruang Management</button>
            <button class="btn btn-sm btn-outline-secondary dt-filter-btn" data-filter="Ruang Server">Ruang Server</button>
        </div>

        <div class="table-responsive">
            <table class="table table-dark-custom table-hover m-0 align-middle">
                <thead>
                    <tr>
                        <th class="ps-4">No</th>
                        <th>User / PC Name</th>
                        <th>Lokasi</th>
                        <th>IP Address</th>
                        <th>Anydesk ID</th>
                        <th class="text-center">Akses Remote</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach($catatan_it as $c): ?>
                    <tr>
                        <td class="ps-4 text-muted"><?= $no++ ?></td>
                        <td>
                            <div class="fw-bold text-white"><?= esc($c['nama_pc']) ?></div>
                            <small class="text-muted"><?= esc($c['keterangan']) ?></small>
                        </td>
                        <td><span class="badge bg-secondary"><?= esc($c['lokasi']) ?></span></td>
                        <td class="font-monospace text-info"><?= esc($c['ip_address']) ?></td>
                        <td class="fw-bold text-warning"><?= esc($c['anydesk_id']) ?></td>

                        <td class="text-center">
                            <?php if(!empty($c['anydesk_id'])): ?>
                                <a href="anydesk:<?= esc($c['anydesk_id']) ?>" class="btn btn-danger btn-sm px-4 rounded-pill shadow-sm" title="Connect Now">
                                    <i class="bi bi-lightning-fill me-1"></i> REMOTE
                                </a>
                            <?php else: ?>
                                <span class="text-muted small">- No ID -</span>
                            <?php endif; ?>
                        </td>

                        <td class="text-end pe-4">
                            <div class="btn-group">
                                <a href="<?= site_url('catatanit/edit/'.$c['id']) ?>" class="btn btn-outline-warning btn-sm"><i class="bi bi-pencil"></i></a>
                                <a href="<?= site_url('catatanit/delete/'.$c['id']) ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Hapus data ini?')"><i class="bi bi-trash"></i></a>
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