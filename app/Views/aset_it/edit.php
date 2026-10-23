<?= view('layout/header') ?>

<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card card-custom">
            <div class="card-header-custom d-flex justify-content-between align-items-center">
                <h4 class="m-0 text-white"><i class="bi bi-pencil-square me-2"></i>Edit Data Aset IT</h4>
                <a href="<?= site_url('asetit') ?>" class="btn btn-outline-secondary btn-sm rounded-pill"><i class="bi bi-arrow-left"></i> Kembali</a>
            </div>
            <div class="card-body">
                <form action="<?= site_url('asetit/update/'.$aset['id']) ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="p-3 mb-4 rounded border border-secondary bg-dark">
                        <h4 class="text-white text-center m-0 font-monospace"><?= esc($aset['no_aktiva']) ?></h4>
                        <div class="text-center text-muted small">No Aktiva (Tidak dapat diubah)</div>
                    </div>

                    <!-- Informasi Aset Dasar -->
                    <h5 class="text-white mt-4 border-bottom border-secondary pb-2">Informasi Aset</h5>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-muted">Kategori</label>
                            <input type="text" name="kategori" class="form-control bg-dark text-white border-secondary" value="<?= esc($aset['kategori']) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted">Sub Kategori</label>
                            <input type="text" name="sub_kategori" class="form-control bg-dark text-white border-secondary" value="<?= esc($aset['sub_kategori']) ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-muted">Nama Aset</label>
                            <input type="text" name="nama_aset" class="form-control bg-dark text-white border-secondary" value="<?= esc($aset['nama_aset']) ?>" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label text-muted">Merk</label>
                            <input type="text" name="merk" class="form-control bg-dark text-white border-secondary" value="<?= esc($aset['merk']) ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label text-muted">Tipe/Model</label>
                            <input type="text" name="tipe" class="form-control bg-dark text-white border-secondary" value="<?= esc($aset['tipe']) ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-warning fw-bold">Serial Number (S/N)</label>
                        <input type="text" name="serial_number" class="form-control bg-dark text-warning fw-bold border-warning" value="<?= esc($aset['serial_number']) ?>">
                    </div>

                    <!-- Lokasi dan Pengguna -->
                    <h5 class="text-white mt-4 border-bottom border-secondary pb-2">Distribusi & Kondisi</h5>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label class="form-label text-muted">Lantai</label>
                            <input type="text" name="lantai" class="form-control bg-dark text-white border-secondary" value="<?= esc($aset['lantai']) ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label text-muted">Ruangan</label>
                            <select name="ruangan" class="form-select select2 bg-dark text-white border-secondary" required>
                                <option value="Ruang Agent" <?= $aset['ruangan'] == 'Ruang Agent' ? 'selected' : '' ?>>Ruang Agent</option>
                                <option value="Ruang Management" <?= $aset['ruangan'] == 'Ruang Management' ? 'selected' : '' ?>>Ruang Management</option>
                                <option value="Ruang Server" <?= $aset['ruangan'] == 'Ruang Server' ? 'selected' : '' ?>>Ruang Server</option>
                                <option value="Meeting Room" <?= $aset['ruangan'] == 'Meeting Room' ? 'selected' : '' ?>>Meeting Room</option>
                                <option value="Gudang" <?= $aset['ruangan'] == 'Gudang' ? 'selected' : '' ?>>Gudang</option>
                                <option value="Lainnya" <?= $aset['ruangan'] == 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-muted">Pengguna / Penanggung Jawab</label>
                            <input type="text" name="pengguna" class="form-control bg-dark text-white border-secondary" value="<?= esc($aset['pengguna']) ?>">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label text-info">Kondisi Aset</label>
                            <select name="kondisi_aset" class="form-select select2 bg-dark text-info border-info" required>
                                <option value="Digunakan" <?= $aset['kondisi_aset'] == 'Digunakan' ? 'selected' : '' ?>>Digunakan</option>
                                <option value="Backup" <?= $aset['kondisi_aset'] == 'Backup' ? 'selected' : '' ?>>Backup</option>
                                <option value="Rusak" <?= $aset['kondisi_aset'] == 'Rusak' ? 'selected' : '' ?>>Rusak</option>
                                <option value="Dihapus" <?= $aset['kondisi_aset'] == 'Dihapus' ? 'selected' : '' ?>>Dihapus / Disposal</option>
                            </select>
                        </div>
                    </div>

                    <!-- Pembelian & Depresiasi -->
                    <h5 class="text-white mt-4 border-bottom border-secondary pb-2">Informasi Pembelian & Penyusutan</h5>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label text-muted">Tanggal Pembelian</label>
                            <input type="date" name="tanggal_pembelian" class="form-control bg-dark text-white border-secondary" value="<?= esc($aset['tanggal_pembelian']) ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-muted">Vendor / Supplier</label>
                            <input type="text" name="vendor" class="form-control bg-dark text-white border-secondary" value="<?= esc($aset['vendor']) ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-muted">Masa Garansi (Bulan)</label>
                            <input type="number" name="masa_garansi_bulan" class="form-control bg-dark text-white border-secondary" value="<?= esc($aset['masa_garansi_bulan']) ?>">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label class="form-label text-muted">Harga Pembelian (Satuan)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-secondary border-secondary text-white">Rp</span>
                                <input type="number" name="harga_pembelian" class="form-control bg-dark text-white border-secondary" value="<?= esc($aset['harga_pembelian']) ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-muted">Umur Ekonomis (Bulan)</label>
                            <div class="input-group">
                                <input type="number" name="umur_ekonomis_bulan" class="form-control bg-dark text-white border-secondary" value="<?= esc($aset['umur_ekonomis_bulan']) ?>">
                                <span class="input-group-text bg-secondary border-secondary text-white">Bulan</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-muted">Keterangan Lain</label>
                            <input type="text" name="keterangan" class="form-control bg-dark text-white border-secondary" value="<?= esc($aset['keterangan']) ?>">
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="<?= site_url('asetit/delete/'.$aset['id']) ?>" class="btn btn-outline-danger" onclick="return confirm('Yakin ingin menghapus aset ini? Data mutasi yang terkait bisa menjadi error.')">Hapus Aset</a>
                        <button type="submit" class="btn btn-neon px-5 py-2"><i class="bi bi-save me-2"></i>Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= view('layout/footer') ?>
