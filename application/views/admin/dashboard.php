<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar_admin'); ?>

<style>
    /* 1. Layout Base - Ukuran Medium */
    .content-wrapper {
        background: var(--bg-main) !important;
        padding: 25px !important; 
        transition: 0.4s ease;
    }

    :root {
        --bg-main: #f8fafc;
        --bg-card: #ffffff;
        --primary-grad: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        --text-title: #0f172a;
        --text-body: #475569;
    }

    body.dark-mode {
        --bg-main: #020617;
        --bg-card: #0f172a;
        --text-title: #f8fafc;
        --text-body: #94a3b8;
    }

    /* 2. Banner Medium */
    .welcome-banner {
        background: var(--primary-grad);
        border-radius: 25px;
        padding: 35px 45px;
        color: white;
        margin-bottom: 30px;
        box-shadow: 0 10px 20px rgba(79, 70, 229, 0.2);
    }

    .welcome-banner h1 { font-size: 2.2rem; font-weight: 800; }
    .welcome-banner p { font-size: 1.1rem; opacity: 0.9; }

    /* 3. Stat Cards - Medium Size (3 Kolom) */
    .stat-card-v3 {
        background: var(--bg-card);
        border: 1px solid rgba(124, 58, 237, 0.1);
        border-radius: 22px;
        padding: 28px; /* Ukuran padding medium */
        display: flex;
        align-items: center;
        height: 100%;
        transition: 0.3s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .stat-card-v3:hover { transform: translateY(-8px); }

    .icon-circle {
        width: 65px; /* Ukuran icon medium */
        height: 65px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-right: 22px;
        color: white;
        background: var(--primary-grad);
        flex-shrink: 0;
    }

    .stat-label-v3 {
        font-size: 0.9rem;
        font-weight: 700;
        color: var(--text-body);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 5px;
    }

    .stat-value-v3 {
        font-size: 2.2rem; /* Angka lebih terlihat jelas */
        font-weight: 800;
        color: var(--text-title);
        margin: 0;
        line-height: 1;
    }

    /* 4. Shortcut Tiles - Medium (4 Kolom) */
    .shortcut-tile {
        background: var(--bg-card);
        border-radius: 22px;
        padding: 25px;
        text-align: center;
        border: 1px solid rgba(0,0,0,0.05);
        transition: 0.3s;
    }

    body.dark-mode .shortcut-tile { border-color: rgba(255,255,255,0.05); }

    .shortcut-tile:hover {
        background: var(--primary-grad);
        border-color: transparent;
    }

    .shortcut-tile i {
        font-size: 2.2rem;
        margin-bottom: 15px;
        background: var(--primary-grad);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        transition: 0.3s;
    }

    .shortcut-tile span {
        font-size: 1rem;
        font-weight: 800;
        color: var(--text-title);
        display: block;
        transition: 0.3s;
    }

    /* Hover effect untuk shortcut */
    .shortcut-tile:hover i, .shortcut-tile:hover span {
        -webkit-text-fill-color: white;
        color: white;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--text-title);
        margin: 20px 0 25px 0;
    }
</style>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            
            <div class="welcome-banner">
                <h1 class="font-weight-bold">Halo Admin 🚀</h1>
                <p class="mb-0">Berikut adalah ringkasan data perpustakaan yang perlu Anda pantau hari ini.</p>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="stat-card-v3">
                        <div class="icon-circle shadow">
                            <i class="fas fa-book"></i>
                        </div>
                        <div>
                            <p class="stat-label-v3">Koleksi Buku</p>
                            <h2 class="stat-value-v3"><?= number_format($total_buku) ?></h2>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="stat-card-v3">
                        <div class="icon-circle shadow" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <p class="stat-label-v3">Anggota Aktif</p>
                            <h2 class="stat-value-v3"><?= number_format($total_anggota) ?></h2>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 mb-4">
                    <div class="stat-card-v3">
                        <div class="icon-circle shadow" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                            <i class="fas fa-exchange-alt"></i>
                        </div>
                        <div>
                            <p class="stat-label-v3">Total Pinjaman</p>
                            <h2 class="stat-value-v3"><?= number_format($total_transaksi) ?></h2>
                        </div>
                    </div>
                </div>
            </div>

            <h5 class="mb-4 font-weight-bold mt-2"><i class="fas fa-th-large mr-2 text-primary"></i> Navigasi Cepat</h5>
            <div class="row mb-5">
                <div class="col-lg-3 col-md-6 mb-4">
                    <a href="<?= base_url('index.php/buku/tambah') ?>" class="text-decoration-none">
                        <div class="shortcut-tile shadow-sm">
                            <i class="fas fa-plus-circle"></i>
                            <span>TAMBAH BUKU</span>
                        </div>
                    </a>
                </div>
                
                <div class="col-lg-3 col-md-6 mb-4">
                    <a href="<?= base_url('index.php/laporan') ?>" class="text-decoration-none">
                        <div class="shortcut-tile shadow-sm">
                            <i class="fas fa-file-invoice"></i>
                            <span>LAPORAN</span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <a href="<?= base_url('index.php/anggota') ?>" class="text-decoration-none">
                        <div class="shortcut-tile shadow-sm">
                            <i class="fas fa-user-shield"></i>
                            <span>DATA ANGGOTA</span>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <a href="<?= base_url('index.php/auth/logout') ?>"  class="text-decoration-none">
                        <div class="shortcut-tile shadow-sm">
                            <i class="fas fa-user-shield"></i>
                            <span>KELUAR</span>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </section>
</div>

<?php $this->load->view('templates/footer'); ?>