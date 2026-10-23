<?= view('layout/header') ?>

<div class="card card-custom">
    <div class="card-header-custom d-flex justify-content-between align-items-center">
        <h4 class="m-0 text-white"><i class="bi bi-clock-history me-2"></i>Riwayat Mutasi Aset IT</h4>
        <a href="<?= site_url('asetit') ?>" class="btn btn-outline-secondary btn-sm px-3 rounded-pill">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Aset
        </a>
    </div>
    
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-dark-custom table-hover m-0 align-middle">
                <thead>
                    <tr>
                        <th class="ps-4">No</th>
                        <th>Waktu</th>
                        <th>Identitas Aset</th>
                        <th>Jenis Mutasi</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                        <th class="pe-4">Oleh</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($logs as $log): ?>
                    <tr>
                        <td class="ps-4 text-muted"><?= $no++ ?></td>
                        <td>
                            <div class="text-white"><?= date('d M Y', strtotime($log['created_at'])) ?></div>
                            <small class="text-white-50"><?= date('H:i:s', strtotime($log['created_at'])) ?></small>
                        </td>
                        <td>
                            <div class="fw-bold text-white">
                                <?= esc($log['referensi'] ?? 'Tidak Diketahui') ?>
                                <?php if($log['entitas'] == 'aset_it'): ?>
                                    <span class="badge bg-primary bg-opacity-25 text-primary ms-1" style="font-size:0.65rem;">Aset IT</span>
                                <?php else: ?>
                                    <span class="badge bg-warning bg-opacity-25 text-warning ms-1" style="font-size:0.65rem;">Barang</span>
                                <?php endif; ?>
                            </div>
                            <small class="text-muted"><?= esc($log['deskripsi'] ?? '') ?></small>
                        </td>
                        <td>
                            <?php if ($log['jenis_mutasi'] == 'MASUK'): ?>
                                <span class="badge bg-success bg-opacity-25 text-success border border-success px-3 rounded-pill">MASUK</span>
                            <?php elseif ($log['jenis_mutasi'] == 'KELUAR'): ?>
                                <span class="badge bg-danger bg-opacity-25 text-danger border border-danger px-3 rounded-pill">KELUAR</span>
                            <?php else: ?>
                                <span class="badge bg-warning bg-opacity-25 text-warning border border-warning px-3 rounded-pill"><?= esc($log['jenis_mutasi']) ?></span>
                            <?php endif; ?>
                        </td>
                        <td class="font-monospace h5 m-0 <?= $log['jenis_mutasi'] == 'MASUK' ? 'text-success' : 'text-danger' ?>">
                            <?= $log['jenis_mutasi'] == 'MASUK' ? '+' : '-' ?><?= $log['jumlah'] ?>
                        </td>
                        <td class="text-white-50"><?= esc($log['keterangan']) ?></td>
                        <td class="pe-4">
                            <span class="badge bg-secondary"><i class="bi bi-person-fill me-1"></i> <?= esc($log['username'] ?? 'System/Unknown') ?></span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= view('layout/footer') ?>
