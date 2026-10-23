<?= view('layout/header') ?>

<div class="row justify-content-center">
    <div class="col-md-9">
        <div class="card card-custom">
            <div class="card-header-custom">
                <h4 class="m-0 text-white">Input Laporan Kerusakan</h4>
            </div>
            <div class="card-body">
                <form action="<?= site_url('catatankerusakan/store') ?>" method="post">
                    <?= csrf_field() ?>
                    
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label class="form-label text-info">Barang IT yang Rusak</label>
                            <select name="barang_id" class="form-select bg-dark text-white border-secondary">
                                <option value="">-- Bukan Aset Terdaftar --</option>
                                <?php foreach ($barang as $b): ?>
                                    <option value="<?= $b['id'] ?>"><?= esc($b['no_aktiva']) ?> - <?= esc($b['nama_aset']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-muted">Jumlah</label>
                            <input type="number" name="jumlah" class="form-control bg-dark text-white border-secondary" value="1" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-muted">Ruang / Lokasi</label>
                            <select name="ruang" class="form-control bg-dark text-white border-secondary">
                                <option value="Ruang Agent">Ruang Agent</option>
                                <option value="Ruang Management">Ruang Management</option>
                                <option value="Ruang Server">Ruang Server</option>
                                <option value="Gudang">Gudang</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-danger">Tingkat Kerusakan</label>
                            <select name="tingkat_rusak" class="form-control bg-dark text-white border-secondary">
                                <option value="Ringan">Ringan (Masih bisa dipakai)</option>
                                <option value="Sedang">Sedang (Perlu perbaikan segera)</option>
                                <option value="Berat">Berat (Rusak parah)</option>
                                <option value="Mati Total">Mati Total</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-info">Status Awal</label>
                            <select name="status_perbaikan" class="form-control bg-dark text-white border-secondary">
                                <option value="Belum Diperbaiki">Belum Diperbaiki</option>
                                <option value="Proses Perbaikan">Proses Perbaikan</option>
                                <option value="Ajukan Penggantian">Ajukan Penggantian</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted">Tanggal Kejadian</label>
                            <input type="date" name="tanggal_catat" class="form-control bg-dark text-white border-secondary" value="<?= date('Y-m-d') ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">Deskripsi Masalah (Detail)</label>
                        <textarea name="deskripsi_kerusakan" class="form-control bg-dark text-white border-secondary" rows="2" placeholder="Contoh: Tinta tidak keluar..."></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-muted">Keterangan Tambahan</label>
                        <input type="text" name="keterangan" class="form-control bg-dark text-white border-secondary">
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-neon px-4">Simpan Laporan</button>
                        <a href="<?= site_url('catatankerusakan') ?>" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= view('layout/footer') ?>