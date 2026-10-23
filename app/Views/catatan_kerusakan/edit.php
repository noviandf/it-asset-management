<?= view('layout/header') ?>

<div class="row justify-content-center">
    <div class="col-md-9">
        <div class="card card-custom">
            <div class="card-header-custom">
                <h4 class="m-0 text-white">Update Status Perbaikan</h4>
            </div>
            <div class="card-body">
                <form action="<?= site_url('catatankerusakan/update/'.$kerusakan['id']) ?>" method="post">
                    <?= csrf_field() ?>
                    
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label class="form-label text-info">Aset yang Rusak (Pilih dari Daftar)</label>
                            <select name="barang_id" class="form-select bg-dark text-white border-secondary">
                                <option value="">-- Bukan Aset Terdaftar --</option>
                                <?php foreach($barang as $b): ?>
                                    <option value="<?= $b['id'] ?>" <?= ($kerusakan['barang_id'] ?? null) == $b['id'] ? 'selected' : '' ?>><?= esc($b['no_aktiva']) ?> - <?= esc($b['nama_aset']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-muted">Jumlah</label>
                            <input type="number" name="jumlah" class="form-control bg-dark text-white border-secondary" value="<?= esc($kerusakan['jumlah']) ?>" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-muted">Ruang / Lokasi</label>
                            <select name="ruang" class="form-control bg-dark text-white border-secondary">
                                <option value="Ruang Agent" <?= $kerusakan['ruang'] == 'Ruang Agent' ? 'selected' : '' ?>>Ruang Agent</option>
                                <option value="Ruang Management" <?= $kerusakan['ruang'] == 'Ruang Management' ? 'selected' : '' ?>>Ruang Management</option>
                                <option value="Ruang Server" <?= $kerusakan['ruang'] == 'Ruang Server' ? 'selected' : '' ?>>Ruang Server</option>
                                <option value="Gudang" <?= $kerusakan['ruang'] == 'Gudang' ? 'selected' : '' ?>>Gudang</option>
                                <option value="Lainnya" <?= $kerusakan['ruang'] == 'Lainnya' ? 'selected' : '' ?>>Lainnya</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-danger">Tingkat Kerusakan</label>
                            <select name="tingkat_rusak" class="form-control bg-dark text-white border-secondary">
                                <option value="Ringan" <?= $kerusakan['tingkat_rusak'] == 'Ringan' ? 'selected' : '' ?>>Ringan</option>
                                <option value="Sedang" <?= $kerusakan['tingkat_rusak'] == 'Sedang' ? 'selected' : '' ?>>Sedang</option>
                                <option value="Berat" <?= $kerusakan['tingkat_rusak'] == 'Berat' ? 'selected' : '' ?>>Berat</option>
                                <option value="Mati Total" <?= $kerusakan['tingkat_rusak'] == 'Mati Total' ? 'selected' : '' ?>>Mati Total</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3 p-3 rounded border border-secondary bg-opacity-10 bg-black mx-1">
                        <div class="col-md-4 mb-2">
                            <label class="form-label text-warning">Status Perbaikan</label>
                            <select name="status_perbaikan" class="form-control bg-dark text-white border-secondary">
                                <option value="Belum Diperbaiki" <?= $kerusakan['status_perbaikan'] == 'Belum Diperbaiki' ? 'selected' : '' ?>>Belum Diperbaiki</option>
                                <option value="Proses Perbaikan" <?= $kerusakan['status_perbaikan'] == 'Proses Perbaikan' ? 'selected' : '' ?>>Proses Perbaikan</option>
                                <option value="Ajukan Penggantian" <?= $kerusakan['status_perbaikan'] == 'Ajukan Penggantian' ? 'selected' : '' ?>>Ajukan Penggantian</option>
                                <option value="Selesai Perbaikan" <?= $kerusakan['status_perbaikan'] == 'Selesai Perbaikan' ? 'selected' : '' ?>>Selesai Perbaikan</option>
                                <option value="Diganti Baru" <?= $kerusakan['status_perbaikan'] == 'Diganti Baru' ? 'selected' : '' ?>>Diganti Baru</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="form-label text-info">Tgl Lapor</label>
                            <input type="date" name="tanggal_catat" class="form-control bg-dark text-white border-info" value="<?= esc($kerusakan['tanggal_catat']) ?>" required>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="form-label text-success">Tgl Selesai</label>
                            <input type="date" name="tanggal_selesai" class="form-control bg-dark text-white border-success" value="<?= esc($kerusakan['tanggal_selesai']) ?>">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">Deskripsi Kerusakan</label>
                        <textarea name="deskripsi_kerusakan" class="form-control bg-dark text-white border-secondary" rows="2"><?= esc($kerusakan['deskripsi_kerusakan']) ?></textarea>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label text-muted">Estimasi Biaya</label>
                            <input type="number" name="estimasi_biaya" class="form-control bg-dark text-white border-secondary" value="<?= esc($kerusakan['estimasi_biaya']) ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted">Catatan Solusi</label>
                            <input type="text" name="keterangan" class="form-control bg-dark text-white border-secondary" value="<?= esc($kerusakan['keterangan']) ?>">
                        </div>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-neon px-4">Update Laporan</button>
                        <a href="<?= site_url('catatankerusakan') ?>" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= view('layout/footer') ?>