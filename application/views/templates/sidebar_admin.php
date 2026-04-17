<style>
    /* Upgrade Sidebar Container */
    .main-sidebar {
        background: #1e1e2d !important;
        transition: all 0.3s ease;
    }

    .brand-link {
        border-bottom: 1px solid rgba(255,255,255,0.05) !important;
        padding: 20px 15px !important;
        background: rgba(0,0,0,0.1);
    }

    .brand-text {
        font-weight: 700 !important;
        letter-spacing: 1px;
        color: #ffffff;
        text-transform: uppercase;
        font-size: 1.1rem;
    }

    .nav-sidebar .nav-item {
        margin: 5px 12px;
    }

    .nav-sidebar .nav-link {
        border-radius: 12px !important;
        padding: 12px 15px !important;
        transition: all 0.3s ease;
        color: #a2a3b7 !important;
    }

    .nav-sidebar .nav-link:hover {
        background: rgba(255,255,255,0.05) !important;
        color: #ffffff !important;
        transform: translateX(5px);
    }

    .nav-sidebar .nav-item.menu-open > .nav-link, 
    .nav-sidebar .nav-link.active {
        background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%) !important;
        color: #ffffff !important;
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
    }

    .nav-icon {
        margin-right: 12px !important;
        font-size: 1.1rem !important;
        width: 25px;
        text-align: center;
        transition: transform 0.3s ease;
    }

    .nav-link:hover .nav-icon {
        transform: scale(1.2);
    }

    .nav-logout {
        margin-top: 30px !important;
        border: 1px solid rgba(255, 75, 75, 0.2) !important;
    }
    
    .nav-logout:hover {
        background: rgba(255, 75, 75, 0.1) !important;
        color: #ff4b4b !important;
    }

    .sidebar-divider {
        height: 1px;
        background: rgba(255,255,255,0.05);
        margin: 15px 20px;
    }
</style>

<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="#" class="brand-link text-center">
        <span class="brand-text">📚 PERPUS<span style="color: #6366f1;">EFWAY</span></span>
    </a>

    <div class="sidebar">

        <!-- USER INFO -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center px-3">
            <div class="image">
                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                    <i class="fas fa-user-shield text-white" style="font-size: 14px;"></i>
                </div>
            </div>
            <div class="info ml-2">
                <a href="#" class="d-block text-white font-weight-600" style="font-size: 0.9rem;">Administrator</a>
                <span class="badge badge-success" style="font-size: 0.6rem; padding: 2px 5px;">ONLINE</span>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview">

                <!-- MAIN -->
                <li class="nav-header small text-uppercase text-muted px-4 mb-2">Main Menu</li>

                <li class="nav-item">
                    <a href="<?= base_url('index.php/admin') ?>" 
                       class="nav-link <?= ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == '') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-th-large"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('index.php/anggota') ?>" 
                       class="nav-link <?= ($this->uri->segment(1) == 'anggota') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-user-friends"></i>
                        <p>Kelola Anggota</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('index.php/buku') ?>" 
                       class="nav-link <?= ($this->uri->segment(1) == 'buku') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-book-reader"></i>
                        <p>Kelola Buku</p>
                    </a>
                </li>

                <!-- ACTIVITIES -->
                <li class="nav-header small text-uppercase text-muted px-4 mt-3 mb-2">Activities</li>

                <li class="nav-item">
                    <a href="<?= base_url('index.php/admin/transaksi') ?>" 
                       class="nav-link <?= ($this->uri->segment(2) == 'transaksi' && $this->uri->segment(3) == '') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-exchange-alt"></i>
                        <p>Kelola Transaksi</p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="<?= base_url('index.php/laporan') ?>" 
                       class="nav-link <?= ($this->uri->segment(1) == 'laporan') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>Laporan</p>
                    </a>
                </li>

                <div class="sidebar-divider"></div>

                <!-- LOGOUT -->
                <li class="nav-item">
                    <a href="<?= base_url('index.php/auth/logout') ?>" class="nav-link nav-logout">
                        <i class="nav-icon fas fa-power-off"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </nav>

    </div>
</aside>