<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar_user'); ?>

<style>
    /* ================= ADAPTIVE THEME SYSTEM ================= */
    :root {
        /* Light Mode Colors (Default) */
        --bg-body: #f4f7fe;
        --bg-card: #ffffff;
        --bg-banner: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
        --text-main: #1e293b;
        --text-muted: #64748b;
        --accent-neon: #0ea5e9; /* Deep Sky Blue */
        --accent-purple: #8b5cf6;
        --border-color: rgba(0, 0, 0, 0.05);
        --glass: rgba(255, 255, 255, 0.8);
    }

    body.dark-mode {
        /* Dark Mode Override */
        --bg-body: #05070a;
        --bg-card: #1e293b;
        --bg-banner: linear-gradient(135deg, #0f172a 0%, #1e1b4b 100%);
        --text-main: #f8fafc;
        --text-muted: #94a3b8;
        --accent-neon: #00f2ff; /* Cyan Neon */
        --accent-purple: #7000ff;
        --border-color: rgba(255, 255, 255, 0.05);
        --glass: rgba(15, 23, 42, 0.7);
    }

    .content-wrapper {
        background: var(--bg-body) !important;
        padding-top: 30px;
        transition: all 0.3s ease;
    }

    /* Welcome Banner */
    .welcome-banner {
        background: var(--bg-banner);
        border-radius: 30px;
        padding: 50px;
        color: white !important;
        position: relative;
        overflow: hidden;
        border: none;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }

    .welcome-banner h2 {
        font-weight: 700;
        color: white !important;
    }

    /* Stat Cards */
    .stat-card {
        background: var(--bg-card);
        border-radius: 25px;
        border: 1px solid var(--border-color);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 10px 20px rgba(0,0,0,0.02);
    }

    .stat-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        border-color: var(--accent-neon);
    }

    .icon-box {
        width: 60px;
        height: 60px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    /* Action Buttons (Cetak Kartu) */
    .action-card {
        background: var(--bg-card);
        border-radius: 25px;
        border: 1px solid var(--border-color);
        padding: 25px;
        text-align: center;
        transition: 0.3s;
        text-decoration: none !important;
        display: block;
    }

    .action-card:hover {
        background: var(--accent-neon);
        transform: scale(1.02);
    }

    .action-card:hover h5, .action-card:hover i {
        color: white !important;
    }

    .action-card i {
        font-size: 2.5rem;
        color: var(--accent-neon);
        margin-bottom: 15px;
    }

    /* Operational Card */
    .op-card {
        background: var(--bg-card);
        border-radius: 25px;
        border: 1px solid var(--border-color);
    }

    h4, h5, h6, p, span { color: var(--text-main); transition: color 0.3s; }
    .text-muted { color: var(--text-muted) !important; }

    .border-right-custom {
        border-right: 1px solid var(--border-color);
    }

    @media (max-width: 768px) {
        .border-right-custom { border-right: none; border-bottom: 1px solid var(--border-color); padding-bottom: 15px; margin-bottom: 15px; }
    }
</style>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">

            <!-- ================= WELCOME ================= -->
            <div class="card welcome-banner mb-5">
                <div class="card-body p-0">
                    <div class="row align-items-center">
                        <div class="col-md-8 position-relative" style="z-index: 2;">
                            <h2 class="display-5 mb-3">
                                Hello, <?= $this->session->userdata('nama') ?>! 🚀
                            </h2>
                            <p class="lead" style="opacity: 0.9;">
                                Sistem siap. Koleksi buku digital dan fisik tersedia untuk kamu jelajahi hari ini.
                            </p>
                        </div>
                    </div>
                    <i class="fas fa-user-astronaut fa-10x"
                       style="position: absolute; right: 20px; bottom: -20px; color: rgba(255,255,255,0.15); transform: rotate(15deg);"></i>
                </div>
            </div>

            <!-- ================= STAT ================= -->
           <div class="row mb-4 justify-content-center">

                <div class="col-md-5 mb-3">
    <div class="card stat-card h-100">
        <div class="card-body d-flex align-items-center p-4">
            <div class="icon-box mr-4"
                 style="background: rgba(14,165,233,0.1); color: var(--accent-neon);">
                <i class="fas fa-book-open"></i>
            </div>
            <div>
                <h6 class="text-muted mb-1 small text-uppercase font-weight-bold">
                    Pinjaman Aktif
                </h6>
                <h4 class="font-weight-bold mb-0">
                    3 <span class="small opacity-50">Buku</span>
                </h4>
            </div>
        </div>
    </div>
</div>

<div class="col-md-5 mb-3">
    <div class="card stat-card h-100">
        <div class="card-body d-flex align-items-center p-4">
            <div class="icon-box mr-4"
                 style="background: rgba(139,92,246,0.1); color: var(--accent-purple);">
                <i class="fas fa-bolt"></i>
            </div>
            <div>
                <h6 class="text-muted mb-1 small text-uppercase font-weight-bold">
                    Level Literasi
                </h6>
                <h4 class="font-weight-bold mb-0">
                    Elite <span class="small opacity-50">(1,250 XP)</span>
                </h4>
            </div>
        </div>
    </div>
</div>

            <!-- ================= OPERATIONAL ================= -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card op-card mb-5">
                        <div class="card-body p-4">

                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-primary p-3 rounded-circle mr-3"
                                     style="background: var(--accent-neon) !important;">
                                    <i class="fas fa-hourglass-half text-white"></i>
                                </div>
                                <h5 class="font-weight-bold mb-0">
                                    Operational Status
                                </h5>
                            </div>

                            <div class="row text-center py-2">

                                <div class="col-md-4 border-right-custom">
                                    <p class="mb-1 text-muted small text-uppercase">
                                        Mon — Thu
                                    </p>
                                    <h5 class="font-weight-bold">
                                        07:30 — 15:30
                                    </h5>
                                </div>

                                <div class="col-md-4 border-right-custom">
                                    <p class="mb-1 text-muted small text-uppercase">
                                        Friday
                                    </p>
                                    <h5 class="font-weight-bold">
                                        07:30 — 11:30
                                    </h5>
                                </div>

                                <div class="col-md-4">
                                    <p class="mb-1 text-muted small text-uppercase">
                                        Weekend
                                    </p>
                                    <h5 class="text-danger font-weight-bold">
                                        OFFLINE
                                    </h5>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
</div>

<?php $this->load->view('templates/footer'); ?>