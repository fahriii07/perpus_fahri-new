<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar_user'); ?>

<style>
/* ================= ROOT ================= */
:root {
    --bg-body: #f4f7fa;
    --bg-card: #ffffff;
    --bg-soft: #f8fafc;

    --text-main: #1e293b;
    --text-muted: #64748b;

    --border-color: #e2e8f0;

    --primary: #6366f1;
    --primary-soft: rgba(99,102,241,0.1);
}

/* DARK MODE */
body.dark-mode {
    --bg-body: #0f172a;
    --bg-card: #1e293b;
    --bg-soft: #273449;

    --text-main: #f1f5f9;
    --text-muted: #94a3b8;

    --border-color: #334155;
}

/* ================= BASE ================= */
.content-wrapper {
    background: var(--bg-body);
    padding-top: 20px;
}

/* FIX BOOTSTRAP */
.text-dark { color: var(--text-main) !important; }
.text-muted { color: var(--text-muted) !important; }
.bg-light { background: var(--bg-soft) !important; }

/* ================= HEADER ================= */
.bg-primary {
    background: linear-gradient(135deg, #3b82f6, #8b5cf6) !important;
    border-radius: 12px;
}

/* ================= FILTER ================= */
.filter-section {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 16px;
    padding: 20px;
}

/* INPUT */
.form-control {
    background: var(--bg-soft);
    border: 1px solid var(--border-color);
    color: var(--text-main);
}

.form-control:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 2px rgba(99,102,241,0.25);
}

/* ================= BUTTON ================= */
.btn-primary {
    background: linear-gradient(135deg, #3b82f6, #8b5cf6);
    border: none;
    border-radius: 10px;
    font-weight: 600;
}

.btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 6px 18px rgba(99,102,241,0.4);
}

.btn-light {
    background: var(--bg-soft);
    color: var(--text-muted);
    border: 1px solid var(--border-color);
    border-radius: 10px;
}

.btn-light:hover {
    background: var(--bg-card);
    color: var(--text-main);
}

/* ================= CARD ================= */
.card-riwayat {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 18px;
    overflow: hidden;
}

/* ================= TABLE ================= */
.table {
    margin: 0;
}

/* HEADER */
.table thead th {
    background: var(--bg-soft);
    color: var(--text-muted);
    font-size: 0.75rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    border: none;
}

/* BODY */
.table tbody td {
    border-top: 1px solid var(--border-color);
    color: var(--text-main);
    background: transparent;
}

/* HOVER */
.table-hover tbody tr:hover {
    background: var(--primary-soft);
}

/* ================= STATUS ================= */
.badge-custom {
    padding: 6px 14px;
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
.denda-bahaya {
    background: rgba(239,68,68,0.1);
    color: #ef4444;
    padding: 4px 8px;
    border-radius: 6px;
    font-weight: 600;
}

/* ================= INFO BOX ================= */
.info-box-custom {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-left: 4px solid var(--primary);
    border-radius: 12px;
    padding: 15px;
}
</style>

<div class="content-wrapper">
    <section class="content pt-4">
        <div class="container-fluid">
            
            <div class="d-flex align-items-center mb-4">
                <div class="bg-primary p-2 rounded mr-3 shadow-sm">
                    <i class="fas fa-history text-white"></i>
                </div>
                <div>
                    <h3 class="font-weight-bold text-dark mb-0">Riwayat Peminjaman Saya</h3>
                    <p class="text-muted small mb-0">Hanya menampilkan data peminjaman akun Anda</p>
                </div>
            </div>

            <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success border-0 shadow-sm mb-4" style="border-radius: 10px;">
                    <i class="fas fa-check-circle mr-2"></i> <?= $this->session->flashdata('success') ?>
                </div>
            <?php endif; ?>

            <div class="filter-section shadow-sm">
                <form method="get" action="<?= base_url('index.php/user/riwayat') ?>">
                    <div class="row align-items-end">
                        <div class="col-md-4">
    <label class="small font-weight-bold text-muted">FILTER STATUS</label>
    <select name="status" class="form-control">
                                <option value="">Tampilkan Semua</option>
                                <option value="pinjam" <?= ($this->input->get('status')=='pinjam')?'selected':'' ?>>📚 Sedang Dipinjam</option>
                                <option value="kembali" <?= ($this->input->get('status')=='kembali')?'selected':'' ?>>✅ Sudah Dikembalikan</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary btn-block font-weight-bold shadow-sm">
                                <i class="fas fa-filter mr-1"></i> Terapkan
                            </button>
                        </div>
                         <div class="col-md-2">
                            <a href="<?= base_url('index.php/user/buku') ?>" class="btn btn-outline-secondary w-100 font-weight-bold">RESET</a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card card-riwayat">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th width="35%">Informasi Buku</th>
                                    <th>Tgl Pinjam</th>
                                    <th>Tgl Kembali</th>
                                    <th class="text-center">Status</th>
                                    <th>Denda</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($riwayat)){ ?>
                                    <?php foreach($riwayat as $r){ ?>
                                        <tr>
                                            <td class="book-title-cell">
                                                <i class="fas fa-book mr-2 text-muted"></i>
                                                <?= $r->judul ?>
                                            </td>
                                            <td class="small text-muted">
                                                <?= date('d M Y', strtotime($r->tanggal_pinjam)) ?>
                                            </td>
                                            <td class="small">
                                                <?php if(!empty($r->tanggal_kembali) && $r->tanggal_kembali != '0000-00-00'){ ?>
                                                    <span class="text-success"><?= date('d M Y', strtotime($r->tanggal_kembali)) ?></span>
                                                <?php } else { ?>
                                                    <span class="text-warning font-italic">Belum Kembali</span>
                                                <?php } ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if($r->status == 'pinjam'){ ?>
                                                    <span class="badge-custom status-pinjam">Dipinjam</span>
                                                <?php } else { ?>
                                                    <span class="badge-custom status-selesai">Selesai</span>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if($r->denda > 0){ ?>
                                                    <span class="denda-bahaya">Rp <?= number_format($r->denda, 0, ',', '.') ?></span>
                                                <?php } else { ?>
                                                    <span class="text-muted small">-</span>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <div class="text-muted">
                                                <i class="fas fa-folder-open fa-3x mb-3" style="opacity: 0.3;"></i>
                                                <p>Tidak ada data peminjaman ditemukan.</p>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="mt-4 p-4 rounded-xl border-0 d-flex align-items-center shadow-lg info-box-custom">
    <div class="info-icon-wrapper mr-3">
        <i class="fas fa- Ith-circle fa-lg"></i>
    </div>
    <div class="info-text">
        <b class="d-block mb-1">Catatan Penting:</b>
        <span class="small-text">
            Batas waktu peminjaman adalah <b>7 hari</b> sejak tanggal pinjam. Mohon segera temui petugas perpustakaan di meja layanan untuk proses pengembalian atau perpanjangan buku.
        </span>
    </div>
</div>

        </div>
    </section>
</div>

<?php $this->load->view('templates/footer'); ?>