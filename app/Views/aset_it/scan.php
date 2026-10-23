<?= view('layout/header') ?>

<?php
// Tentukan warna badge berdasarkan kondisi
$kondisi = $aset['kondisi_aset'];
$badge_color = 'bg-secondary';
$icon_kondisi = 'bi-info-circle';

if ($kondisi == 'Digunakan') {
    $badge_color = 'bg-success';
    $icon_kondisi = 'bi-check-circle';
} elseif ($kondisi == 'Rusak') {
    $badge_color = 'bg-danger';
    $icon_kondisi = 'bi-x-circle';
} elseif ($kondisi == 'Backup') {
    $badge_color = 'bg-info text-dark';
    $icon_kondisi = 'bi-shield-check';
}
?>

<div class="container-fluid px-2 py-3" style="max-width: 600px; margin: 0 auto;">
    
    <!-- Header Status -->
    <div class="card bg-dark text-white border-0 shadow-lg mb-4" style="border-radius: 15px;">
        <div class="card-body text-center p-4">
            <div class="mb-3">
                <i class="bi bi-qr-code-scan text-white-50" style="font-size: 3rem;"></i>
            </div>
            <h3 class="fw-bold mb-1 text-neon"><?= esc($aset['no_aktiva']) ?></h3>
            <p class="text-muted mb-3"><?= esc($aset['nama_aset']) ?></p>
            
            <div class="d-inline-flex align-items-center <?= $badge_color ?> px-4 py-2" style="border-radius: 50px;">
                <i class="bi <?= $icon_kondisi ?> me-2 fs-5"></i>
                <span class="fw-bold fs-6"><?= esc($kondisi) ?></span>
            </div>
        </div>
    </div>

    <!-- Spesifikasi -->
    <div class="card bg-dark text-white border-0 shadow-sm mb-4" style="border-radius: 15px;">
        <div class="card-header border-secondary bg-transparent py-3">
            <h6 class="mb-0 fw-bold"><i class="bi bi-cpu me-2 text-warning"></i>Detail Aset</h6>
        </div>
        <div class="card-body p-0">
            <ul class="list-group list-group-flush" style="border-radius: 15px;">
                <li class="list-group-item bg-transparent text-white border-secondary d-flex justify-content-between py-3">
                    <span class="text-white-50">Kategori</span>
                    <span class="fw-medium text-end"><?= esc($aset['kategori']) ?> <br><small class="text-muted"><?= esc($aset['sub_kategori']) ?></small></span>
                </li>
                <li class="list-group-item bg-transparent text-white border-secondary d-flex justify-content-between py-3">
                    <span class="text-white-50">Merk / Tipe</span>
                    <span class="fw-medium text-end"><?= esc($aset['merk'] ?: '-') ?> <?= esc($aset['tipe'] ?: '-') ?></span>
                </li>
                <li class="list-group-item bg-transparent text-white border-secondary d-flex justify-content-between py-3">
                    <span class="text-white-50">Serial Number</span>
                    <span class="fw-medium text-warning font-monospace"><?= esc($aset['serial_number'] ?: 'Belum Diatur') ?></span>
                </li>
                <li class="list-group-item bg-transparent text-white border-secondary d-flex justify-content-between py-3">
                    <span class="text-white-50">Lokasi</span>
                    <span class="fw-medium text-end"><?= esc($aset['ruangan']) ?> <br><small class="text-muted">Lantai <?= esc($aset['lantai']) ?></small></span>
                </li>
                <li class="list-group-item bg-transparent text-white border-secondary d-flex justify-content-between py-3">
                    <span class="text-white-50">Pengguna</span>
                    <span class="fw-medium text-end"><?= esc($aset['pengguna'] ?: 'Tidak Ada') ?></span>
                </li>
            </ul>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="d-flex gap-2 mb-4">
        <a href="<?= site_url('asetit/edit/' . $aset['id']) ?>" class="btn btn-outline-info flex-fill" style="border-radius: 10px;">
            <i class="bi bi-pencil me-1"></i> Edit Data
        </a>
        <!-- Tautan ke form tambah catatan kerusakan dengan auto-fill no_aktiva jika support -->
        <a href="<?= site_url('catatankerusakan/create') ?>" class="btn btn-outline-danger flex-fill" style="border-radius: 10px;">
            <i class="bi bi-exclamation-triangle me-1"></i> Lapor Rusak
        </a>
    </div>

    <!-- History Timeline -->
    <h6 class="text-white-50 mb-3 px-2"><i class="bi bi-clock-history me-2"></i>Riwayat Mutasi</h6>
    <div class="timeline px-2">
        <?php if(empty($history)): ?>
            <p class="text-muted small">Belum ada riwayat tercatat.</p>
        <?php else: ?>
            <?php foreach($history as $h): ?>
                <div class="d-flex mb-3">
                    <div class="me-3 d-flex flex-column align-items-center">
                        <?php
                        $icon = 'bi-circle-fill text-secondary';
                        if ($h['jenis_mutasi'] == 'MASUK') $icon = 'bi-plus-circle-fill text-success';
                        elseif ($h['jenis_mutasi'] == 'PINDAH') $icon = 'bi-arrow-left-right text-warning';
                        elseif ($h['jenis_mutasi'] == 'RUSAK') $icon = 'bi-x-circle-fill text-danger';
                        elseif ($h['jenis_mutasi'] == 'PERBAIKAN') $icon = 'bi-wrench text-info';
                        elseif ($h['jenis_mutasi'] == 'UPDATE') $icon = 'bi-pencil-square text-primary';
                        ?>
                        <i class="bi <?= $icon ?> fs-5 z-1 bg-dark"></i>
                        <div class="h-100 border-start border-secondary mt-1" style="min-height: 20px;"></div>
                    </div>
                    <div class="pb-3 w-100">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="fw-bold text-white small"><?= esc($h['jenis_mutasi']) ?></span>
                            <span class="text-white-50" style="font-size: 0.75rem;">
                                <?= date('d M Y, H:i', strtotime($h['created_at'])) ?>
                            </span>
                        </div>
                        <p class="text-muted small mb-0"><?= esc($h['keterangan']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?= view('layout/footer') ?>
