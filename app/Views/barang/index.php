<?= view('layout/header') ?>

<div class="card card-custom">
    <div class="card-header-custom d-flex justify-content-between align-items-center">
        <h4 class="m-0 text-white"><i class="bi bi-box-seam me-2"></i>Distribusi Aset IT</h4>
        <div class="d-flex gap-2">
            <a href="<?= site_url('logmutasi') ?>" class="btn btn-outline-info btn-sm px-3 rounded-pill">
                <i class="bi bi-clock-history me-1"></i> Log Mutasi
            </a>
            <a href="<?= site_url('barang/create') ?>" class="btn btn-neon btn-sm px-3 rounded-pill">
                <i class="bi bi-plus-lg me-1"></i> Input Barang
            </a>
        </div>
    </div>
    
    <div class="card-body p-0">
        <!-- Filter Buttons -->
        <div class="px-3 py-3 border-bottom border-secondary bg-dark bg-opacity-25 d-flex gap-2 flex-wrap">
            <span class="text-muted small align-self-center me-2"><i class="bi bi-funnel"></i> Quick Filter:</span>
            <button class="btn btn-sm btn-primary active dt-filter-btn" data-filter="all">Semua</button>
            <button class="btn btn-sm btn-outline-secondary dt-filter-btn" data-filter="PC">PC / Komputer</button>
            <button class="btn btn-sm btn-outline-secondary dt-filter-btn" data-filter="Laptop">Laptop</button>
            <button class="btn btn-sm btn-outline-secondary dt-filter-btn" data-filter="Printer">Printer</button>
            <button class="btn btn-sm btn-outline-secondary dt-filter-btn" data-filter="Network">Network</button>
        </div>

        <!-- Bulk Action Bar -->
        <div id="bulk-action-bar" class="d-none bg-dark bg-opacity-50 border-bottom border-secondary p-3 d-flex justify-content-between align-items-center" style="transition: all 0.3s ease;">
            <div class="text-white d-flex align-items-center">
                <span class="badge btn-neon px-3 py-2 me-2" id="selected-count" style="font-size: 0.95rem; font-weight: bold; border-radius: 50px;">0</span>
                <span class="small text-white-50">data terpilih untuk aksi massal</span>
            </div>
            <div class="d-flex gap-2">
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
            <table class="table table-dark-custom table-hover m-0 align-middle text-center">
                <thead>
                    <tr>
                        <th class="ps-4 text-center" width="40">
                            <input type="checkbox" id="select-all" class="form-check-input">
                        </th>
                        <th class="text-start">No</th>
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
                        <td class="ps-4 text-center">
                            <input type="checkbox" value="<?= $b['id'] ?>" class="form-check-input barang-checkbox">
                        </td>
                        <td class="text-muted text-start"><?= $no++ ?></td>
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

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Toggle all checkboxes when select-all is clicked
        $('#select-all').on('click', function() {
            var table = $('.table-dark-custom').DataTable({ retrieve: true });
            var rows = table.rows({ 'search': 'applied' }).nodes();
            $('input[type="checkbox"].barang-checkbox', rows).prop('checked', this.checked);
            updateBulkActionBar();
        });

        // Update select-all state when individual checkbox is changed
        $('.table-dark-custom').on('change', '.barang-checkbox', function() {
            updateBulkActionBar();
        });

        // Explicit buttons for Select All / Deselect All
        $('#btn-select-all-page').on('click', function() {
            var table = $('.table-dark-custom').DataTable({ retrieve: true });
            var rows = table.rows({ 'search': 'applied' }).nodes();
            $('input[type="checkbox"].barang-checkbox', rows).prop('checked', true);
            $('#select-all').prop('checked', true);
            updateBulkActionBar();
        });

        $('#btn-deselect-all-page').on('click', function() {
            var table = $('.table-dark-custom').DataTable({ retrieve: true });
            var rows = table.rows({ 'search': 'applied' }).nodes();
            $('input[type="checkbox"].barang-checkbox', rows).prop('checked', false);
            $('#select-all').prop('checked', false);
            updateBulkActionBar();
        });

        // Update the Bulk Action Bar visibility and count
        function updateBulkActionBar() {
            var table = $('.table-dark-custom').DataTable({ retrieve: true });
            var checkedIds = [];
            table.$('.barang-checkbox:checked').each(function() {
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

        // Handle Bulk Delete Button Click
        $('#bulk-delete-btn').on('click', function() {
            var table = $('.table-dark-custom').DataTable({ retrieve: true });
            var checkedIds = [];
            table.$('.barang-checkbox:checked').each(function() {
                checkedIds.push($(this).val());
            });
            
            if (checkedIds.length === 0) return;
            
            if (confirm('Apakah Anda yakin ingin menghapus secara permanen ' + checkedIds.length + ' data terpilih? Tindakan ini tidak dapat dibatalkan.')) {
                var form = $('<form action="<?= site_url('barang/bulk_delete') ?>" method="POST">' +
                    '<?= csrf_field() ?>' +
                    '<input type="hidden" name="selected_ids" value="' + checkedIds.join(',') + '">' +
                    '</form>');
                $('body').append(form);
                form.submit();
            }
        });

        // Reset checkall state after table redraw using jQuery event delegation
        $('.table-dark-custom').on('draw.dt', function() {
            $('#select-all').prop('checked', false);
            updateBulkActionBar();
        });
    });
</script>

<?= view('layout/footer') ?>