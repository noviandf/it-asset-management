<?= view('layout/header') ?>

<h3>Tambah Barang IT</h3>
<form action="<?= site_url('barang/store') ?>" method="post">
    <div class="mb-2">
        <label>Nama Barang</label>
        <input type="text" name="nama_barang" class="form-control" required>
    </div>
    <div class="mb-2">
        <label>Kategori</label>
        <input type="text" name="kategori" class="form-control" required>
    </div>
    <div class="mb-2">
        <label>Jumlah Stok</label>
        <input type="number" name="jumlah_stok" class="form-control" required>
    </div>
    <div class="mb-2">
        <label>Backup</label>
        <input type="number" name="backup" class="form-control" required>
    </div>
    <div class="mb-2">
        <label>Rusak</label>
        <input type="number" name="rusak" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
</form>

<?= view('layout/footer') ?>
