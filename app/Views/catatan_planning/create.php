<?= view('layout/header') ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-custom">
            <div class="card-header card-header-custom d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-white"><i class="bi bi-calendar-plus me-2"></i>Tambah Catatan Planning</h5>
                <a href="<?= site_url('catatanplanning') ?>" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
            </div>
            <div class="card-body">
                <form action="<?= site_url('catatanplanning/store') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label text-muted">Rencana Kegiatan (Judul)</label>
                        <input type="text" name="judul" class="form-control bg-dark text-white border-secondary" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted">Deskripsi Detail</label>
                        <textarea name="deskripsi" class="form-control bg-dark text-white border-secondary" rows="3" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">PIC (Penanggung Jawab)</label>
                            <input type="text" name="pic" class="form-control bg-dark text-white border-secondary" placeholder="Contoh: Admin">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label text-muted">Target Tanggal Selesai</label>
                            <input type="date" name="tanggal" class="form-control bg-dark text-white border-secondary" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label text-muted">Status</label>
                        <select name="status" class="form-control bg-dark text-white border-secondary">
                            <option value="PENDING">Pending (Belum Terlaksana)</option>
                            <option value="IN SUBMISSION">In Submission (Dalam Pengajuan)</option>
                            <option value="IN PROGRESS">In Progress (Sedang Dikerjakan)</option>
                            <option value="DONE">Done (Selesai)</option>
                            <option value="CANCELED">Canceled (Dibatalkan)</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-neon w-100"><i class="bi bi-save me-1"></i> Simpan Plan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= view('layout/footer') ?>