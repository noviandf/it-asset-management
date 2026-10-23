<?= $this->include('layout/header') ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card card-custom">
            <div class="card-header card-header-custom d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-white"><i class="bi bi-person-plus me-2"></i>Tambah User</h5>
                <a href="<?= site_url('user') ?>" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
            </div>
            <div class="card-body">
                <form action="<?= site_url('user/store') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label text-muted">Username</label>
                        <input type="text" name="username" class="form-control bg-dark text-white border-secondary" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label text-muted">Password</label>
                        <input type="password" name="password" class="form-control bg-dark text-white border-secondary" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100"><i class="bi bi-save me-1"></i> Simpan User</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->include('layout/footer') ?>
