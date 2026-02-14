<?= view('layout/header') ?>
<h3>Edit Catatan IT Harian</h3>
<form action="<?= site_url('catatanit/update/'.$catatan['id']) ?>" method="post">
    <div class="mb-2">
        <label>Nama Perangkat</label>
        <input type="text" name="nama_pc" class="form-control" value="<?= esc($catatan['nama_pc']) ?>">
    </div>
    
    <div class="mb-2">
        <label>IP Address</label>
        <input type="text" name="ip_address" class="form-control" value="<?= esc($catatan['ip_address']) ?>">
    </div>

    <div class="mb-2">
        <label>Anydesk ID</label>
        <input type="text" name="anydesk_id" class="form-control" value="<?= esc($catatan['anydesk_id']) ?>">
    </div>

    <div class="mb-2">
        <label>Tanggal Catat</label>
        <input type="date" name="tanggal_catat" class="form-control" value="<?= esc($catatan['tanggal_catat']) ?>">
    </div>
    <div class="mb-2">
        <label>Keterangan</label>
        <textarea name="keterangan" class="form-control"><?= esc($catatan['keterangan']) ?></textarea>
    </div>
    <button type="submit" class="btn btn-success">Update</button>
</form>
<?= view('layout/footer') ?>