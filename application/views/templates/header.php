<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aplikasi Perpustakaan</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        /* CSS Kustom untuk Transisi Halus */
        body {
            transition: background-color 0.3s, color 0.3s;
        }

        /* Styling Tombol Toggle */
        .nav-link#theme-toggle {
            cursor: pointer;
            font-size: 1.2rem;
            padding: 8px 15px;
            transition: transform 0.3s ease;
        }

        .nav-link#theme-toggle:hover {
            transform: scale(1.1);
        }

        /* Override Dark Mode AdminLTE agar lebih konsisten */
        body.dark-mode .main-header {
            background-color: #343a40 !important;
            border-color: #4b545c !important;
        }

        body.dark-mode .content-wrapper {
            background-color: #454d55 !important;
            color: #fff;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed transition-elements">
<div class="wrapper">

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
    </ul>

    <ul class="navbar-nav ms-auto align-items-center">
        <li class="nav-item">
            <a class="nav-link" id="theme-toggle" title="Ganti Tema">
                <i class="fas fa-moon"></i>
            </a>
        </li>

        <li class="nav-item">
            <span class="nav-link font-weight-bold">
                <i class="fas fa-user-circle mr-1"></i>
                <?= $this->session->userdata('nama'); ?>
            </span>
        </li>
    </ul>
</nav>

<script>
    // Logika Tema (Letakkan di header agar tidak terjadi 'flicker' saat load)
    const btnToggle = document.querySelector('#theme-toggle');
    const iconToggle = btnToggle.querySelector('i');
    const body = document.body;
    const navbar = document.querySelector('.main-header');

    // Cek preferensi user di localStorage
    if (localStorage.getItem('theme') === 'dark') {
        setDarkMode();
    }

    btnToggle.addEventListener('click', () => {
        if (body.classList.contains('dark-mode')) {
            setLightMode();
        } else {
            setDarkMode();
        }
    });

    function setDarkMode() {
        body.classList.add('dark-mode');
        // Menyesuaikan Navbar AdminLTE
        navbar.classList.replace('navbar-white', 'navbar-dark');
        navbar.classList.replace('navbar-light', 'navbar-gray-dark');
        
        iconToggle.classList.replace('fa-moon', 'fa-sun');
        localStorage.setItem('theme', 'dark');
    }

    function setLightMode() {
        body.classList.remove('dark-mode');
        // Menyesuaikan Navbar AdminLTE
        navbar.classList.replace('navbar-dark', 'navbar-white');
        navbar.classList.replace('navbar-gray-dark', 'navbar-light');

        iconToggle.classList.replace('fa-sun', 'fa-moon');
        localStorage.setItem('theme', 'light');
    }
</script>