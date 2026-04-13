<style>
/* ================= ADVANCED MODERN THEME ================= */
:root {
    --bg-sidebar: #f8fafc;
    --side-gradient: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);
    --accent-color: #8b5cf6;
    --accent-gradient: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
    --text-main: #1e293b;
    --text-muted: #64748b;
    --glass-card: rgba(255, 255, 255, 0.7);
    --border-subtle: rgba(0, 0, 0, 0.05);
}

body.dark-mode {
    --bg-sidebar: #0f172a;
    --side-gradient: linear-gradient(180deg, #0f172a 0%, #020617 100%);
    --text-main: #f1f5f9;
    --text-muted: #94a3b8;
    --glass-card: rgba(255, 255, 255, 0.03);
    --border-subtle: rgba(255, 255, 255, 0.08);
}

.main-sidebar {
    background: var(--side-gradient) !important;
    border-right: 1px solid var(--border-subtle) !important;
    backdrop-filter: blur(10px);
}

/* BRAND LOGO */
.brand-link {
    border-bottom: 1px solid var(--border-subtle) !important;
    padding: 25px 15px !important;
    transition: 0.3s;
}

.brand-text {
    color: var(--text-main) !important;
    font-weight: 800 !important;
    letter-spacing: 1.5px;
    text-shadow: 0 2px 4px rgba(0,0,0,0.05);
}

/* ================= USER IDENTITY (NON-CLICKABLE) ================= */
.user-identity-card {
    padding: 20px 15px;
    margin: 15px;
    border-radius: 20px;
    background: var(--glass-card);
    border: 1px solid var(--border-subtle);
    display: flex;
    align-items: center;
    position: relative;
}

.user-avatar-wrapper {
    position: relative;
    flex-shrink: 0;
}

.user-avatar-square {
    width: 45px;
    height: 45px;
    border-radius: 12px;
    background: var(--accent-gradient);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    color: white;
    box-shadow: 0 8px 16px rgba(59, 130, 246, 0.2);
}

.status-dot {
    position: absolute;
    bottom: -3px;
    right: -3px;
    width: 12px;
    height: 12px;
    background: #10b981;
    border-radius: 50%;
    border: 2px solid var(--bg-sidebar);
    box-shadow: 0 0 10px rgba(16, 185, 129, 0.5);
}

.user-info {
    margin-left: 12px;
    overflow: hidden;
}

.user-info .name {
    color: var(--text-main);
    font-weight: 700;
    font-size: 0.9rem;
    margin: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.user-info .role {
    color: var(--text-muted);
    font-size: 0.75rem;
    display: flex;
    align-items: center;
    gap: 4px;
}

/* ================= NAVIGATION ================= */
.nav-sidebar {
    padding: 0 12px;
}

.nav-link {
    border-radius: 14px !important;
    margin-bottom: 8px !important;
    padding: 12px 16px !important;
    color: var(--text-muted) !important;
    font-weight: 500;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
}

.nav-link i {
    font-size: 1.1rem;
    margin-right: 12px !important;
    width: 24px;
    text-align: center;
}

.nav-link:hover {
    background: var(--glass-card) !important;
    color: var(--accent-color) !important;
    transform: translateX(5px);
}

.nav-link.active {
    background: var(--accent-gradient) !important;
    color: white !important;
    box-shadow: 0 10px 20px rgba(139, 92, 246, 0.3);
}

/* LOGOUT BUTTON */
.logout-item {
    margin-top: 30px !important;
}

.btn-logout {
    background: rgba(239, 68, 68, 0.05) !important;
    color: #ef4444 !important;
}

.btn-logout:hover {
    background: #ef4444 !important;
    color: white !important;
    box-shadow: 0 8px 16px rgba(239, 68, 68, 0.2);
}

/* SECTION LABEL */
.nav-header {
    font-size: 0.65rem !important;
    font-weight: 800 !important;
    text-transform: uppercase !important;
    letter-spacing: 2px !important;
    color: var(--text-muted) !important;
    padding: 15px 25px 10px !important;
    opacity: 0.6;
}
</style>

<aside class="main-sidebar elevation-4">
    <a href="#" class="brand-link text-center">
        <span class="brand-text">
            📚 PERPUS<span style="color:#8b5cf6;">EFWAY</span>
        </span>
    </a>

    <div class="sidebar p-0">
        <div class="user-identity-card">
            <div class="user-avatar-wrapper">
                <div class="user-avatar-square">
                    <?php if($this->session->userdata('user_avatar')): ?>
                        <img src="<?= $this->session->userdata('user_avatar') ?>" style="width:100%; height:100%; object-fit:cover; border-radius:12px;">
                    <?php else: ?>
                        <?= strtoupper(substr($this->session->userdata('nama'), 0, 1)) ?>
                    <?php endif; ?>
                </div>
                <div class="status-dot"></div>
            </div>

            <div class="user-info">
                <p class="name"><?= $this->session->userdata('nama') ?></p>
                <span class="role">
                    <i class="fas fa-check-circle" style="font-size: 10px; color: #3b82f6;"></i>
                    Siswa Aktif
                </span>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                
                <li class="nav-header">Main Menu</li>
                
                <li class="nav-item">
                    <a href="<?= base_url('index.php/user') ?>" class="nav-link <?= ($this->uri->segment(2) == '') ? 'active' : '' ?>">
                        <i class="fas fa-columns"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('index.php/user/buku') ?>" class="nav-link <?= ($this->uri->segment(3) == 'buku') ? 'active' : '' ?>">
                        <i class="fas fa-layer-group"></i>
                        <p>Katalog Buku</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('index.php/user/riwayat') ?>" class="nav-link <?= ($this->uri->segment(3) == 'riwayat') ? 'active' : '' ?>">
                        <i class="fas fa-receipt"></i>
                        <p>Riwayat Pinjam</p>
                    </a>
                </li>

                <li class="nav-item logout-item">
                    <a href="<?= base_url('index.php/auth/logout') ?>" class="nav-link btn-logout">
                        <i class="fas fa-power-off"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>