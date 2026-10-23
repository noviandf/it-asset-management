<?= view('layout/header') ?>

<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card card-custom">
            <div class="card-header-custom d-flex justify-content-between align-items-center">
                <h4 class="m-0 text-white"><i class="bi bi-magic me-2"></i>Generate Aset IT Multiple</h4>
                <a href="<?= site_url('asetit') ?>" class="btn btn-outline-secondary btn-sm rounded-pill"><i class="bi bi-arrow-left"></i> Kembali</a>
            </div>
            <div class="card-body">
                <form action="<?= site_url('asetit/store_multiple') ?>" method="post">
                    <?= csrf_field() ?>

                    <!-- Bagian Generate No Aktiva -->
                    <div class="p-3 mb-4 rounded border border-info bg-info bg-opacity-10">
                        <h5 class="text-info mb-3"><i class="bi bi-upc-scan me-2"></i>Pola Nomor Aktiva</h5>
                        <div class="row">
                            <div class="col-md-5">
                                <label class="form-label text-white">Prefix (Awalan)</label>
                                <input type="text" name="prefix_aktiva" class="form-control bg-dark text-white border-secondary" placeholder="Contoh: TGA-MON-2024-" required>
                                <small class="text-muted">Gunakan tanda hubung (-) di akhir jika perlu.</small>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label text-white">Mulai Dari Angka</label>
                                <input type="number" name="start_angka" class="form-control bg-dark text-white border-secondary" value="1" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-warning fw-bold">Jumlah Barang Dibuat</label>
                                <input type="number" name="jumlah_generate" class="form-control bg-warning text-dark fw-bold border-warning" value="1" min="1" max="50" required>
                                <small class="text-muted">Maksimal 50 baris sekaligus.</small>
                            </div>
                        </div>
                    </div>

                    <!-- Informasi Aset Dasar -->
                    <h5 class="text-white mt-4 border-bottom border-secondary pb-2">Informasi Aset (Berlaku untuk semua)</h5>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-muted">Kategori</label>
                            <input type="text" name="kategori" class="form-control bg-dark text-white border-secondary" placeholder="Contoh: Office Equipment Assets" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted">Sub Kategori</label>
                            <input type="text" name="sub_kategori" class="form-control bg-dark text-white border-secondary" placeholder="Contoh: TV / Laptop / Printer">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label text-muted">Nama Aset</label>
                            <input type="text" name="nama_aset" class="form-control bg-dark text-white border-secondary" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label text-muted">Merk</label>
                            <input type="text" name="merk" class="form-control bg-dark text-white border-secondary">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label text-muted">Tipe/Model</label>
                            <input type="text" name="tipe" class="form-control bg-dark text-white border-secondary">
                        </div>
                    </div>

                    <!-- Lokasi dan Pengguna -->
                    <h5 class="text-white mt-4 border-bottom border-secondary pb-2">Distribusi Awal</h5>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label text-muted">Lantai</label>
                            <input type="text" name="lantai" class="form-control bg-dark text-white border-secondary">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-muted">Ruangan</label>
                            <select name="ruangan" class="form-select select2 bg-dark text-white border-secondary" required>
                                <option value="Ruang Agent">Ruang Agent</option>
                                <option value="Ruang Management">Ruang Management</option>
                                <option value="Ruang Server">Ruang Server</option>
                                <option value="Meeting Room">Meeting Room</option>
                                <option value="Gudang">Gudang</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-muted">Pengguna / Penanggung Jawab</label>
                            <input type="text" name="pengguna" class="form-control bg-dark text-white border-secondary" placeholder="Contoh: Budi, atau Meja 1">
                            <small class="text-muted">Opsional jika dipakai bersama.</small>
                        </div>
                    </div>

                    <!-- Pembelian & Depresiasi -->
                    <h5 class="text-white mt-4 border-bottom border-secondary pb-2">Informasi Pembelian & Penyusutan</h5>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label text-muted">Tanggal Pembelian</label>
                            <input type="date" name="tanggal_pembelian" class="form-control bg-dark text-white border-secondary">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-muted">Vendor / Supplier</label>
                            <input type="text" name="vendor" class="form-control bg-dark text-white border-secondary">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-muted">Masa Garansi (Bulan)</label>
                            <input type="number" name="masa_garansi_bulan" class="form-control bg-dark text-white border-secondary">
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label class="form-label text-muted">Harga Pembelian (Satuan)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-secondary border-secondary text-white">Rp</span>
                                <input type="number" name="harga_pembelian" class="form-control bg-dark text-white border-secondary" value="0">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-muted">Umur Ekonomis (Bulan)</label>
                            <div class="input-group">
                                <input type="number" name="umur_ekonomis_bulan" class="form-control bg-dark text-white border-secondary" value="36">
                                <span class="input-group-text bg-secondary border-secondary text-white">Bulan</span>
                            </div>
                            <small class="text-muted">Standard IT = 36 Bln (3 Tahun)</small>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-muted">Keterangan Lain</label>
                            <input type="text" name="keterangan" class="form-control bg-dark text-white border-secondary">
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-neon px-5 py-2 fs-5"><i class="bi bi-lightning-charge-fill me-2"></i>Generate Aset Sekarang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= view('layout/footer') ?>
