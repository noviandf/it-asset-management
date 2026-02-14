<?= view('layout/header') ?>

<div class="container mt-4">
    <h3>Tambah Catatan Planning</h3>
    <form action="/catatanplanning/store" method="post">
        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="Belum Terlaksana">Belum Terlaksana</option>
                <option value="Terlaksana">Terlaksana</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="/catatanplanning" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<?= view('layout/footer') ?>