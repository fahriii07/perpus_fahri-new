<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar_admin'); ?>

<style>
    /* 1. Theme Variables */
    :root {
        --bg-body: #f8fafc;
        --bg-card: #ffffff;
        --text-main: #1e293b;
        --text-muted: #64748b;
        --form-label: #475569;
        --input-bg: #ffffff;
        --input-border: #e2e8f0;
        --input-readonly: #f8fafc;
        --input-group-bg: #f8fafc;
        --info-box-bg: #f0f9ff;
        --info-box-border: #0ea5e9;
    }

    body.dark-mode {
        --bg-body: #0f172a;
        --bg-card: #1e293b;
        --text-main: #f1f5f9;
        --text-muted: #94a3b8;
        --form-label: #cbd5e1;
        --input-bg: #1e293b;
        --input-border: #334155;
        --input-readonly: #1a2233;
        --input-group-bg: #334155;
        --info-box-bg: rgba(14, 165, 233, 0.1);
        --info-box-border: #0ea5e9;
    }

    /* 2. Base Background */
    .content-wrapper {
        background: var(--bg-body) !important;
        background-image: 
            radial-gradient(at 100% 0%, rgba(99, 102, 241, 0.05) 0px, transparent 50%),
            radial-gradient(at 0% 100%, rgba(168, 85, 247, 0.03) 0px, transparent 50%) !important;
        padding-top: 25px;
        transition: all 0.3s ease;
    }

    /* 3. Card Edit Styling */
    .card-edit {
        border: none;
        border-radius: 20px;
        background: var(--bg-card);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        transition: background 0.3s ease;
    }

    /* 4. Form Styling */
    .form-label {
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

    .form-control:read-only {
        background-color: var(--input-readonly);
        cursor: not-allowed;
        opacity: 0.8;
    }

    .input-group-text {
        border-radius: 12px 0 0 12px;
        background: var(--input-group-bg);
        border: 1px solid var(--input-border);
        border-right: none;
        color: var(--text-muted);
    }

    .input-with-icon .form-control {
        border-left: none;
        border-radius: 0 12px 12px 0;
    }

    /* 5. Button Styling */
    .btn-save {
        background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
        border: none;
        border-radius: 12px;
        padding: 12px 30px;
        font-weight: 600;
        color: white !important;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(99, 102, 241, 0.4);
    }

    .btn-cancel {
        background: var(--input-group-bg);
        color: var(--text-muted);
        border: none;
        border-radius: 12px;
        padding: 12px 30px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-cancel:hover {
        background: #64748b;
        color: white;
    }

    /* 6. Info Box & Status */
    .info-box-status {
        background: var(--info-box-bg);
        border-radius: 12px;
        padding: 20px;
        border-left: 4px solid var(--info-box-border);
    }

    hr {
        border-top: 1px solid var(--input-border);
    }
</style>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            
            <div class="mb-4">
                <h3 class="font-weight-bold" style="color: var(--text-main);">✏️ Edit Profil Anggota</h3>
                <p class="text-muted small">Perbarui informasi keanggotaan untuk <strong style="color: #6366f1;"><?= $anggota->nama ?></strong></p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card card-edit shadow-sm">
                        <div class="card-body p-4">
                            
                            <form action="<?= base_url('index.php/anggota/proses_update') ?>" method="post">
                                <input type="hidden" name="id" value="<?= $anggota->id ?>">

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Nama Lengkap</label>
                                        <div class="input-group input-with-icon">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            </div>
                                            <input type="text" name="nama" class="form-control" value="<?= $anggota->nama ?>" required placeholder="Masukkan nama lengkap">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Username</label>
                                        <div class="input-group input-with-icon">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-at"></i></span>
                                            </div>
                                            <input type="text" class="form-control" value="<?= $anggota->username ?>" readonly>
                                        </div>
                                        <small class="text-muted font-italic mt-1 d-block">Username tidak dapat diubah.</small>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Kelas</label>
                                        <div class="input-group input-with-icon">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-graduation-cap"></i></span>
                                            </div>
                                            <input type="text" name="kelas" class="form-control" value="<?= $anggota->kelas ?>" placeholder="Contoh: XII">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label class="form-label">Jurusan</label>
                                        <div class="input-group input-with-icon">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-book"></i></span>
                                            </div>
                                            <input type="text" name="jurusan" class="form-control" value="<?= $anggota->jurusan ?>" placeholder="Contoh: RPL">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Nomor Telepon / WhatsApp</label>
                                    <div class="input-group input-with-icon">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                                        </div>
                                        <input type="text" name="kontak" class="form-control" value="<?= $anggota->kontak ?>" placeholder="08xxxxxxxxxx">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Alamat Lengkap</label>
                                    <textarea name="alamat" class="form-control" rows="3" placeholder="Masukkan alamat lengkap..."><?= $anggota->alamat ?></textarea>
                                </div>

                                <div class="info-box-status mb-4">
                                    <div class="d-flex align-items-start">
                                        <i class="fas fa-shield-alt text-info mr-3 mt-1" style="font-size: 1.5rem;"></i>
                                        <div class="w-100">
                                            <label class="form-label mb-0">Password Baru (Opsional)</label>
                                            <p class="text-muted small mb-2">Kosongkan jika tidak ingin mengganti password.</p>
                                            <input type="password" name="password" class="form-control" placeholder="Masukkan password baru">
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="<?= base_url('index.php/anggota') ?>" class="btn-cancel text-decoration-none d-flex align-items-center">
                                        <i class="fas fa-arrow-left mr-2"></i> Kembali
                                    </a>
                                    <button type="submit" class="btn-save">
                                        <i class="fas fa-save mr-2"></i> Simpan Perubahan
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