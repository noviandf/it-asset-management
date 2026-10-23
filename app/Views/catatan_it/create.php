<?= view('layout/header') ?>

<div class="row justify-content-center">
<div class="col-md-8">
    <div class="card card-custom">
        <div class="card-header-custom">
            <h4 class="m-0 text-white">Input Data PC Remote</h4>
        </div>
        <div class="card-body">
            <form action="<?= site_url('catatanit/store') ?>" method="post">
                <?= csrf_field() ?>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label text-muted">Nama User / PC</label>
                        <input type="text" name="nama_pc" class="form-control bg-dark text-white border-secondary" placeholder="Ex: Admin Gudang" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted">Ruangan / Lokasi</label>
                        <select name="lokasi" class="form-select bg-dark text-white border-secondary" required>
                            <option value="Ruang Management">Ruang Management</option>
                            <option value="Ruang Agent">Ruang Agent</option>
                            <option value="Ruang Server">Ruang Server</option>
                            <option value="Lantai 3">Lantai 3</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label text-info">IP Address (LAN)</label>
                        <input type="text" name="ip_address" class="form-control bg-dark text-white border-info" placeholder="192.168.x.x">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-danger">Anydesk ID</label>
                        <input type="text" name="anydesk_id" class="form-control bg-dark text-white border-danger fw-bold" placeholder="Contoh: 123456789">
                        <small class="text-muted">*Masukkan angka saja tanpa spasi</small>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted">Keterangan</label>
                    <textarea name="keterangan" class="form-control bg-dark text-white border-secondary" rows="2"></textarea>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-neon px-4">Simpan Data</button>
                    <a href="<?= site_url('catatanit') ?>" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<?= view('layout/footer') ?>