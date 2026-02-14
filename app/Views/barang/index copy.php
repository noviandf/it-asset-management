<?= view('layout/header') ?>

<div class="card card-custom">
    <div class="card-header-custom d-flex justify-content-between align-items-center">
        <h4 class="m-0 text-white"><i class="bi bi-box-seam me-2"></i>Data Stok Barang IT</h4>
        <a href="<?= site_url('barang/create') ?>" class="btn btn-neon btn-sm px-3 rounded-pill">
            <i class="bi bi-plus-lg me-1"></i> Tambah Baru
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-dark-custom table-hover m-0 align-middle">
                <thead>
                    <tr>
                        <th class="ps-4">No</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Backup</th>
                        <th>Rusak</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach($barang as $b): ?>
                    <tr>
                        <td class="ps-4 text-muted"><?= $no++ ?></td>
                        <td class="fw-bold"><?= esc($b['nama_barang']) ?></td>
                        <td><span class="badge bg-dark border border-secondary text-secondary rounded-pill"><?= esc($b['kategori']) ?></span></td>
                        <td class="text-info fw-bold"><?= esc($b['jumlah_stok']) ?></td>
                        <td class="text-warning"><?= esc($b['backup']) ?></td>
                        <td class="text-danger"><?= esc($b['rusak']) ?></td>
                        <td class="text-end pe-4">
                            <div class="btn-group">
                                <a href="<?= site_url('barang/edit/'.$b['id']) ?>" class="btn btn-outline-warning btn-sm" title="Edit"><i class="bi bi-pencil"></i></a>
                                <a href="<?= site_url('barang/delete/'.$b['id']) ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Yakin hapus?')" title="Hapus"><i class="bi bi-trash"></i></a>
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