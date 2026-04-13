<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar_admin'); ?>

<style>
    /* 1. Theme Variables */
    :root {
        --bg-body: #f8fafc;
        --bg-card: #ffffff;
        --text-main: #1e293b;
        --text-muted: #64748b;
        --info-icon-bg: #f8fafc;
        --border-dashed: #e2e8f0;
        --btn-back-bg: #f1f5f9;
        --btn-back-text: #475569;
    }

    body.dark-mode {
        --bg-body: #0f172a;
        --bg-card: #1e293b;
        --text-main: #f1f5f9;
        --text-muted: #94a3b8;
        --info-icon-bg: #334155;
        --border-dashed: #334155;
        --btn-back-bg: #334155;
        --btn-back-text: #cbd5e1;
    }

    /* 2. Background Page */
    .content-wrapper {
        background: var(--bg-body) !important;
        background-image: 
            radial-gradient(at 100% 0%, rgba(99, 102, 241, 0.05) 0px, transparent 50%),
            radial-gradient(at 0% 100%, rgba(168, 85, 247, 0.05) 0px, transparent 50%) !important;
        padding-top: 25px;
        transition: all 0.3s ease;
    }

    /* 3. Profile Card Styling */
    .card-profile {
        border: none;
        border-radius: 25px;
        background: var(--bg-card);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        overflow: hidden;
        transition: background 0.3s ease;
    }

    .profile-header {
        height: 120px;
        background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
        position: relative;
    }

    .profile-avatar-wrapper {
        width: 110px;
        height: 110px;
        background: var(--bg-card);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: -55px auto 0;
        position: relative;
        z-index: 2;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        transition: background 0.3s ease;
    }

    .profile-avatar-inner {
        width: 95px;
        height: 95px;
        background: var(--info-icon-bg);
        color: #6366f1;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        font-weight: 800;
        text-transform: uppercase;
    }

    /* 4. Info Section */
    .info-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: var(--text-muted);
        font-weight: 700;
        margin-bottom: 5px;
    }

    .info-value {
        font-size: 1rem;
        color: var(--text-main);
        font-weight: 600;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .info-icon {
        width: 38px;
        height: 38px;
        background: var(--info-icon-bg);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6366f1;
        font-size: 1rem;
    }

    /* 5. Status Badge */
    .status-badge {
        padding: 6px 16px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 700;
        background: rgba(34, 197, 94, 0.15);
        color: #22c55e;
        display: inline-block;
    }

    /* 6. Buttons */
    .btn-back {
        background: var(--btn-back-bg);
        color: var(--btn-back-text);
        border: none;
        border-radius: 12px;
        padding: 12px 25px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-back:hover {
        background: #64748b;
        color: white;
    }

    .btn-edit-profile {
        background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 12px 25px;
        font-weight: 600;
        transition: all 0.3s;
        box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
    }

    .btn-edit-profile:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(99, 102, 241, 0.4);
        color: white;
    }

    hr.dashed {
        border-top: 1px dashed var(--border-dashed);
        margin: 2rem 0;
    }
</style>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">

            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    
                    <div class="card card-profile mb-4">
                        <div class="profile-header"></div>
                        
                        <div class="profile-avatar-wrapper">
                            <div class="profile-avatar-inner">
                                <?= substr($anggota->nama, 0, 1) ?>
                            </div>
                        </div>

                        <div class="card-body text-center pt-3">
                            <h3 class="font-weight-bold mb-1" style="color: var(--text-main);"><?= $anggota->nama ?></h3>
                            <p class="text-muted mb-3">@<?= $anggota->username ?></p>
                            <span class="status-badge mb-4">
                                <i class="fas fa-check-circle mr-1"></i> Anggota Aktif
                            </span>

                            <hr class="dashed">

                            <div class="text-left px-md-4">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="info-label">Kelas</div>
                                        <div class="info-value">
                                            <div class="info-icon"><i class="fas fa-graduation-cap"></i></div>
                                            <?= $anggota->kelas ?: '-' ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="info-label">Jurusan</div>
                                        <div class="info-value">
                                            <div class="info-icon"><i class="fas fa-book"></i></div>
                                            <?= $anggota->jurusan ?: '-' ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="info-label">Kontak / WhatsApp</div>
                                <div class="info-value">
                                    <div class="info-icon"><i class="fas fa-phone-alt"></i></div>
                                    <?= $anggota->kontak ?: 'Tidak ada nomor tersedia' ?>
                                </div>

                                <div class="info-label">Alamat</div>
                                <div class="info-value">
                                    <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                                    <?= $anggota->alamat ?: 'Alamat belum diatur' ?>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer bg-transparent border-0 p-4 d-flex justify-content-between">
                            <a href="<?= base_url('index.php/anggota') ?>" class="btn-back">
                                <i class="fas fa-arrow-left mr-2"></i> Kembali
                            </a>
                            <a href="<?= base_url('index.php/anggota/edit/'.$anggota->id) ?>" class="btn-edit-profile">
                                <i class="fas fa-user-edit mr-2"></i> Edit Profil
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
</div>

<?php $this->load->view('templates/footer'); ?>