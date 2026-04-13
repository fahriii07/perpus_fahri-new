<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar_admin'); ?>

<style>
    /* 1. Theme Variables - Konsisten dengan Transaksi & Anggota */
    :root {
        --bg-body: #f8fafc;
        --bg-card: #ffffff;
        --text-main: #0f172a; /* Dipertajam ke Slate 900 */
        --text-muted: #475569; /* Dipertajam ke Slate 600 */
        --table-header: #f1f5f9;
        --border-color: #e2e8f0; /* Dipertegas agar pemisah terlihat */
        --hover-row: #f8fafc;
        --input-bg: #ffffff;
        --accent: #6366f1;
    }

    /* Dark Mode Variables Override */
    body.dark-mode {
        --bg-body: #0f172a;
        --bg-card: #1e293b;
        --text-main: #f1f5f9;
        --text-muted: #94a3b8;
        --table-header: #334155;
        --border-color: #334155;
        --hover-row: #1e293b;
    }

    /* 2. Base Background & Grid */
    .content-wrapper {
        background: var(--bg-body) !important;
        background-image: 
            radial-gradient(at 100% 0%, rgba(99, 102, 241, 0.05) 0px, transparent 50%),
            radial-gradient(at 0% 100%, rgba(168, 85, 247, 0.05) 0px, transparent 50%) !important;
        padding-top: 25px;
        transition: all 0.3s ease;
    }

    /* 3. Title & Text Styling */
    .page-title {
        font-weight: 800;
        color: var(--text-main);
        letter-spacing: -0.5px;
    }
    
    .text-muted {
        color: var(--text-muted) !important;
    }

    /* 4. Filter Card Styling */
    .filter-card {
        border: 1px solid var(--border-color); /* Tambah border halus */
        border-radius: 20px;
        background: var(--bg-card);
        transition: background 0.3s ease;
    }

    .form-control-custom {
        background: var(--table-header);
        border: 1px solid var(--border-color);
        color: var(--text-main);
        border-radius: 10px;
        padding: 10px 15px;
        font-weight: 500;
    }

    /* 5. Card & Table Styling */
    .card-table-container {
        border: 1px solid var(--border-color); /* Tambah border halus */
        border-radius: 20px;
        background: var(--bg-card);
        overflow: hidden;
        transition: background 0.3s ease;
    }

    .table thead th {
        background: var(--table-header);
        border: none;
        color: var(--text-muted);
        font-size: 0.75rem;
        font-weight: 700; /* Pertebal header */
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 18px 25px;
    }

    .table td {
        border-bottom: 1px solid var(--border-color);
        padding: 20px 25px;
        vertical-align: middle;
        color: var(--text-main);
        background: transparent;
    }

    .table tbody tr:hover {
        background-color: var(--hover-row) !important;
    }

    /* Teks Spesifik Tabel Laporan */
    .row-title {
        font-weight: 700;
        color: var(--text-main);
        display: block;
        margin-bottom: 2px;
    }

    .row-sub {
        font-weight: 500;
        color: var(--text-muted);
        font-size: 0.8rem;
    }

    /* 6. Status & Denda Badges */
    .badge-status {
        padding: 6px 14px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 0.75rem;
        display: inline-block;
        border: 1px solid transparent; /* Border tipis untuk kontras */
    }
    .status-pinjam { 
        background: rgba(245, 158, 11, 0.15); 
        color: #b45309; /* Warna dipertegas */
        border-color: rgba(245, 158, 11, 0.3);
    }
    .status-selesai { 
        background: rgba(34, 197, 94, 0.15); 
        color: #15803d; /* Warna dipertegas */
        border-color: rgba(34, 197, 94, 0.3);
    }

    .denda-amount {
        font-family: 'Monaco', 'Consolas', monospace;
        padding: 4px 10px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.85rem;
    }
    .has-denda { 
        background: rgba(225, 29, 72, 0.1); 
        color: #e11d48; 
    }
    .no-denda { 
        background: var(--table-header); 
        color: var(--text-muted); 
    }

    //* ================= BUTTON MODERN (UPGRADE) ================= */

/* Base Button */
.btn-primary-modern,
.btn-reset-modern,
.btn-export-modern {
    border-radius: 12px;
    padding: 10px 18px;
    font-weight: 600;
    transition: all 0.25s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    border: 1px solid transparent;
    position: relative;
    overflow: hidden;
}

/* ICON */
.btn i {
    font-size: 14px;
}

/* ================= FILTER ================= */
.btn-primary-modern {
    background: linear-gradient(135deg, #6366f1, #4f46e5);
    color: #fff;
}

.btn-primary-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(99, 102, 241, 0.4);
}

/* ================= RESET ================= */
.btn-reset-modern {
    background: transparent;
    border: 1px solid var(--border-color);
    color: var(--text-muted);
}

.btn-reset-modern:hover {
    background: var(--table-header);
    color: var(--text-main);
    border-color: var(--accent);
}

/* ================= EXPORT ================= */
.btn-export-modern {
    background: linear-gradient(135deg, #22c55e, #16a34a);
    color: #fff;
}

.btn-export-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(34, 197, 94, 0.4);
}

/* ================= DARK MODE ENHANCEMENT ================= */
body.dark-mode .btn-reset-modern {
    background: transparent;
    border: 1px solid #415e86;
    color: #94a3b8;
}

body.dark-mode .btn-reset-modern:hover {
    background: #ff0000;
    color: #f1f5f9;
    border-color: #6366f1;
}

/* Glow effect biar keliatan di dark */
body.dark-mode .btn-primary-modern:hover {
    box-shadow: 0 0 12px rgba(99, 102, 241, 0.7);
}

body.dark-mode .btn-export-modern:hover {
    box-shadow: 0 0 12px rgba(34, 197, 94, 0.7);
}
</style>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="page-title mb-1">📊 Laporan Transaksi</h3>
                </div>
            </div>

            <<div class="card filter-card shadow-sm mb-4">
    <div class="card-body">
        <form method="get" action="<?= base_url('index.php/laporan') ?>">
            <div class="row align-items-end">
                <div class="col-md-3">
                    <label class="filter-label">Tanggal Awal</label>
                    <input type="date" name="tgl_awal" value="<?= $tgl_awal ?>" class="form-control form-control-custom shadow-none">
                </div>
                <div class="col-md-3">
                    <label class="filter-label">Tanggal Akhir</label>
                    <input type="date" name="tgl_akhir" value="<?= $tgl_akhir ?>" class="form-control form-control-custom shadow-none">
                </div>
                <div class="col-md-6 d-flex flex-wrap justify-content-md-end mt-3 mt-md-0" style="gap: 10px;">
                    <button type="submit" class="btn btn-primary-modern shadow-sm">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                    <a href="<?= base_url('index.php/laporan') ?>" class="btn btn-reset-modern">
                        <i class="fas fa-undo"></i> Reset
                    </a>
                    <a href="<?= base_url('index.php/laporan?export=excel&tgl_awal='.$tgl_awal.'&tgl_akhir='.$tgl_akhir) ?>" 
                       class="btn btn-export-modern shadow-sm" target="_blank">
                        <i class="fas fa-file-excel"></i> Export Excel
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

            <div class="card card-table-container shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>Peminjam</th>
                                    <th>Informasi Buku</th>
                                    <th>Periode Pinjam</th>
                                    <th>Status</th>
                                    <th class="text-right">Denda</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($laporan)){ ?>
                                    <?php foreach($laporan as $l){ ?>
                                        <tr>
                                            <td>
                                                <div class="font-weight-bold"><?= $l->nama_user ?: '-' ?></div>
                                                <small class="text-muted">Member Perpustakaan</small>
                                            </td>
                                            <td style="max-width: 200px;">
                                                <div class="text-truncate font-weight-bold"><?= $l->judul ?: '-' ?></div>
                                                <small class="text-muted">Buku Perpustakaan</small>
                                            </td>
                                            <td>
                                                <div class="small">
                                                    <span class="text-success"><i class="fas fa-calendar-plus mr-1"></i> <?= date('d M Y', strtotime($l->tanggal_pinjam)) ?></span><br>
                                                    <span class="<?= ($l->status == 'pinjam') ? 'text-muted' : 'text-danger' ?>">
                                                        <i class="fas fa-calendar-check mr-1"></i> 
                                                        <?= ($l->tanggal_kembali && $l->tanggal_kembali != '0000-00-00') ? date('d M Y', strtotime($l->tanggal_kembali)) : '<i>Belum Kembali</i>' ?>
                                                    </span>
                                                </div>
                                            </td>
                                            <td>
                                                <?php if($l->status=='pinjam'){ ?>
                                                    <span class="badge-status status-pinjam">DIPINJAM</span>
                                                <?php } else { ?>
                                                    <span class="badge-status status-selesai">SELESAI</span>
                                                <?php } ?>
                                            </td>
                                            <td class="text-right">
                                                <span class="denda-amount <?= $l->denda > 0 ? 'has-denda' : 'no-denda' ?>">
                                                    Rp <?= number_format($l->denda, 0, ',', '.') ?>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td colspan="5" class="py-5 text-center">
                                            <i class="fas fa-folder-open fa-3x mb-3 text-muted" style="opacity: 0.3;"></i>
                                            <p class="text-muted">Tidak ada data transaksi pada periode ini.</p>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
</div>

<?php $this->load->view('templates/footer'); ?>