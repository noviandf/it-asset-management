<?= $this->include('layout/header') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="mb-0 text-white"><i class="bi bi-people me-2"></i>User Management</h3>
    <a href="<?= site_url('user/create') ?>" class="btn btn-primary"><i class="bi bi-plus-lg me-1"></i> Tambah User</a>
</div>

<div class="card card-custom">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-dark-custom table-hover">
                <thead>
                    <tr>
                        <th width="50">ID</th>
                        <th>Username</th>
                        <th width="150" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= $user['username'] ?></td>
                        <td class="text-center">
                            <a href="<?= site_url('user/edit/'.$user['id']) ?>" class="btn btn-sm btn-info text-white"><i class="bi bi-pencil-square"></i></a>
                            <?php if($user['username'] !== 'admin'): ?>
                            <a href="<?= site_url('user/delete/'.$user['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus user ini?')"><i class="bi bi-trash"></i></a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->include('layout/footer') ?>
