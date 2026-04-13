<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar_admin'); ?>

<style>
    /* 1. Theme Variables */
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

    /* 2. Base Background */
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

    /* 4. Button Tambah */
    .btn-add-member {
        background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
        border: none;
        border-radius: 12px;
        padding: 10px 24px;
        font-weight: 600;
        color: white !important;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
    }

    .btn-add-member:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(99, 102, 241, 0.4);
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

    /* 6. Avatar Circle */
    .avatar-circle {
        width: 40px;
        height: 40px;
        background: #6366f120;
        color: #6366f1;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        margin-right: 15px;
        text-transform: uppercase;
    }

    /* 7. Action Buttons (Dark Optimized) */
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
    .btn-edit-modern { background: rgba(202, 138, 4, 0.1); color: #ca8a04; }
    .btn-delete-modern { background: rgba(225, 29, 72, 0.1); color: #e11d48; }

    .btn-action:hover { color: white !important; transform: translateY(-2px); }
    .btn-detail-modern:hover { background: #0ea5e9; }
    .btn-edit-modern:hover { background: #ca8a04; }
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
                    <h3 class="page-title mb-1">👥 Data Anggota</h3>
                    <p class="text-muted small mb-0">Manajemen keanggotaan perpustakaan</p>
                </div>

                <a href="<?= base_url('index.php/anggota/tambah') ?>" class="btn btn-add-member">
                    <i class="fas fa-user-plus mr-2"></i> Tambah Anggota
                </a>
            </div>

            <?php if($this->session->flashdata('success')){ ?>
                <div class="alert alert-custom shadow-sm mb-4">
                    <i class="fas fa-check-circle mr-2"></i> <?= $this->session->flashdata('success') ?>
                </div>
            <?php } ?>

            <div class="card card-table-container shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Informasi Anggota</th>
                                    <th>Kelas & Jurusan</th>
                                    <th>Kontak</th>
                                    <th>Alamat</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($anggota as $a){ ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle">
                                                    <?= substr($a->nama, 0, 1) ?>
                                                </div>
                                                <div>
                                                    <div class="font-weight-bold"><?= $a->nama ?></div>
                                                    <small class="text-muted">@<?= $a->username ?></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="mb-1"><span class="badge badge-info-soft" style="background: rgba(99,102,241,0.15); color: #818cf8;"><?= $a->kelas ?: '-' ?></span></div>
                                            <div class="small text-muted font-italic"><?= $a->jurusan ?: '-' ?></div>
                                        </td>
                                        <td>
                                            <div class="small"><i class="fas fa-phone-alt mr-2 text-muted"></i><?= $a->kontak ?: '-' ?></div>
                                        </td>
                                        <td>
                                            <div class="small text-truncate" style="max-width: 150px;">
                                                <i class="fas fa-map-marker-alt mr-2 text-muted"></i><?= $a->alamat ?: '-' ?>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center" style="gap: 8px;">
                                                <a href="<?= base_url('index.php/anggota/detail/'.$a->id) ?>" class="btn-action btn-detail-modern" title="Detail"><i class="fas fa-eye"></i></a>
                                                <a href="<?= base_url('index.php/anggota/edit/'.$a->id) ?>" class="btn-action btn-edit-modern" title="Edit"><i class="fas fa-edit"></i></a>
                                                <a href="<?= base_url('index.php/anggota/hapus/'.$a->id) ?>" class="btn-action btn-delete-modern" onclick="confirmDelete(event, this.href)" title="Hapus"><i class="fas fa-trash-alt"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                                <?php if(empty($anggota)){ ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <i class="fas fa-user-friends fa-3x text-muted mb-3" style="opacity: 0.3;"></i>
                                            <p class="text-muted">Belum ada anggota terdaftar.</p>
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
        title: 'Hapus Anggota?',
        text: "Data anggota ini akan dihapus permanen!",
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