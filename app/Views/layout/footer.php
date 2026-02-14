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

</body>
</html>