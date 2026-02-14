<?= view('layout/header') ?>

<div class="row justify-content-center">
    <div class="col-md-9">
        <div class="card card-custom">
            <div class="card-header-custom">
                <h4 class="m-0 text-white">Update Distribusi Aset</h4>
            </div>
            <div class="card-body">
                <form action="<?= site_url('barang/update/'.$barang['id']) ?>" method="post">
                    
                    <div class="row mb-4">
                        <div class="col-md-7">
                            <label class="form-label text-muted">Nama Barang</label>
                            <input type="text" name="nama_barang" class="form-control bg-dark text-white border-secondary" value="<?= esc($barang['nama_barang']) ?>" required>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label text-muted">Kategori</label>
                            <input type="text" name="kategori" class="form-control bg-dark text-white border-secondary" value="<?= esc($barang['kategori']) ?>" required>
                        </div>
                    </div>

                    <h6 class="text-info border-bottom border-secondary pb-2 mb-3">
                        <i class="bi bi-geo-alt me-2"></i>Update Sebaran Lokasi
                    </h6>
                    
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label class="form-label text-info small">Ruang Agent</label>
                            <input type="number" name="stok_agent" class="form-control bg-dark text-white border-info" value="<?= esc($barang['stok_agent']) ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-warning small">Ruang Management</label>
                            <input type="number" name="stok_management" class="form-control bg-dark text-white border-warning" value="<?= esc($barang['stok_management']) ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-danger small">Ruang Server</label>
                            <input type="number" name="stok_server" class="form-control bg-dark text-white border-danger" value="<?= esc($barang['stok_server']) ?>">
                        </div>
                    </div>

                    <h6 class="text-muted border-bottom border-secondary pb-2 mb-3">
                        <i class="bi bi-archive me-2"></i>Update Gudang
                    </h6>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label text-white small">Unit Backup (Ready)</label>
                            <input type="number" name="backup" class="form-control bg-dark text-white border-secondary" value="<?= esc($barang['backup']) ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-danger small">Unit Rusak</label>
                            <input type="number" name="rusak" class="form-control bg-dark text-white border-danger" value="<?= esc($barang['rusak']) ?>">
                        </div>
                    </div>

                    <div class="d-flex gap-2 pt-2">
                        <button type="submit" class="btn btn-neon px-4">Simpan Perubahan</button>
                        <a href="<?= site_url('barang') ?>" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= view('layout/footer') ?>