</div> <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

    <script>
        /**
         * Script tambahan untuk sinkronisasi Sidebar AdminLTE
         * karena AdminLTE memiliki class khusus untuk sidebar gelap/terang
         */
        $(document).ready(function() {
            const currentTheme = localStorage.getItem('theme');
            const sidebar = $('.main-sidebar');

            function syncSidebar() {
                if (localStorage.getItem('theme') === 'dark') {
                    sidebar.removeClass('sidebar-light-primary').addClass('sidebar-dark-primary');
                } else {
                    sidebar.removeClass('sidebar-dark-primary').addClass('sidebar-light-primary');
                }
            }

            // Jalankan saat halaman dimuat
            syncSidebar();

            // Jalankan setiap kali tombol toggle di header diklik
            $('#theme-toggle').on('click', function() {
                // Beri sedikit delay agar class 'dark-mode' pada body sudah ter-update oleh script di header
                setTimeout(syncSidebar, 10);
            });
        });
    </script>

    <style>
        /* Perbaikan CSS untuk transisi warna yang lebih smooth pada semua elemen */
        .content-wrapper, .main-header, .main-sidebar, .card, .table, .nav-link {
            transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease !important;
        }
        
        /* Mencegah teks menjadi abu-abu pudar saat dark mode di tabel */
        body.dark-mode .table td, 
        body.dark-mode .table th {
            color: #ecf0f1 !important;
        }
    </style>

</body>
</html>