<?= view('layout/header') ?>

<div class="row mt-4">
    <div class="col-12 text-center mb-5">
        <h2 class="fw-bold text-white" style="letter-spacing: -1px;">IT MONITORING CENTER</h2>
        <p class="text-muted">Pantau kesehatan sistem dan aset IT secara Real-Time</p>
    </div>
</div>

<div class="row g-4">
    
    <div class="col-md-6 col-lg-3">
        <div class="card card-custom h-100 position-relative overflow-hidden group-hover border-0 shadow-lg">
            <div class="position-absolute top-0 end-0 p-3" style="opacity: 0.05; z-index: 0;">
                <i class="bi bi-activity" style="font-size: 6rem; color: #22c55e;"></i>
            </div>
            
            <div class="card-body d-flex flex-column p-4 position-relative" style="z-index: 1;">
                <div class="mb-3">
                    <span class="badge bg-success bg-opacity-10 text-success border border-success rounded-pill px-3 py-2">
                        <i class="bi bi-broadcast me-1"></i> PRIORITY 1
                    </span>
                </div>
                <h4 class="text-white fw-bold mb-1"><?= $total_pc ?> PC / Remote</h4>
                <p class="text-muted small mb-4">Total terdaftar di sistem.</p>
                <a href="<?= site_url('catatanit') ?>" class="btn btn-outline-success mt-auto stretched-link">
                    Buka Log Harian <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card card-custom h-100 position-relative overflow-hidden border-0 shadow-lg">
            <div class="position-absolute top-0 end-0 p-3" style="opacity: 0.05; z-index: 0;">
                <i class="bi bi-exclamation-octagon" style="font-size: 6rem; color: #ef4444;"></i>
            </div>
            
            <div class="card-body d-flex flex-column p-4 position-relative" style="z-index: 1;">
                <div class="mb-3">
                    <span class="badge bg-danger bg-opacity-10 text-danger border border-danger rounded-pill px-3 py-2">
                        <i class="bi bi-bug me-1"></i> INCIDENTS
                    </span>
                </div>
                <h4 class="text-white fw-bold mb-1"><?= $total_issues ?> Issues & Fix</h4>
                <p class="text-muted small mb-4">Laporan belum diselesaikan.</p>
                
                <a href="<?= site_url('catatankerusakan') ?>" class="btn btn-outline-danger mt-auto stretched-link">
                    Cek Tiket Masalah <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card card-custom h-100 position-relative overflow-hidden border-0 shadow-lg">
            <div class="position-absolute top-0 end-0 p-3" style="opacity: 0.05; z-index: 0;">
                <i class="bi bi-calendar-week" style="font-size: 6rem; color: #eab308;"></i>
            </div>
            
            <div class="card-body d-flex flex-column p-4 position-relative" style="z-index: 1;">
                <div class="mb-3">
                    <span class="badge bg-warning bg-opacity-10 text-warning border border-warning rounded-pill px-3 py-2">
                        <i class="bi bi-kanban me-1"></i> SCHEDULE
                    </span>
                </div>
                <h4 class="text-white fw-bold mb-1"><?= $total_planning ?> IT Planning</h4>
                <p class="text-muted small mb-4">Rencana/Project Pending.</p>
                
                <a href="<?= site_url('catatanplanning') ?>" class="btn btn-outline-warning mt-auto stretched-link">
                    Lihat Jadwal <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card card-custom h-100 position-relative overflow-hidden border-0 shadow-lg">
            <div class="position-absolute top-0 end-0 p-3" style="opacity: 0.05; z-index: 0;">
                <i class="bi bi-server" style="font-size: 6rem; color: #3b82f6;"></i>
            </div>
            
            <div class="card-body d-flex flex-column p-4 position-relative" style="z-index: 1;">
                <div class="mb-3">
                    <span class="badge bg-info bg-opacity-10 text-info border border-info rounded-pill px-3 py-2">
                        <i class="bi bi-database me-1"></i> DATABASE
                    </span>
                </div>
                <h4 class="text-white fw-bold mb-1"><?= $total_assets_count ?> Asset Inventory</h4>
                <p class="text-muted small mb-4">Total unit perangkat tersedia.</p>
                
                <a href="<?= site_url('asetit') ?>" class="btn btn-outline-info mt-auto stretched-link">
                    Kelola Aset <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>

</div>

<div class="row mt-4 g-4">
    <div class="col-md-5">
        <div class="card card-custom h-100 p-4 border-0 shadow-lg">
            <h5 class="text-white mb-4"><i class="bi bi-pie-chart me-2 text-info"></i>Kondisi Aset IT</h5>
            <div style="position: relative; height:250px; width:100%">
                <canvas id="kondisiChart"></canvas>
            </div>
        </div>
    </div>
    
    <div class="col-md-7">
        <div class="card card-custom h-100 p-4 border-0 shadow-lg">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="text-white m-0"><i class="bi bi-activity me-2 text-warning"></i>Aktivitas Mutasi Terbaru</h5>
                <a href="<?= site_url('logmutasi') ?>" class="btn btn-sm btn-outline-info rounded-pill">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table table-dark-custom table-hover m-0 align-middle">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Referensi</th>
                            <th>Status</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(empty($recent_logs)): ?>
                        <tr><td colspan="4" class="text-center text-muted">Belum ada aktivitas.</td></tr>
                        <?php else: ?>
                            <?php foreach($recent_logs as $log): ?>
                            <tr>
                                <td class="text-muted small"><?= date('d M Y H:i', strtotime($log['tanggal'])) ?></td>
                                <td class="text-white fw-bold"><?= esc($log['no_aktiva']) ?></td>
                                <td>
                                    <?php
                                        $badge = 'bg-secondary';
                                        if($log['status'] == 'MASUK') $badge = 'bg-success';
                                        if($log['status'] == 'KELUAR' || $log['status'] == 'DIHAPUS') $badge = 'bg-danger';
                                        if($log['status'] == 'PINDAH') $badge = 'bg-warning text-dark';
                                        if(in_array($log['status'], ['RUSAK','PERBAIKAN','UPDATE'])) $badge = 'bg-info text-dark';
                                    ?>
                                    <span class="badge <?= $badge ?> rounded-pill px-2"><?= esc($log['status']) ?></span>
                                </td>
                                <td class="text-white-50 small"><?= esc($log['keterangan']) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row mt-5 mb-5">
    <div class="col-12">
        <div class="card card-custom p-4 border-0 shadow-lg">
            <h5 class="text-white mb-3 border-bottom border-secondary pb-3">
                <i class="bi bi-lightning-charge me-2 text-warning"></i>Quick Actions
            </h5>
            <div class="d-flex gap-3 flex-wrap">
                <a href="<?= site_url('catatanit/create') ?>" class="btn btn-neon px-4 py-2">
                    <i class="bi bi-plus-lg me-2"></i>Tambah Data PC
                </a>
                <a href="<?= site_url('catatankerusakan/create') ?>" class="btn btn-outline-secondary text-white px-4 py-2">
                    <i class="bi bi-exclamation-triangle me-2 text-danger"></i>Lapor Rusak
                </a>
                <a href="<?= site_url('barang/create') ?>" class="btn btn-outline-secondary text-white px-4 py-2">
                    <i class="bi bi-box-seam me-2 text-info"></i>Input Aset
                </a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Data for Kondisi Chart
    const kondisiData = <?= json_encode($chart_aset_kondisi ?? []) ?>;
    const labels = [];
    const data = [];
    const bgColors = [];
    
    kondisiData.forEach(item => {
        labels.push(item.kondisi_aset);
        data.push(item.total);
        if (item.kondisi_aset === 'Digunakan') bgColors.push('#22c55e'); // success
        else if (item.kondisi_aset === 'Backup') bgColors.push('#3b82f6'); // info
        else if (item.kondisi_aset === 'Rusak') bgColors.push('#ef4444'); // danger
        else bgColors.push('#6b7280'); // secondary
    });

    if(data.length > 0) {
        new Chart(document.getElementById('kondisiChart'), {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: bgColors,
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: { color: '#9ca3af' }
                    }
                }
            }
        });
    }
});
</script>

<?= view('layout/footer') ?>
