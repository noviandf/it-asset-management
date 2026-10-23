<?= view('layout/header') ?>

<div class="card card-custom">
    <div class="card-header-custom d-flex justify-content-between align-items-center">
        <h4 class="m-0 text-white"><i class="bi bi-calendar-check me-2"></i>IT Planning & To-Do</h4>
        <a href="<?= site_url('catatanplanning/create') ?>" class="btn btn-neon btn-sm px-3 rounded-pill">
            <i class="bi bi-plus-lg me-1"></i> Buat Plan
        </a>
    </div>
    
    <div class="card-body p-0">
        <!-- Filter Buttons -->
        <div class="px-3 py-3 border-bottom border-secondary bg-dark bg-opacity-25 d-flex gap-2 flex-wrap">
            <span class="text-muted small align-self-center me-2"><i class="bi bi-funnel"></i> Quick Filter:</span>
            <button class="btn btn-sm btn-primary active dt-filter-btn" data-filter="all">Semua</button>
            <button class="btn btn-sm btn-outline-secondary dt-filter-btn" data-filter="PENDING">Pending</button>
            <button class="btn btn-sm btn-outline-secondary dt-filter-btn" data-filter="IN SUBMISSION">In Submission</button>
            <button class="btn btn-sm btn-outline-secondary dt-filter-btn" data-filter="IN PROGRESS">In Progress</button>
            <button class="btn btn-sm btn-outline-secondary dt-filter-btn" data-filter="DONE">Done</button>
            <button class="btn btn-sm btn-outline-secondary dt-filter-btn" data-filter="CANCELED">Canceled</button>
        </div>

        <div class="table-responsive">
            <table class="table table-dark-custom table-hover m-0 align-middle">
                <thead>
                    <tr>
                        <th class="ps-4">No</th>
                        <th>Rencana Kegiatan & PIC</th>
                        <th>Timeline</th>
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
                            <small class="text-white-50 d-block mb-1"><?= esc($p['deskripsi']) ?></small>
                            <?php if(!empty($p['pic'])): ?>
                                <span class="badge bg-secondary border border-secondary text-light"><i class="bi bi-person-circle me-1"></i> <?= esc($p['pic']) ?></span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="d-flex flex-column gap-1">
                                <div class="text-white-50">
                                    <i class="bi bi-bullseye me-1 text-warning"></i> 
                                    Target: <span class="text-white"><?= date('d M Y', strtotime($p['tanggal'])) ?></span>
                                </div>

                                <?php if ($p['status'] == 'DONE' && !empty($p['tanggal_selesai'])): ?>
                                    <div class="text-white-50">
                                        <i class="bi bi-check-circle-fill me-1 text-success"></i> 
                                        Selesai: <span class="text-success fw-bold"><?= date('d M Y', strtotime($p['tanggal_selesai'])) ?></span>
                                    </div>
                                    <?php
                                        $target = new DateTime($p['tanggal']);
                                        $selesai = new DateTime($p['tanggal_selesai']);
                                        if ($selesai <= $target) {
                                            echo '<small class="text-success fst-italic">(On Time)</small>';
                                        } else {
                                            $delay = $target->diff($selesai)->days;
                                            echo '<small class="text-danger fst-italic">(Terlambat '.$delay.' hari)</small>';
                                        }
                                    ?>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td>
                            <?php if ($p['status'] == 'DONE'): ?>
                                <span class="badge bg-success bg-opacity-25 text-success border border-success px-3 rounded-pill">
                                    <i class="bi bi-check-all me-1"></i> DONE
                                </span>
                            <?php elseif ($p['status'] == 'IN PROGRESS'): ?>
                                <span class="badge bg-primary bg-opacity-25 text-primary border border-primary px-3 rounded-pill">
                                    <i class="bi bi-play-circle me-1"></i> IN PROGRESS
                                </span>
                            <?php elseif ($p['status'] == 'IN SUBMISSION'): ?>
                                <span class="badge bg-info bg-opacity-25 text-info border border-info px-3 rounded-pill">
                                    <i class="bi bi-hourglass-split me-1"></i> IN SUBMISSION
                                </span>
                            <?php elseif ($p['status'] == 'CANCELED'): ?>
                                <span class="badge bg-danger bg-opacity-25 text-danger border border-danger px-3 rounded-pill">
                                    <i class="bi bi-x-circle me-1"></i> CANCELED
                                </span>
                            <?php else: ?>
                                <span class="badge bg-warning bg-opacity-10 text-warning border border-warning px-3 rounded-pill">
                                    <i class="bi bi-pause-circle me-1"></i> PENDING
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