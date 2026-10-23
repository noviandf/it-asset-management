<?= view('layout/header') ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-custom">
            <div class="card-header-custom d-flex justify-content-between align-items-center">
                <h4 class="m-0 text-white"><i class="bi bi-pencil-square me-2"></i>Edit Catatan IT Harian</h4>
                <a href="<?= site_url('catatanit') ?>" class="btn btn-outline-secondary btn-sm rounded-pill"><i class="bi bi-arrow-left"></i> Kembali</a>
            </div>
            <div class="card-body">
                <form action="<?= site_url('catatanit/update/'.$catatan['id']) ?>" method="post">
                    <?= csrf_field() ?>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-muted">Nama Perangkat</label>
                            <input type="text" name="nama_pc" class="form-control bg-dark text-white border-secondary" value="<?= esc($catatan['nama_pc']) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted">Ruangan / Lokasi</label>
                            <select name="lokasi" class="form-select bg-dark text-white border-secondary" required>
                                <option value="Ruang Management" <?= ($catatan['lokasi'] ?? '') == 'Ruang Management' ? 'selected' : '' ?>>Ruang Management</option>
                                <option value="Ruang Agent" <?= ($catatan['lokasi'] ?? '') == 'Ruang Agent' ? 'selected' : '' ?>>Ruang Agent</option>
                                <option value="Ruang Server" <?= ($catatan['lokasi'] ?? '') == 'Ruang Server' ? 'selected' : '' ?>>Ruang Server</option>
                                <option value="Lantai 3" <?= ($catatan['lokasi'] ?? '') == 'Lantai 3' ? 'selected' : '' ?>>Lantai 3</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-muted">IP Address</label>
                            <input type="text" name="ip_address" class="form-control bg-dark text-white border-secondary" value="<?= esc($catatan['ip_address']) ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-warning fw-bold">Anydesk ID</label>
                            <input type="text" name="anydesk_id" class="form-control bg-dark text-warning fw-bold border-warning" value="<?= esc($catatan['anydesk_id']) ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">Tanggal Catat</label>
                        <input type="date" name="tanggal_catat" class="form-control bg-dark text-white border-secondary" value="<?= esc($catatan['tanggal_catat']) ?>">
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-muted">Keterangan</label>
                        <textarea name="keterangan" class="form-control bg-dark text-white border-secondary" rows="3"><?= esc($catatan['keterangan']) ?></textarea>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-neon px-5 py-2"><i class="bi bi-save me-2"></i>Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= view('layout/footer') ?>