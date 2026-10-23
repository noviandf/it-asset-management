</div> <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Tunggu dokumen selesai dimuat
    document.addEventListener("DOMContentLoaded", function() {
        
        // Cari elemen notifikasi (alert)
        var alerts = document.querySelectorAll('.alert');

        // Jika ada notifikasi
        if (alerts.length > 0) {
            // Tunggu 3000 milidetik (3 detik)
            setTimeout(function() {
                alerts.forEach(function(alert) {
                    // Gunakan fungsi bawaan Bootstrap untuk menutup alert dengan efek fade
                    var bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 3000); 
        }
    });
</script>

<!-- jQuery and DataTables JS -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- DataTables Buttons JS -->
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
.btn-export-excel {
    background-color: rgba(25, 135, 84, 0.2) !important;
    color: #4ade80 !important;
    border: 1px solid rgba(74, 222, 128, 0.4) !important;
}
.btn-export-excel:hover {
    background-color: rgba(25, 135, 84, 0.5) !important;
    color: #fff !important;
}
.btn-export-pdf {
    background-color: rgba(220, 53, 69, 0.2) !important;
    color: #f87171 !important;
    border: 1px solid rgba(248, 113, 113, 0.4) !important;
}
.btn-export-pdf:hover {
    background-color: rgba(220, 53, 69, 0.5) !important;
    color: #fff !important;
}
.btn-export-print {
    background-color: rgba(108, 117, 125, 0.2) !important;
    color: #cbd5e1 !important;
    border: 1px solid rgba(203, 213, 225, 0.4) !important;
}
.btn-export-print:hover {
    background-color: rgba(108, 117, 125, 0.5) !important;
    color: #fff !important;
}
</style>

<script>
    $(document).ready(function() {
        // Initialize Select2
        $('.select2').select2({
            theme: 'bootstrap-5',
            width: '100%'
        });

        // Initialize DataTables
        var table = $('.table-dark-custom').DataTable({
            dom: "<'row mb-3 align-items-center'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4 d-flex justify-content-center'B><'col-sm-12 col-md-4'f>>" +
                 "<'row'<'col-sm-12'tr>>" +
                 "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
            buttons: [
                { extend: 'excelHtml5', className: 'btn btn-sm btn-export-excel px-3', text: '<i class="bi bi-file-earmark-excel"></i> Excel', exportOptions: { columns: ':not(:first-child):not(:last-child)' } },
                { extend: 'pdfHtml5', className: 'btn btn-sm btn-export-pdf px-3', text: '<i class="bi bi-file-earmark-pdf"></i> PDF', exportOptions: { columns: ':not(:first-child):not(:last-child)' } },
                { extend: 'print', className: 'btn btn-sm btn-export-print px-3', text: '<i class="bi bi-printer"></i> Print', exportOptions: { columns: ':not(:first-child):not(:last-child)' } }
            ],
            initComplete: function() {
                $('.dt-button').removeClass('btn-secondary dt-button');
                $('.dt-buttons').addClass('btn-group shadow-sm');
            },
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ data",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "infoEmpty": "Tidak ada data",
                "infoFiltered": "(disaring dari _MAX_ total data)",
                "zeroRecords": "Tidak ada data yang cocok",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Lanjut",
                    "previous": "Kembali"
                }
            }
        });

        // Custom Filter Buttons Logic
        $('.dt-filter-btn').on('click', function() {
            // Remove active class from all buttons in the same group
            $(this).siblings().removeClass('active btn-primary').addClass('btn-outline-secondary');
            // Add active class to clicked button
            $(this).removeClass('btn-outline-secondary').addClass('active btn-primary');
            
            var filterValue = $(this).data('filter');
            // Search the table (global search for simplicity, or we can use column search if specified)
            if (filterValue === 'all') {
                table.search('').draw();
            } else {
                table.search(filterValue).draw();
            }
        });

        // Add Loading State to forms
        $('form').on('submit', function() {
            var btn = $(this).find('button[type="submit"]');
            if (btn.length > 0) {
                // Ignore if it's a delete form that needs confirmation
                if (!btn.hasClass('btn-danger')) {
                    btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
                    btn.prop('disabled', true);
                }
            }
        });
    });
</script>
</body>
</html>