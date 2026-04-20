</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

<script>
$(document).ready(function () {

    const sidebar = $('.main-sidebar');
    const body = $('body');

    function syncSidebar() {
        const isDarkMode = body.hasClass('dark-mode');

        if (isDarkMode) {
            sidebar.removeClass('sidebar-light-primary sidebar-light-info sidebar-light-warning sidebar-light-danger sidebar-light-success')
                   .addClass('sidebar-dark-primary');

            $('.main-header')
                .removeClass('navbar-white navbar-light')
                .addClass('navbar-dark');
        } else {
            sidebar.removeClass('sidebar-dark-primary sidebar-dark-info sidebar-dark-warning sidebar-dark-danger sidebar-dark-success')
                   .addClass('sidebar-light-primary');

            $('.main-header')
                .removeClass('navbar-dark')
                .addClass('navbar-light navbar-white');
        }
    }

    // jalankan sekali saat load
    syncSidebar();

    // toggle theme (SAFE)
    $('#theme-toggle').on('click', function () {
        setTimeout(syncSidebar, 50);
    });

});
</script>

<style>
/* =========================
   STABIL DARK MODE SYSTEM
========================= */

/* hanya transisi ringan (tidak global semua element) */
body,
.card,
.main-sidebar,
.main-header {
    transition: background-color 0.2s ease, color 0.2s ease;
}

/* DARK MODE SIDEBAR FIX */
body.dark-mode .main-sidebar {
    background-color: #1e293b !important;
}

/* ACTIVE MENU */
body.dark-mode .nav-sidebar .nav-link.active {
    background-color: #6366f1 !important;
    color: #fff !important;
}

/* TEXT DARK MODE */
body.dark-mode,
body.dark-mode .content-wrapper {
    background-color: #0f172a !important;
    color: #f1f5f9 !important;
}

/* TABLE DARK MODE */
body.dark-mode .table td,
body.dark-mode .table th {
    color: #f1f5f9 !important;
    border-color: #334155 !important;
}

/* HEADER FIX */
body.dark-mode .main-header {
    background-color: #1e293b !important;
    border-bottom: 1px solid #334155;
}

/* HILANGKAN FLICKER PUTIH */
body.dark-mode {
    background-color: #0f172a !important;
}
</style>

</body>
</html>