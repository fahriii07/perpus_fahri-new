<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar_admin'); ?>

<style>
/* --- Theme Variables --- */
:root {
    --bg-body: #f8fafc;
    --bg-card: #ffffff;
    --text-main: #1e293b;
    --text-muted: #64748b;
    --input-bg: #ffffff;
    --input-border: #e2e8f0;
    --form-label: #475569;
    --primary-gradient: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    --shadow: 0 15px 35px rgba(0, 0, 0, .08);
}

body.dark-mode {
    --bg-body: #0f172a;
    --bg-card: #1e293b;
    --text-main: #f1f5f9;
    --text-muted: #94a3b8;
    --input-bg: #0f172a;
    --input-border: #334155;
    --form-label: #cbd5e1;
    --shadow: 0 18px 35px rgba(0, 0, 0, .35);
}

.content-wrapper {
    background: var(--bg-body) !important;
    background-image:
        radial-gradient(at 100% 0%, rgba(99, 102, 241, .08) 0px, transparent 50%),
        radial-gradient(at 0% 100%, rgba(168, 85, 247, .06) 0px, transparent 50%) !important;
    min-height: 100vh;
    padding: 25px 0;
    transition: .3s ease;
}

.page-title { font-weight: 800; color: var(--text-main); letter-spacing: -.5px; }

.card-custom {
    background: var(--bg-card);
    border: none;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: var(--shadow);
}

.card-header-modern {
    padding: 22px 28px;
    background: linear-gradient(135deg, rgba(99, 102, 241, .10), rgba(168, 85, 247, .08));
    border-bottom: 1px solid var(--input-border);
}

.card-header-modern h5 { margin: 0; font-weight: 800; color: var(--text-main); }

.form-group label { font-weight: 700; color: var(--form-label); margin-bottom: 10px; display: block; font-size: .92rem; }

.input-icon-wrapper { position: relative; }
.input-icon-wrapper i { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: #6366f1; z-index: 2; }
.input-icon-wrapper .form-control { padding-left: 46px; }

.form-control {
    background: var(--input-bg) !important;
    color: var(--text-main) !important;
    border: 1px solid var(--input-border) !important;
    border-radius: 14px;
    min-height: 50px;
}

.upload-box {
    border: 2px dashed var(--input-border);
    border-radius: 20px;
    padding: 25px;
    text-align: center;
    background: rgba(99, 102, 241, .03);
}

.preview-cover {
    width: 140px;
    height: 190px;
    object-fit: cover;
    border-radius: 16px;
    display: none;
    margin: 15px auto 0;
    box-shadow: 0 10px 20px rgba(0, 0, 0, .12);
}

.btn-save {
    background: var(--primary-gradient);
    color: #fff !important;
    border: none;
    border-radius: 14px;
    padding: 11px 24px;
    font-weight: 700;
    box-shadow: 0 10px 24px rgba(99, 102, 241, .25);
    transition: .25s;
}

.btn-save:hover:not(:disabled) { transform: translateY(-2px); box-shadow: 0 16px 28px rgba(99, 102, 241, .35); }
.btn-save:disabled { opacity: 0.7; cursor: not-allowed; }

.btn-back {
    background: var(--input-border);
    color: var(--text-muted) !important;
    border-radius: 14px;
    padding: 11px 24px;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}
</style>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">

            <div class="mb-4">
                <h3 class="page-title mb-1">➕ Tambah Buku Baru</h3>
                <p class="text-muted small">Lengkapi data buku dan upload cover koleksi perpustakaan.</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card card-custom">
                        <div class="card-header-modern">
                            <h5><i class="fas fa-book-medical mr-2"></i> Form Input Buku</h5>
                        </div>

                        <div class="card-body">
                            <form method="post" 
                                  action="<?= base_url('index.php/buku/simpan') ?>" 
                                  enctype="multipart/form-data" 
                                  autocomplete="off" 
                                  id="formBuku">

                                <div class="form-group">
                                    <label>Judul Buku</label>
                                    <div class="input-icon-wrapper">
                                        <i class="fas fa-book"></i>
                                        <input type="text" name="judul" class="form-control" placeholder="Masukkan judul buku" required value="<?= set_value('judul') ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Pengarang</label>
                                    <div class="input-icon-wrapper">
                                        <i class="fas fa-user-edit"></i>
                                        <input type="text" name="pengarang" class="form-control" placeholder="Nama penulis" required value="<?= set_value('pengarang') ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Stok Inventaris</label>
                                    <div class="input-icon-wrapper">
                                        <i class="fas fa-cubes"></i>
                                        <input type="number" name="stok" class="form-control" placeholder="0" min="0" required value="<?= set_value('stok') ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Cover Buku</label>
                                    <div class="upload-box">
                                        <div class="font-weight-bold mb-2">Upload Cover Buku</div>
                                        <small class="d-block mb-3">JPG / PNG / WEBP (Maks 2MB)</small>
                                        <input type="file" name="cover" id="coverInput" class="form-control" accept=".jpg,.jpeg,.png,.webp">
                                        <img id="previewCover" class="preview-cover">
                                    </div>
                                </div>

                                <hr class="my-4">

                                <div class="d-flex justify-content-between flex-wrap" style="gap:12px;">
                                    <a href="<?= base_url('index.php/buku') ?>" class="btn-back">
                                        <i class="fas fa-arrow-left"></i> Kembali
                                    </a>

                                    <button type="submit" id="btnSave" class="btn-save">
                                        <i class="fas fa-save"></i> Simpan Buku
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

<script>
    // Handle Preview Gambar
    document.getElementById('coverInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('previewCover');
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        }
    });

    // Handle Submit Form (Mencegah double click & reload error)
    document.getElementById('formBuku').addEventListener('submit', function(e) {
        const btn = document.getElementById('btnSave');
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Menyimpan...';
    });
</script>

<?php $this->load->view('templates/footer'); ?>