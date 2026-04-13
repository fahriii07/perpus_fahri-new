<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar_admin'); ?>

<style>
    /* 1. Theme Variables - Ultra Adaptive */
    :root {
        --bg-body: #f8fafc;
        --bg-card: #ffffff;
        --text-main: #1e293b;
        --text-muted: #64748b;
        --table-thead: #f1f5f9;
        --table-border: #edf2f7;
        --primary-gradient: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
    }

    body.dark-mode {
        --bg-body: #0f172a;
        --bg-card: #1e293b;
        --text-main: #f1f5f9 !important; /* Terang di mode gelap */
        --text-muted: #94a3b8 !important;
        --table-thead: #161e2e;
        --table-border: #334155;
    }

    /* 2. FORCE OVERRIDE - Menghapus kontras yang salah di Dark Mode */
    body.dark-mode .content-wrapper {
        background-color: var(--bg-body) !important;
        color: var(--text-main) !important;
    }

    /* Memaksa semua elemen di dalam tabel mengikuti variabel kita */
    body.dark-mode .table,
    body.dark-mode .table td,
    body.dark-mode .table th,
    body.dark-mode .table thead th,
    body.dark-mode .table div,
    body.dark-mode .table span:not(.badge-pill-custom),
    body.dark-mode .table small {
        color: var(--text-main) !important;
        border-color: var(--table-border) !important;
        background-color: transparent !important;
    }

    body.dark-mode .table thead th {
        background-color: var(--table-thead) !important;
        color: var(--text-muted) !important;
    }

    /* 3. Card Styling */
    .card-modern {
        border-radius: 20px;
        background: var(--bg-card);
        border: 1px solid var(--table-border);
        box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        overflow: hidden;
    }

    /* 4. Action Buttons */
    .btn-action {
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        color: white !important;
        transition: 0.2s;
        border: none;
    }

    .btn-action:hover { transform: translateY(-2px); opacity: 0.9; }

    /* 5. Badge Styling */
    .badge-pill-custom {
        padding: 6px 14px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 0.75rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .status-available { background: rgba(34, 197, 94, 0.15); color: #4ade80 !important; }
    .status-empty { background: rgba(239, 68, 68, 0.15); color: #f87171 !important; }

    .author-icon {
        width: 35px;
        height: 35px;
        background: var(--table-thead);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6366f1;
    }
</style>

<div class="content-wrapper">
    <section class="content pt-4">
        <div class="container-fluid">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3 style="color: var(--text-main); font-weight: 700; margin: 0;">📚 Koleksi Buku</h3>
                    <p style="color: var(--text-muted); margin: 0; font-size: 0.9rem;">Manajemen data inventaris perpustakaan.</p>
                </div>
                <a href="<?= base_url('index.php/buku/tambah') ?>" class="btn btn-primary" style="background: var(--primary-gradient); border: none; border-radius: 12px; padding: 10px 20px; font-weight: 600;">
                    <i class="fas fa-plus mr-2"></i> Tambah
                </a>
            </div>

            <div class="card card-modern">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Judul & ID</th>
                                    <th>Penulis</th>
                                    <th class="text-center">Stok</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; foreach($buku as $b): ?>
                                <tr>
                                    <td class="text-center" style="color: var(--text-muted) !important;"><?= $no++ ?></td>
                                    <td>
                                        <div style="font-weight: 600; font-size: 1rem;"><?= $b->judul ?></div>
                                        <small style="opacity: 0.7;">ID: #BK-<?= $b->id ?></small>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="author-icon mr-2"><i class="fas fa-user"></i></div>
                                            <span><?= $b->pengarang ?></span>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <?php if($b->stok > 0): ?>
                                            <span class="badge-pill-custom status-available">
                                                <i class="fas fa-check"></i> <?= $b->stok ?>
                                            </span>
                                        <?php else: ?>
                                            <span class="badge-pill-custom status-empty">
                                                <i class="fas fa-times"></i> Habis
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?= base_url('index.php/buku/edit/'.$b->id) ?>" class="btn-action shadow-sm" style="background: #f39c12;">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?= base_url('index.php/buku/hapus/'.$b->id) ?>" class="btn-action shadow-sm" style="background: #e74c3c;" onclick="return confirm('Hapus buku?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php $this->load->view('templates/footer'); ?>