<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar_admin'); ?>

<style>
    /* 1. Theme Variables - Sama dengan Anggota */
    :root {
        --bg-body: #f8fafc;
        --bg-card: #ffffff;
        --text-main: #1e293b;
        --text-muted: #64748b;
        --table-header: #f1f5f9;
        --border-color: #f1f5f9;
        --hover-row: #f8fafc;
        --input-bg: #ffffff;
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
        border: none;
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
    }

    /* 5. Card & Table Styling */
    .card-table-container {
        border: none;
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

    /* 6. Status & Denda Badges */
    .badge-status {
        padding: 6px 14px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 0.75rem;
        display: inline-block;
    }
    .status-pinjam { background: rgba(245, 158, 11, 0.15); color: #f59e0b; }
    .status-selesai { background: rgba(34, 197, 94, 0.15); color: #22c55e; }

    .denda-amount {
        font-family: 'Monaco', 'Consolas', monospace;
        padding: 4px 10px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
    }
    .has-denda { background: rgba(225, 29, 72, 0.1); color: #e11d48; }
    .no-denda { background: var(--table-header); color: var(--text-muted); }

    /* 7. Action Buttons (Konsisten dengan Anggota) */
    .btn-action {
        border: none;
        border-radius: 10px;
        padding: 8px 12px;
        font-weight: 600;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-detail-modern { background: rgba(14, 165, 233, 0.1); color: #0ea5e9; }
    .btn-kembali-modern { background: rgba(34, 197, 94, 0.1); color: #22c55e; }
    .btn-delete-modern { background: rgba(225, 29, 72, 0.1); color: #e11d48; }

    .btn-action:hover { color: white !important; transform: translateY(-2px); }
    .btn-detail-modern:hover { background: #0ea5e9; }
    .btn-kembali-modern:hover { background: #22c55e; }
    .btn-delete-modern:hover { background: #e11d48; }

    /* Alert Styling */
    .alert-custom {
        border-radius: 12px;
        background: rgba(22, 101, 52, 0.1);
        border: 1px solid rgba(22, 101, 52, 0.2);
        color: #22c55e;
    }
</style>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 class="page-title mb-1">📋 Log Transaksi</h3>
                    <p class="text-muted small mb-0">Pantau arus peminjaman dan pengembalian buku</p>
                </div>
            </div>

            <div class="card filter-card shadow-sm mb-4">
                <div class="card-body">
                    <form method="get" action="<?= base_url('index.php/admin/transaksi') ?>">
                        <div class="row align-items-end">
                            <div class="col-md-4">
                                <label class="small font-weight-bold text-muted">Filter Status</label>
                                <select name="status" class="form-control form-control-custom border-0 shadow-none">
                                    <option value="">Semua Status</option>
                                    <option value="pinjam" <?= ($this->input->get('status') == 'pinjam') ? 'selected' : '' ?>>Dipinjam</option>
                                    <option value="kembali" <?= ($this->input->get('status') == 'kembali') ? 'selected' : '' ?>>Selesai/Kembali</option>
                                </select>
                            </div>
                            <div class="col-md-4">
    <button type="submit" class="btn btn-primary px-4 font-weight-bold" style="border-radius: 10px; background: #6366f1; border: none; box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);">
        <i class="fas fa-filter mr-1"></i> Terapkan Filter
    </button>
    
    <a href="<?= base_url('index.php/admin/transaksi') ?>" class="btn-reset-modern small ml-2">
        <i class="fas fa-undo-alt small"></i> Reset
    </a>
</div>
                        </div>
                    </form>
                </div>
            </div>

            <?php if($this->session->flashdata('success')){ ?>
                <div class="alert alert-custom shadow-sm mb-4">
                    <i class="fas fa-check-circle mr-2"></i> <?= $this->session->flashdata('success') ?>
                </div>
            <?php } ?>

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
                                    <th>Denda</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($transaksi as $t){ ?>
                                    <tr>
                                        <td>
                                            <div class="font-weight-bold"><?= $t->nama_user ?: '-' ?></div>
                                            <small class="text-muted">ID: #<?= str_pad($t->id, 4, '0', STR_PAD_LEFT) ?></small>
                                        </td>
                                        <td style="max-width: 200px;">
                                            <div class="text-truncate font-weight-bold"><?= $t->judul ?: '-' ?></div>
                                            <small class="text-muted">Buku Perpustakaan</small>
                                        </td>
                                        <td>
                                            <div class="small">
                                                <span class="text-success"><i class="fas fa-calendar-plus mr-1"></i> <?= date('d M Y', strtotime($t->tanggal_pinjam)) ?></span><br>
                                                <span class="<?= ($t->status == 'pinjam') ? 'text-muted' : 'text-danger' ?>">
                                                    <i class="fas fa-calendar-check mr-1"></i> 
                                                    <?= ($t->tanggal_kembali && $t->tanggal_kembali != '0000-00-00') ? date('d M Y', strtotime($t->tanggal_kembali)) : '<i>Sedang Dipinjam</i>' ?>
                                                </span>
                                            </div>
                                        </td>
                                        <td>
                                            <?php if($t->status=='pinjam'){ ?>
                                                <span class="badge-status status-pinjam">Pinjam</span>
                                            <?php } else { ?>
                                                <span class="badge-status status-selesai">Kembali</span>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <span class="denda-amount <?= $t->denda > 0 ? 'has-denda' : 'no-denda' ?>">
                                                Rp <?= number_format($t->denda) ?>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center" style="gap: 8px;">
                                                <?php if($t->status == 'pinjam'){ ?>
                                                    <a href="<?= base_url('index.php/admin/kembalikan/'.$t->id) ?>" 
                                                       class="btn-action btn-kembali-modern" 
                                                       onclick="return confirm('Proses pengembalian buku ini?')"
                                                       title="Kembalikan Buku"><i class="fas fa-undo"></i></a>
                                                <?php } ?>

                                                <a href="<?= base_url('index.php/admin/detail/'.$t->id) ?>" 
                                                   class="btn-action btn-detail-modern" title="Detail"><i class="fas fa-eye"></i></a>

                                                <a href="<?= base_url('index.php/admin/hapus_transaksi/'.$t->id) ?>" 
                                                   class="btn-action btn-delete-modern"
                                                   onclick="confirmDelete(event, this.href)" title="Hapus"><i class="fas fa-trash-alt"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>

                                <?php if(empty($transaksi)){ ?>
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <i class="fas fa-folder-open fa-3x text-muted mb-3" style="opacity: 0.3;"></i>
                                            <p class="text-muted">Tidak ada riwayat transaksi ditemukan.</p>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDelete(e, url) {
    const isDark = document.body.classList.contains('dark-mode');
    e.preventDefault();
    Swal.fire({
        title: 'Hapus Log?',
        text: "Data riwayat transaksi ini akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e11d48',
        cancelButtonColor: '#64748b',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal',
        background: isDark ? '#1e293b' : '#fff',
        color: isDark ? '#f1f5f9' : '#1e293b'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    })
}
</script>

<?php $this->load->view('templates/footer'); ?>