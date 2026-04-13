    <?php $this->load->view('templates/header'); ?>
    <?php $this->load->view('templates/sidebar_admin'); ?>

    <style>
    /* ================= DETAIL CARD THEME ================= */

/* ROOT */
:root {
    --bg-card: #ffffff;
    --bg-soft: #f8fafc;
    --text-main: #1e293b;
    --text-muted: #64748b;
    --border-color: #e2e8f0;
}

/* DARK MODE */
body.dark-mode {
    --bg-card: #1e293b;
    --bg-soft: #273449;
    --text-main: #f1f5f9;
    --text-muted: #94a3b8;
    --border-color: #334155;
}

/* CARD */
.card-detail-container {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 16px;
    overflow: hidden;
}

/* TABLE */
.table-detail {
    margin: 0;
}

.table-detail th {
    width: 35%;
    background: var(--bg-soft);
    color: var(--text-muted);
    font-weight: 600;
    padding: 16px;
    border-bottom: 1px solid var(--border-color);
}

.table-detail td {
    background: var(--bg-card);
    color: var(--text-main);
    padding: 16px;
    border-bottom: 1px solid var(--border-color);
}

/* HOVER */
.table-detail tr:hover td,
.table-detail tr:hover th {
    background: rgba(99,102,241,0.05);
}

/* ================= STATUS ================= */
.badge-status {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
}

.status-pinjam {
    background: rgba(59,130,246,0.15);
    color: #3b82f6;
}

.status-selesai {
    background: rgba(139,92,246,0.15);
    color: #8b5cf6;
}

/* ================= DENDA ================= */
.denda-text {
    font-weight: 700;
    color: #ef4444;
}

/* ================= TEXT FIX ================= */
body.dark-mode .text-success { color: #4ade80 !important; }
body.dark-mode .text-info { color: #38bdf8 !important; }
body.dark-mode .text-muted { color: var(--text-muted) !important; }

/* ICON */
.table-detail i {
    opacity: 0.8;
}
    </style>

    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">

                <div class="mb-4">
                    <h3 class="page-title">🔍 Detail Transaksi</h3>
                    <p class="text-muted small">Informasi lengkap mengenai peminjaman buku</p>
                </div>

                <div class="card card-detail-container shadow-sm mb-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-detail">
                    <tr>
                        <th><i class="fas fa-user mr-2"></i> Nama Peminjam</th>
                        <td class="font-weight-bold"><?= $trx->nama_user ?? '-' ?></td>
                    </tr>

                    <tr>
                        <th><i class="fas fa-book mr-2"></i> Judul Buku</th>
                        <td><?= $trx->judul ?? '-' ?></td>
                    </tr>

                    <tr>
                        <th><i class="fas fa-calendar-alt mr-2"></i> Tanggal Pinjam</th>
                        <td>
                            <span class="text-success font-weight-bold">
                                <i class="far fa-calendar-check mr-1"></i>
                                <?= date('d M Y', strtotime($trx->tanggal_pinjam)) ?>
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <th><i class="fas fa-calendar-check mr-2"></i> Tanggal Kembali</th>
                        <td>
                            <?php if($trx->tanggal_kembali && $trx->tanggal_kembali != '0000-00-00'){ ?>
                                <span class="text-info font-weight-bold">
                                    <i class="far fa-calendar-times mr-1"></i>
                                    <?= date('d M Y', strtotime($trx->tanggal_kembali)) ?>
                                </span>
                            <?php } else { ?>
                                <span class="text-muted font-italic">
                                    <i class="fas fa-hourglass-half mr-1"></i> Belum dikembalikan
                                </span>
                            <?php } ?>
                        </td>
                    </tr>

                    <tr>
                        <th><i class="fas fa-info-circle mr-2"></i> Status</th>
                        <td>
                            <?php if($trx->status == 'pinjam'){ ?>
                                <span class="badge-status status-pinjam">
                                    <i class="fas fa-clock mr-1"></i> DIPINJAM
                                </span>
                            <?php } else { ?>
                                <span class="badge-status status-selesai">
                                    <i class="fas fa-check-circle mr-1"></i> SELESAI
                                </span>
                            <?php } ?>
                        </td>
                    </tr>

                    <tr>
                        <th><i class="fas fa-money-bill-wave mr-2"></i> Total Denda</th>
                        <td class="denda-text">
                            Rp <?= number_format($trx->denda, 0, ',', '.') ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

                <a href="<?= base_url('index.php/admin/transaksi') ?>" class="btn btn-back shadow-sm">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
                </a>

            </div>
        </section>
    </div>

    <?php $this->load->view('templates/footer'); ?>