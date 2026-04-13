<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar_admin'); ?>

<style>
    /* Base Background */
    .content-wrapper {
        background: #f8fafc;
        background-image: 
            radial-gradient(at 100% 0%, rgba(99, 102, 241, 0.03) 0px, transparent 50%),
            radial-gradient(at 0% 100%, rgba(168, 85, 247, 0.03) 0px, transparent 50%);
        padding-top: 25px;
    }

    .card-edit {
        border: none;
        border-radius: 20px;
        background: white;
        box-shadow: 0 10px 25px rgba(0,0,0,0.02);
    }

    .form-label {
        font-weight: 600;
        color: #475569;
        font-size: 0.9rem;
        margin-bottom: 8px;
    }

    .form-control {
        border-radius: 12px;
        padding: 12px 15px;
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }

    .input-group-text {
        border-radius: 12px 0 0 12px;
        background: #f8fafc;
        border-right: none;
        color: #64748b;
    }

    .input-with-icon .form-control {
        border-left: none;
        border-radius: 0 12px 12px 0;
    }

    /* Button Styling */
    .btn-save {
        background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
        border: none;
        border-radius: 12px;
        padding: 12px 30px;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(99, 102, 241, 0.3);
        color: white;
    }

    .btn-cancel {
        background: #f1f5f9;
        color: #64748b;
        border: none;
        border-radius: 12px;
        padding: 12px 30px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-cancel:hover {
        background: #e2e8f0;
        color: #1e293b;
    }

    .info-box-status {
        background: #f0f9ff;
        border-radius: 12px;
        padding: 15px;
        border-left: 4px solid #0ea5e9;
    }
</style>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            
            <div class="mb-4">
                <h3 class="font-weight-bold text-dark">✏️ Edit Profil Anggota</h3>
                <p class="text-muted small">Perbarui informasi keanggotaan untuk <strong><?= $anggota->nama ?></strong></p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card card-edit">
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
                                            <input type="text" class="form-control" value="<?= $anggota->username ?>" readonly style="background-color: #f8fafc; cursor: not-allowed;">
                                        </div>
                                        <small class="text-muted font-italic mt-1">Username tidak dapat diubah.</small>
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

                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <label class="form-label">Nomor Telepon / WhatsApp</label>
                                        <div class="input-group input-with-icon">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-phone-alt"></i></span>
                                            </div>
                                            <input type="text" name="kontak" class="form-control" value="<?= $anggota->kontak ?>" placeholder="08xxxxxxxxxx">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label">Alamat Lengkap</label>
                                    <textarea name="alamat" class="form-control" rows="3" placeholder="Masukkan alamat lengkap..."><?= $anggota->alamat ?></textarea>
                                </div>

                                <div class="info-box-status mb-4">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-shield-alt text-info mr-3" style="font-size: 1.5rem;"></i>
                                        <div>
                                            <label class="form-label mb-0">Password Baru (Opsional)</label>
                                            <p class="text-muted small mb-2">Kosongkan jika tidak ingin mengganti password.</p>
                                            <input type="password" name="password" class="form-control" placeholder="Masukkan password baru">
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="<?= base_url('index.php/anggota') ?>" class="btn-cancel text-decoration-none">
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