<?= view('layout/header') ?>

<div class="card card-custom">
    <div class="card-header-custom d-flex justify-content-between align-items-center">
        <div>
            <h4 class="m-0 text-white"><i class="bi bi-list-check me-2"></i>Detail Aset: <?= esc($nama_aset_filter ?? 'Semua Barang') ?></h4>
        </div>
        <div class="d-flex gap-2">
            <a href="<?= site_url('asetit') ?>" class="btn btn-outline-secondary btn-sm px-3 rounded-pill">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Summary
            </a>
            <a href="<?= site_url('logmutasi') ?>" class="btn btn-outline-info btn-sm px-3 rounded-pill">
                <i class="bi bi-clock-history me-1"></i> Log Mutasi
            </a>
            <a href="<?= site_url('asetit/create_multiple') ?>" class="btn btn-neon btn-sm px-3 rounded-pill">
                <i class="bi bi-plus-lg me-1"></i> Input Barang Baru
            </a>
        </div>
    </div>
    
    <div class="card-body p-0">
        <!-- Bulk Action Bar -->
        <div id="bulk-action-bar" class="d-none bg-dark bg-opacity-50 border-bottom border-secondary p-3 d-flex justify-content-between align-items-center" style="transition: all 0.3s ease;">
            <div class="text-white d-flex align-items-center">
                <span class="badge btn-neon px-3 py-2 me-2" id="selected-count" style="font-size: 0.95rem; font-weight: bold; border-radius: 50px;">0</span>
                <span class="small text-white-50">aset terpilih untuk aksi massal</span>
            </div>
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-sm btn-outline-info px-3 rounded-pill" id="bulk-print-btn">
                    <i class="bi bi-printer me-1"></i> Cetak Label QR
                </button>
                <button type="button" class="btn btn-sm btn-outline-warning px-3 rounded-pill" data-bs-toggle="modal" data-bs-target="#bulkEditModal">
                    <i class="bi bi-pencil me-1"></i> Ubah Massal
                </button>
                <button type="button" class="btn btn-sm btn-outline-danger px-3 rounded-pill" id="bulk-delete-btn">
                    <i class="bi bi-trash me-1"></i> Hapus Terpilih
                </button>
            </div>
        </div>

        <div class="px-3 py-2 border-bottom border-secondary bg-dark bg-opacity-25 d-flex align-items-center">
            <span class="text-white-50 small me-3"><i class="bi bi-check-all"></i> Pilihan Cepat:</span>
            <button type="button" id="btn-select-all-page" class="btn btn-sm btn-outline-secondary rounded-pill px-3 me-2" style="font-size: 0.8rem;">
                Pilih Semua
            </button>
            <button type="button" id="btn-deselect-all-page" class="btn btn-sm btn-outline-secondary rounded-pill px-3" style="font-size: 0.8rem;">
                Batal Pilih
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-dark-custom table-hover m-0 align-middle">
                <thead>
                    <tr>
                        <th class="ps-4 text-center" width="40">
                            <input type="checkbox" id="select-all" class="form-check-input">
                        </th>
                        <th>No Aktiva</th>
                        <th>Kategori</th>
                        <th>Nama Aset</th>
                        <th>S/N</th>
                        <th>Lokasi & Kondisi</th>
                        <th>Info Pembelian</th>
                        <th>Penyusutan & Nilai</th>
                        <th>Keterangan</th>
                        <th class="pe-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($aset as $a): 
                        // Perhitungan Nilai Buku
                        $nilai_buku = $a['harga_pembelian'];
                        if ($a['umur_ekonomis_bulan'] > 0 && !empty($a['tanggal_pembelian']) && $a['harga_pembelian'] > 0) {
                            $tgl_beli = new DateTime($a['tanggal_pembelian']);
                            $tgl_sekarang = new DateTime();
                            $interval = $tgl_beli->diff($tgl_sekarang);
                            $bulan_berjalan = ($interval->y * 12) + $interval->m;
                            
                            $penyusutan_per_bulan = $a['harga_pembelian'] / $a['umur_ekonomis_bulan'];
                            $total_penyusutan = $penyusutan_per_bulan * $bulan_berjalan;
                            
                            $nilai_buku = $a['harga_pembelian'] - $total_penyusutan;
                            if ($nilai_buku < 0) $nilai_buku = 0;
                        }
                    ?>
                    <tr>
                        <td class="ps-4 text-center">
                            <input type="checkbox" value="<?= $a['id'] ?>" class="form-check-input asset-checkbox">
                        </td>
                        <td>
                            <span class="fw-bold text-white d-block"><?= esc($a['no_aktiva']) ?></span>
                            <?php if(!empty($a['pengguna'])): ?>
                                <small class="text-info"><i class="bi bi-person-fill"></i> <?= esc($a['pengguna']) ?></small>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="text-white"><?= esc($a['kategori']) ?></div>
                            <small class="text-muted"><?= esc($a['sub_kategori']) ?></small>
                        </td>
                        <td>
                            <div class="text-white"><?= esc($a['nama_aset']) ?></div>
                            <small class="text-muted"><?= esc($a['merk']) ?> <?= esc($a['tipe']) ?></small>
                        </td>
                        <td><code class="text-warning"><?= esc($a['serial_number']) ?></code></td>
                        <td>
                            <div class="text-white"><?= esc($a['ruangan']) ?> <small class="text-muted">(Lt. <?= esc($a['lantai']) ?>)</small></div>
                            <div class="mt-1">
                                <?php if ($a['kondisi_aset'] == 'Digunakan'): ?>
                                    <span class="badge bg-success bg-opacity-25 text-success border border-success rounded-pill px-2">Digunakan</span>
                                <?php elseif ($a['kondisi_aset'] == 'Backup'): ?>
                                    <span class="badge bg-info bg-opacity-25 text-info border border-info rounded-pill px-2">Backup</span>
                                <?php elseif ($a['kondisi_aset'] == 'Rusak'): ?>
                                    <span class="badge bg-danger bg-opacity-25 text-danger border border-danger rounded-pill px-2">Rusak</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary rounded-pill px-2"><?= esc($a['kondisi_aset']) ?></span>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td>
                            <div class="text-white"><?= esc($a['vendor'] ?: '-') ?></div>
                            <small class="text-muted">
                                <?= !empty($a['tanggal_pembelian']) ? date('d/m/Y', strtotime($a['tanggal_pembelian'])) : '-' ?>
                            </small>
                        </td>
                        <td>
                            <div class="font-monospace text-success mb-1">
                                Rp <?= number_format($nilai_buku, 0, ',', '.') ?>
                            </div>
                            <small class="text-muted d-block">Harga: Rp <?= number_format($a['harga_pembelian'], 0, ',', '.') ?></small>
                            <small class="text-muted d-block">Umur: <?= esc($a['umur_ekonomis_bulan']) ?> Bln | Garansi: <?= esc($a['masa_garansi_bulan'] ?: '0') ?> Bln</small>
                        </td>
                        <td>
                            <small class="text-white-50"><?= esc($a['keterangan'] ?: '-') ?></small>
                        </td>
                        <td class="pe-4 text-center text-nowrap">
                            <button type="button" class="btn btn-sm btn-outline-warning rounded-circle me-1 btn-history" data-id="<?= $a['id'] ?>" title="Riwayat Mutasi">
                                <i class="bi bi-clock-history"></i>
                            </button>
                            <a href="<?= site_url('asetit/print_labels?ids=' . $a['id']) ?>" target="_blank" class="btn btn-sm btn-outline-secondary rounded-circle me-1" title="Cetak Label QR">
                                <i class="bi bi-printer"></i>
                            </a>
                            <a href="<?= site_url('asetit/edit/'.$a['id']) ?>" class="btn btn-sm btn-outline-info rounded-circle me-1" title="Edit Data">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="<?= site_url('asetit/delete/'.$a['id']) ?>" class="btn btn-sm btn-outline-danger rounded-circle" title="Hapus Data" onclick="return confirm('Apakah Anda yakin ingin menghapus aset ini secara permanen?');">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Bulk Edit Modal -->
<div class="modal fade" id="bulkEditModal" tabindex="-1" aria-labelledby="bulkEditModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-dark text-white border-secondary" style="border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.5);">
      <div class="modal-header border-secondary p-3">
        <h5 class="modal-title" id="bulkEditModalLabel"><i class="bi bi-pencil-square me-2 text-warning"></i>Ubah Data Massal</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= site_url('asetit/bulk_edit') ?>" method="POST" id="bulk-edit-form">
        <?= csrf_field() ?>
        <div class="modal-body p-4">
          <input type="hidden" name="selected_ids" id="bulk-edit-ids">
          
          <div class="mb-3">
            <label class="form-label text-white-50 small">Pilih Kolom yang Ingin Diubah</label>
            <select name="edit_field" id="bulk-edit-field" class="form-select bg-dark text-white border-secondary" required>
              <option value="">-- Pilih Kolom --</option>
              <option value="kategori">Kategori</option>
              <option value="sub_kategori">Sub Kategori</option>
              <option value="merk">Merk</option>
              <option value="tipe">Tipe / Model</option>
              <option value="lantai">Lantai</option>
              <option value="ruangan">Ruangan</option>
              <option value="pengguna">Pengguna / Staff</option>
              <option value="kondisi_aset">Kondisi</option>
              <option value="masa_garansi_bulan">Masa Garansi (Bulan)</option>
              <option value="umur_ekonomis_bulan">Umur Ekonomis (Bulan)</option>
              <option value="harga_pembelian">Harga Pembelian (Rp)</option>
              <option value="vendor">Vendor</option>
              <option value="tanggal_pembelian">Tanggal Pembelian</option>
            </select>
          </div>
          
          <div class="mb-3">
            <label class="form-label text-white-50 small">Nilai Baru</label>
            <div id="bulk-value-container">
              <input type="text" name="new_value" class="form-control bg-dark text-white border-secondary" required placeholder="Pilih kolom terlebih dahulu" disabled>
            </div>
          </div>
          
          <div class="alert alert-warning bg-warning bg-opacity-10 border-warning text-warning small mb-0 d-flex align-items-start">
            <i class="bi bi-exclamation-triangle-fill me-2 mt-1"></i>
            <span>Perubahan ini akan diterapkan pada semua item yang Anda pilih secara massal. Pastikan data yang dimasukkan sudah benar.</span>
          </div>
        </div>
        <div class="modal-footer border-secondary p-3">
          <button type="button" class="btn btn-sm btn-outline-secondary px-3 rounded-pill" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-sm btn-neon px-4 rounded-pill">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- History Modal -->
<div class="modal fade" id="historyModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-dark text-white border-secondary">
      <div class="modal-header border-secondary p-3">
        <h5 class="modal-title"><i class="bi bi-clock-history me-2 text-warning"></i>Timeline Riwayat Aset</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-4">
        <div id="history-loading" class="text-center d-none py-4">
            <div class="spinner-border text-info" role="status"></div>
            <p class="mt-2 text-muted mb-0">Memuat riwayat...</p>
        </div>
        <div id="history-content">
            <!-- Timeline will be injected here -->
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Scripts for Bulk Action -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Toggle all checkboxes when select-all is clicked
        $('#select-all').on('click', function() {
            var table = $('.table-dark-custom').DataTable({ retrieve: true });
            var rows = table.rows({ 'search': 'applied' }).nodes();
            $('input[type="checkbox"].asset-checkbox', rows).prop('checked', this.checked);
            updateBulkActionBar();
        });

        // Update select-all state when individual checkbox is changed
        $('.table-dark-custom').on('change', '.asset-checkbox', function() {
            updateBulkActionBar();
        });

        // Explicit buttons for Select All / Deselect All
        $('#btn-select-all-page').on('click', function() {
            var table = $('.table-dark-custom').DataTable({ retrieve: true });
            var rows = table.rows({ 'search': 'applied' }).nodes();
            $('input[type="checkbox"].asset-checkbox', rows).prop('checked', true);
            $('#select-all').prop('checked', true);
            updateBulkActionBar();
        });

        $('#btn-deselect-all-page').on('click', function() {
            var table = $('.table-dark-custom').DataTable({ retrieve: true });
            var rows = table.rows({ 'search': 'applied' }).nodes();
            $('input[type="checkbox"].asset-checkbox', rows).prop('checked', false);
            $('#select-all').prop('checked', false);
            updateBulkActionBar();
        });

        // Update the Bulk Action Bar visibility and count
        function updateBulkActionBar() {
            var table = $('.table-dark-custom').DataTable({ retrieve: true });
            var checkedIds = [];
            table.$('.asset-checkbox:checked').each(function() {
                checkedIds.push($(this).val());
            });
            
            var count = checkedIds.length;
            $('#selected-count').text(count);
            
            if (count > 0) {
                $('#bulk-action-bar').removeClass('d-none');
            } else {
                $('#bulk-action-bar').addClass('d-none');
                $('#select-all').prop('checked', false);
            }
        }

        // Handle Bulk Print Button Click
        $('#bulk-print-btn').on('click', function() {
            var table = $('.table-dark-custom').DataTable({ retrieve: true });
            var checkedIds = [];
            table.$('.asset-checkbox:checked').each(function() {
                checkedIds.push($(this).val());
            });
            
            if (checkedIds.length === 0) return;
            
            var url = '<?= site_url('asetit/print_labels') ?>?ids=' + checkedIds.join(',');
            window.open(url, '_blank');
        });

        // Handle show modal event
        $('#bulkEditModal').on('show.bs.modal', function() {
            var table = $('.table-dark-custom').DataTable({ retrieve: true });
            var checkedIds = [];
            table.$('.asset-checkbox:checked').each(function() {
                checkedIds.push($(this).val());
            });
            $('#bulk-edit-ids').val(checkedIds.join(','));
        });

        // Dynamic Input fields in Bulk Edit Modal
        $('#bulk-edit-field').on('change', function() {
            var field = $(this).val();
            var container = $('#bulk-value-container');
            container.empty();
            
            if (field === '') {
                container.html('<input type="text" name="new_value" class="form-control bg-dark text-white border-secondary" required placeholder="Pilih kolom terlebih dahulu" disabled>');
                return;
            }
            
            if (field === 'kondisi_aset') {
                container.html(
                    '<select name="new_value" class="form-select bg-dark text-white border-secondary" required>' +
                        '<option value="Digunakan">Digunakan</option>' +
                        '<option value="Backup">Backup</option>' +
                        '<option value="Rusak">Rusak</option>' +
                    '</select>'
                );
            } else if (field === 'tanggal_pembelian') {
                container.html('<input type="date" name="new_value" class="form-control bg-dark text-white border-secondary" required>');
            } else if (field === 'masa_garansi_bulan' || field === 'umur_ekonomis_bulan') {
                container.html('<input type="number" min="0" name="new_value" class="form-control bg-dark text-white border-secondary" required placeholder="Contoh: 12">');
            } else if (field === 'harga_pembelian') {
                container.html('<input type="number" min="0" step="any" name="new_value" class="form-control bg-dark text-white border-secondary" required placeholder="Contoh: 5000000">');
            } else if (field === 'lantai') {
                container.html(
                    '<select name="new_value" class="form-select bg-dark text-white border-secondary" required>' +
                        '<option value="1">Lantai 1</option>' +
                        '<option value="2">Lantai 2</option>' +
                        '<option value="3">Lantai 3</option>' +
                        '<option value="4">Lantai 4</option>' +
                    '</select>'
                );
            } else {
                container.html('<input type="text" name="new_value" class="form-control bg-dark text-white border-secondary" required placeholder="Masukkan nilai baru">');
            }
        });

        // Handle Bulk Delete Button Click
        $('#bulk-delete-btn').on('click', function() {
            var table = $('.table-dark-custom').DataTable({ retrieve: true });
            var checkedIds = [];
            table.$('.asset-checkbox:checked').each(function() {
                checkedIds.push($(this).val());
            });
            
            if (checkedIds.length === 0) return;
            
            if (confirm('Apakah Anda yakin ingin menghapus secara permanen ' + checkedIds.length + ' aset IT terpilih? Tindakan ini tidak dapat dibatalkan.')) {
                var form = $('<form action="<?= site_url('asetit/bulk_delete') ?>" method="POST">' +
                    '<?= csrf_field() ?>' +
                    '<input type="hidden" name="selected_ids" value="' + checkedIds.join(',') + '">' +
                    '</form>');
                $('body').append(form);
                form.submit();
            }
        });

        // History Button Click logic using event delegation
        $('.table-dark-custom').on('click', '.btn-history', function() {
            var id = $(this).data('id');
            $('#historyModal').modal('show');
            $('#history-content').empty();
            $('#history-loading').removeClass('d-none');
            
            $.get('<?= site_url('asetit/history/') ?>' + id, function(response) {
                $('#history-loading').addClass('d-none');
                if (response.status === 'success') {
                    if (response.data.length === 0) {
                        $('#history-content').html('<div class="text-center text-muted py-3">Belum ada riwayat mutasi untuk aset ini.</div>');
                        return;
                    }
                    
                    var html = '<div class="timeline mt-2">';
                    response.data.forEach(function(log) {
                        var badgeClass = 'bg-secondary';
                        if(log.status === 'MASUK') badgeClass = 'bg-success';
                        else if(log.status === 'KELUAR' || log.status === 'DIHAPUS') badgeClass = 'bg-danger';
                        else if(log.status === 'PINDAH') badgeClass = 'bg-warning text-dark';
                        else if(['RUSAK', 'PERBAIKAN', 'UPDATE'].includes(log.status)) badgeClass = 'bg-info text-dark';
                        
                        var date = new Date(log.tanggal);
                        var formattedDate = date.toLocaleDateString('id-ID', {day: '2-digit', month: 'short', year: 'numeric', hour: '2-digit', minute:'2-digit'});
                        
                        html += '<div class="timeline-item border-start border-2 border-info ps-4 pb-4 position-relative">' +
                                '<div class="timeline-marker bg-info rounded-circle position-absolute" style="width: 12px; height: 12px; left: -7px; top: 5px; border: 2px solid var(--card-dark);"></div>' +
                                '<div class="text-info small fw-bold mb-1">' + formattedDate + '</div>' +
                                '<div><span class="badge ' + badgeClass + ' mb-2">' + log.status + '</span></div>' +
                                '<div class="text-white-50">' + log.keterangan + '</div>' +
                                '</div>';
                    });
                    html += '</div>';
                    $('#history-content').html(html);
                } else {
                    $('#history-content').html('<div class="alert alert-danger">Gagal memuat riwayat.</div>');
                }
            }).fail(function() {
                $('#history-loading').addClass('d-none');
                $('#history-content').html('<div class="alert alert-danger">Terjadi kesalahan pada server.</div>');
            });
        });

        // Reset checkall state after table redraw using jQuery event delegation
        $('.table-dark-custom').on('draw.dt', function() {
            $('#select-all').prop('checked', false);
            updateBulkActionBar();
        });
    });
</script>

<?= view('layout/footer') ?>
