<?= view('layout/header') ?>

<div class="card card-custom">
    <div class="card-header-custom d-flex justify-content-between align-items-center">
        <div>
            <h4 class="m-0 text-white"><i class="bi bi-tools me-2"></i>Log Kerusakan & Servis</h4>
            <small class="text-muted">Monitoring perbaikan hardware & software</small>
        </div>
        <a href="<?= site_url('catatankerusakan/create') ?>" class="btn btn-neon btn-sm px-3 rounded-pill">
            <i class="bi bi-plus-lg me-1"></i> Buat Laporan
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-dark-custom table-hover m-0 align-middle small">
                <thead>
                    <tr>
                        <th class="ps-3">No</th>
                        <th>Barang & Lokasi</th>
                        <th>Kondisi</th>
                        <th>Status</th>
                        <th>Timeline (Durasi)</th>
                        <th class="text-end pe-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach($catatan_kerusakan as $k): ?>
                    <tr>
                        <td class="ps-3 text-muted"><?= $no++ ?></td>
                        
                        <td>
                            <div class="fw-bold text-white"><?= esc($k['nama_barang']) ?></div>
                            <div class="d-flex gap-2 mt-1">
                                <span class="badge bg-secondary border border-secondary text-light">Qty: <?= esc($k['jumlah']) ?></span>
                                <span class="badge bg-dark border border-secondary text-info"><i class="bi bi-geo-alt me-1"></i> <?= esc($k['ruang']) ?></span>
                            </div>
                        </td>

                        <td>
                            <?php 
                                $rusakColor = 'bg-secondary';
                                if($k['tingkat_rusak'] == 'Berat' || $k['tingkat_rusak'] == 'Mati Total') $rusakColor = 'bg-danger';
                                elseif($k['tingkat_rusak'] == 'Sedang') $rusakColor = 'bg-warning text-dark';
                                elseif($k['tingkat_rusak'] == 'Ringan') $rusakColor = 'bg-info text-dark';
                            ?>
                            <span class="badge <?= $rusakColor ?>"><?= esc($k['tingkat_rusak']) ?></span>
                        </td>

                        <td>
                            <?php 
                                $statusMap = [
                                    'Belum Diperbaiki' => 'bg-danger',
                                    'Proses Perbaikan' => 'bg-warning text-dark',
                                    'Ajukan Penggantian' => 'bg-info text-dark',
                                    'Selesai Perbaikan' => 'bg-success',
                                    'Diganti Baru' => 'bg-primary'
                                ];
                                $badgeClass = $statusMap[$k['status_perbaikan']] ?? 'bg-secondary';
                            ?>
                            <span class="badge <?= $badgeClass ?> rounded-pill px-2">
                                <?= esc($k['status_perbaikan']) ?>
                            </span>
                            
                            <?php if($k['estimasi_biaya'] > 0): ?>
                                <div class="mt-1 text-success small fw-bold">
                                    Rp <?= number_format($k['estimasi_biaya'], 0, ',', '.') ?>
                                </div>
                            <?php endif; ?>
                        </td>

                        <td>
                            <div class="d-flex flex-column gap-1">
                                <div class="text-white-50">
                                    <i class="bi bi-calendar-event me-1 text-muted"></i> 
                                    Lapor: <span class="text-white"><?= date('d M Y', strtotime($k['tanggal_catat'])) ?></span>
                                </div>

                                <?php if(!empty($k['tanggal_selesai'])): ?>
                                    <div class="text-white-50">
                                        <i class="bi bi-check-circle-fill me-1 text-success"></i> 
                                        Selesai: <span class="text-success fw-bold"><?= date('d M Y', strtotime($k['tanggal_selesai'])) ?></span>
                                    </div>
                                    <?php
                                        $tgl1 = new DateTime($k['tanggal_catat']);
                                        $tgl2 = new DateTime($k['tanggal_selesai']);
                                        $durasi = $tgl2->diff($tgl1)->days;
                                        $durasiTeks = ($durasi == 0) ? "Hari yang sama" : $durasi . " Hari kerja";
                                    ?>
                                    <small class="text-muted fst-italic">(<?= $durasiTeks ?>)</small>
                                <?php else: ?>
                                    <div class="text-muted small border-top border-secondary pt-1 mt-1">
                                        <i class="bi bi-hourglass-split me-1"></i> On Progress...
                                    </div>
                                <?php endif; ?>
                            </div>
                        </td>

                        <td class="text-end pe-3">
                            <div class="btn-group">
                                <a href="<?= site_url('catatankerusakan/edit/'.$k['id']) ?>" class="btn btn-outline-warning btn-sm"><i class="bi bi-pencil"></i></a>
                                <a href="<?= site_url('catatankerusakan/delete/'.$k['id']) ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Hapus data ini?')"><i class="bi bi-trash"></i></a>
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