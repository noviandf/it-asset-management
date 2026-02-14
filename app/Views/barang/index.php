<?= view('layout/header') ?>

<div class="card card-custom">
    <div class="card-header-custom d-flex justify-content-between align-items-center">
        <h4 class="m-0 text-white"><i class="bi bi-box-seam me-2"></i>Distribusi Aset IT</h4>
        <a href="<?= site_url('barang/create') ?>" class="btn btn-neon btn-sm px-3 rounded-pill">
            <i class="bi bi-plus-lg me-1"></i> Input Barang
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-dark-custom table-hover m-0 align-middle text-center">
                <thead>
                    <tr>
                        <th class="ps-4 text-start">No</th>
                        <th class="text-start">Nama Barang</th>
                        <th><i class="bi bi-headset text-info"></i> Agent</th>
                        <th><i class="bi bi-briefcase text-warning"></i> Mgt</th>
                        <th><i class="bi bi-hdd-rack text-danger"></i> Srv</th>
                        <th class="border-start border-secondary"><i class="bi bi-archive text-muted"></i> Backup</th>
                        <th><i class="bi bi-x-circle text-danger"></i> Rusak</th>
                        <th>Total</th> <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach($barang as $b): 
                        // Hitung Total Otomatis
                        $total = $b['stok_agent'] + $b['stok_management'] + $b['stok_server'] + $b['backup'] + $b['rusak'];
                    ?>
                    <tr>
                        <td class="ps-4 text-muted text-start"><?= $no++ ?></td>
                        <td class="text-start">
                            <div class="fw-bold text-white"><?= esc($b['nama_barang']) ?></div>
                            <span class="badge bg-dark border border-secondary text-secondary rounded-pill small"><?= esc($b['kategori']) ?></span>
                        </td>
                        
                        <td class="text-info bg-info bg-opacity-10 fw-bold"><?= $b['stok_agent'] ?: '-' ?></td>
                        <td class="text-warning bg-warning bg-opacity-10 fw-bold"><?= $b['stok_management'] ?: '-' ?></td>
                        <td class="text-danger bg-danger bg-opacity-10 fw-bold"><?= $b['stok_server'] ?: '-' ?></td>
                        
                        <td class="text-muted border-start border-secondary"><?= $b['backup'] ?></td>
                        <td class="text-danger"><?= $b['rusak'] ?></td>
                        
                        <td class="fw-bold text-white h5 m-0"><?= $total ?></td>

                        <td class="text-end pe-4">
                            <div class="btn-group">
                                <a href="<?= site_url('barang/edit/'.$b['id']) ?>" class="btn btn-outline-warning btn-sm"><i class="bi bi-pencil"></i></a>
                                <a href="<?= site_url('barang/delete/'.$b['id']) ?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Hapus data ini?')"><i class="bi bi-trash"></i></a>
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