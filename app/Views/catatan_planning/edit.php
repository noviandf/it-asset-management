<?= view('layout/header') ?>

<div class="container mt-4">
    <h3>Edit Catatan Planning</h3>
    <form action="/catatanplanning/update/<?= $planning['id'] ?>" method="post">
        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" value="<?= esc($planning['judul']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" required><?= esc($planning['deskripsi']) ?></textarea>
        </div>
        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="<?= esc($planning['tanggal']) ?>" required>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="Belum Terlaksana" <?= ($planning['status'] == 'Belum Terlaksana') ? 'selected' : '' ?>>Belum Terlaksana</option>
                <option value="Terlaksana" <?= ($planning['status'] == 'Terlaksana') ? 'selected' : '' ?>>Terlaksana</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="/catatanplanning" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<?= view('layout/footer') ?>