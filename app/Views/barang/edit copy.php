<?= view('layout/header') ?>
<h3>Edit Barang IT</h3>
<form action="<?= site_url('barang/update/'.$barang['id']) ?>" method="post">
    <div class="mb-2">
        <label>Nama Barang</label>
        <input type="text" name="nama_barang" class="form-control" value="<?= esc($barang['nama_barang']) ?>">
    </div>
    <div class="mb-2">
        <label>Kategori</label>
        <input type="text" name="kategori" class="form-control" value="<?= esc($barang['kategori']) ?>">
    </div>
    <div class="mb-2">
        <label>Jumlah Stok</label>
        <input type="number" name="jumlah_stok" class="form-control" value="<?= esc($barang['jumlah_stok']) ?>">
    </div>
    <div class="mb-2">
        <label>Backup</label>
        <input type="number" name="backup" class="form-control" value="<?= esc($barang['backup']) ?>">
    </div>
    <div class="mb-2">
        <label>Rusak</label>
        <input type="number" name="rusak" class="form-control" value="<?= esc($barang['rusak']) ?>">
    </div>
    <button type="submit" class="btn btn-success">Update</button>
</form>
<?= view('layout/footer') ?>
