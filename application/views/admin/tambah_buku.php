<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar_admin'); ?>

<style>
    /* 1. Theme Variables */
    :root {
        --bg-body: #f8fafc;
        --bg-card: #ffffff;
        --text-main: #1e293b;
        --text-muted: #64748b;
        --input-bg: #ffffff;
        --input-border: #e2e8f0;
        --form-label: #475569;
        --primary-gradient: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
    }

    body.dark-mode {
        --bg-body: #0f172a;
        --bg-card: #1e293b;
        --text-main: #f1f5f9;
        --text-muted: #94a3b8;
        --input-bg: #1e293b;
        --input-border: #334155;
        --form-label: #cbd5e1;
    }

    /* 2. Background Page */
    .content-wrapper {
        background: var(--bg-body) !important;
        background-image: 
            radial-gradient(at 100% 0%, rgba(99, 102, 241, 0.05) 0px, transparent 50%),
            radial-gradient(at 0% 100%, rgba(168, 85, 247, 0.03) 0px, transparent 50%) !important;
        min-height: 100vh;
        padding-top: 25px;
        transition: all 0.3s ease;
    }

    /* 3. Card Styling */
    .card-custom {
        border: none;
        border-radius: 20px;
        background: var(--bg-card);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        transition: background 0.3s ease;
    }

    .page-title {
        font-weight: 700;
        color: var(--text-main);
        letter-spacing: -0.5px;
    }

    /* 4. Form Styling */
    .form-group label {
        font-weight: 600;
        color: var(--form-label);
        font-size: 0.9rem;
        margin-bottom: 8px;
    }

    .form-control {
        background-color: var(--input-bg);
        color: var(--text-main);
        border-radius: 12px;
        padding: 12px 15px;
        border: 1px solid var(--input-border);
        transition: all 0.3s ease;
    }

    .form-control:focus {
        background-color: var(--input-bg);
        color: var(--text-main);
        border-color: #6366f1;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }

    /* 5. Button Styling */
    .btn-save {
        background: var(--primary-gradient);
        border: none;
        border-radius: 12px;
        padding: 10px 25px;
        font-weight: 600;
        color: white !important;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(99, 102, 241, 0.4);
    }

    .btn-back {
        background: var(--input-border);
        color: var(--text-muted);
        border: none;
        border-radius: 12px;
        padding: 10px 25px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-back:hover {
        background: #64748b;
        color: white;
    }

    /* Icon Input */
    .input-icon-wrapper {
        position: relative;
    }
    
    .input-icon-wrapper i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #6366f1;
    }

    .input-icon-wrapper .form-control {
        padding-left: 45px;
    }
</style>

<div class="content-wrapper">
    <section class="content pt-3">
        <div class="container-fluid">

            <div class="mb-4">
                <h3 class="page-title mb-0">➕ Tambah Buku Baru</h3>
                <p class="text-muted small">Lengkapi formulir di bawah untuk menambah koleksi perpustakaan.</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="card card-custom">
                        <div class="card-body p-4">

                            <form method="post" action="<?= base_url('index.php/buku/simpan') ?>">

                                <div class="form-group mb-4">
                                    <label>Judul Buku</label>
                                    <div class="input-icon-wrapper">
                                        <i class="fas fa-book"></i>
                                        <input type="text" name="judul" class="form-control" required placeholder="Masukkan judul buku">
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <label>Pengarang</label>
                                    <div class="input-icon-wrapper">
                                        <i class="fas fa-user-edit"></i>
                                        <input type="text" name="pengarang" class="form-control" required placeholder="Nama penulis/pengarang">
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <label>Stok Inventaris</label>
                                    <div class="input-icon-wrapper">
                                        <i class="fas fa-cubes"></i>
                                        <input type="number" name="stok" class="form-control" required placeholder="0" min="0">
                                    </div>
                                    <small class="text-muted mt-2 d-block">Jumlah buku yang tersedia saat ini.</small>
                                </div>

                                <hr class="my-4" style="border-top: 1px dashed var(--input-border);">

                                <div class="d-flex justify-content-between">
                                    <a href="<?= base_url('index.php/buku') ?>" class="btn-back text-decoration-none">
                                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                                    </a>
                                    <button type="submit" class="btn-save">
                                        <i class="fas fa-save mr-2"></i> Simpan Buku
                                    </button>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<?php $this->load->view('templates/footer'); ?>