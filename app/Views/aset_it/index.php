<?= view('layout/header') ?>

<div class="card card-custom">
    <div class="card-header-custom d-flex justify-content-between align-items-center">
        <h4 class="m-0 text-white"><i class="bi bi-grid-3x3-gap-fill me-2"></i>Summary IT Assets (EAM)</h4>
        <div class="d-flex gap-2">
            <a href="<?= site_url('logmutasi') ?>" class="btn btn-outline-info btn-sm px-3 rounded-pill">
                <i class="bi bi-clock-history me-1"></i> Log Mutasi
            </a>
            <a href="<?= site_url('asetit/create_multiple') ?>" class="btn btn-neon btn-sm px-3 rounded-pill">
                <i class="bi bi-plus-lg me-1"></i> Input Barang Baru
            </a>
        </div>
    </div>
    
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-dark-custom table-hover m-0 align-middle table-bordered text-center">
                <thead class="align-middle">
                    <tr>
                        <th rowspan="2" class="text-start ps-4">Nama Barang</th>
                        <th colspan="<?= count($rooms) ?>" class="text-center text-info">Sebaran Ruangan & Lantai</th>
                        <th rowspan="2" class="text-center bg-dark bg-opacity-50">Total</th>
                        <th rowspan="2" class="text-center text-danger bg-danger bg-opacity-10">Rusak</th>
                        <th rowspan="2" class="text-center text-warning bg-warning bg-opacity-10">Backup</th>
                        <th rowspan="2" class="pe-4 text-center">Aksi</th>
                    </tr>
                    <tr>
                        <?php foreach($rooms as $room => $lantai): ?>
                        <th>
                            <div class="text-white"><?= esc($room) ?></div>
                            <small class="text-muted" style="font-size: 0.7rem;"><?= esc($lantai) ?></small>
                        </th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($summary)): ?>
                    <tr>
                        <td colspan="<?= count($rooms) + 5 ?>" class="text-center text-muted py-4">Belum ada data aset</td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($summary as $cat => $data): ?>
                        <tr>
                            <td class="text-start ps-4 fw-bold text-white"><?= esc($cat) ?></td>
                            
                            <?php foreach($rooms as $room => $lantai): ?>
                                <?php $count = $data['ruangan'][$room] ?? 0; ?>
                                <td>
                                    <?php if($count > 0): ?>
                                        <span class="badge bg-secondary rounded-pill"><?= $count ?></span>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                            <?php endforeach; ?>
                            
                            <td class="fw-bold bg-dark bg-opacity-50"><?= $data['total'] ?></td>
                            <td class="bg-danger bg-opacity-10">
                                <?php if($data['rusak'] > 0): ?>
                                    <span class="badge bg-danger rounded-pill"><?= $data['rusak'] ?></span>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="bg-warning bg-opacity-10">
                                <?php if($data['backup'] > 0): ?>
                                    <span class="badge bg-warning text-dark rounded-pill"><?= $data['backup'] ?></span>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td class="pe-4">
                                <a href="<?= site_url('asetit/detail?nama_aset=' . urlencode($cat)) ?>" class="btn btn-sm btn-outline-info rounded-pill px-3">
                                    Detail <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= view('layout/footer') ?>
