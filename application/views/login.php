<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium Login | EFWAY</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;500;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-dark: #05070a;
            --accent-neon: #00f2ff;
            --accent-purple: #7000ff;
            --glass: rgba(15, 23, 42, 0.7);
        }

        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Space Grotesk', sans-serif;
            background-color: var(--bg-dark);
            overflow: hidden;
        }

        /* ===== TAMBAHAN BACKGROUND GRID ===== */
        .grid-bg {
            position: fixed;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 40px 40px;
            z-index: -3;
            animation: moveGrid 20s linear infinite;
        }

        @keyframes moveGrid {
            from { transform: translateY(0); }
            to { transform: translateY(40px); }
        }

        /* ===== TAMBAHAN PARTICLES ===== */
        .particles {
            position: fixed;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -2;
        }

        .particles span {
            position: absolute;
            background: rgba(0, 242, 255, 0.8);
            border-radius: 50%;
            animation: animateParticles linear infinite;
            box-shadow: 0 0 10px rgba(0, 242, 255, 0.7);
        }

        @keyframes animateParticles {
            0% {
                transform: translateY(100vh) scale(0);
                opacity: 0;
            }
            10% { opacity: 1; }
            100% {
                transform: translateY(-10vh) scale(1);
                opacity: 0;
            }
        }

        /* ===== BACKGROUND ASLI (TIDAK DIUBAH) ===== */
        .bg-wrapper {
            position: fixed;
            width: 100vw;
            height: 100vh;
            background: radial-gradient(circle at 10% 20%, rgba(112, 0, 255, 0.15) 0%, transparent 40%),
                        radial-gradient(circle at 90% 80%, rgba(0, 242, 255, 0.1) 0%, transparent 40%);
            z-index: -1;
        }

        .blob {
            position: absolute;
            width: 300px;
            height: 300px;
            background: var(--accent-purple);
            filter: blur(80px);
            border-radius: 50%;
            z-index: -1;
            animation: move 20s infinite alternate;
            opacity: 0.4;
        }

        @keyframes move {
            from { transform: translate(-10%, -10%); }
            to { transform: translate(20%, 20%); }
        }

        /* ===== SEMUA STYLE ASLI TETAP ===== */
        .login-container {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background: var(--glass);
            backdrop-filter: blur(20px);
            border-radius: 40px;
            padding: 50px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 40px 100px rgba(0, 0, 0, 0.8);
            position: relative;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .brand-logo {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(to right, #fff, var(--accent-neon));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -2px;
            margin-bottom: 10px;
        }

        .sub-text {
            color: #94a3b8;
            font-size: 0.95rem;
            margin-bottom: 40px;
        }

        .input-group-modern {
            margin-bottom: 25px;
            position: relative;
        }

        .input-group-modern input {
            width: 100%;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 15px 20px 15px 50px;
            color: #fff;
            transition: 0.4s;
        }

        .input-group-modern input:focus {
            outline: none;
            border-color: var(--accent-neon);
            background: rgba(255, 255, 255, 0.07);
            box-shadow: 0 0 20px rgba(0, 242, 255, 0.1);
        }

        .input-group-modern i {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            transition: 0.3s;
        }

        .input-group-modern input:focus + i {
            color: var(--accent-neon);
        }

        .btn-neon {
            background: #fff;
            color: #000;
            border: none;
            padding: 16px;
            border-radius: 15px;
            font-weight: 700;
            width: 100%;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: 0.3s;
        }

        .btn-neon:hover {
            background: var(--accent-neon);
            box-shadow: 0 0 30px rgba(0, 242, 255, 0.5);
            transform: translateY(-2px);
        }

        .register-text {
            margin-top: 30px;
            color: #64748b;
            font-size: 0.9rem;
        }

        .register-text a {
            color: var(--accent-neon);
            text-decoration: none;
            font-weight: 600;
        }

        .card-decoration {
            position: absolute;
            top: -20px;
            right: -20px;
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--accent-purple), var(--accent-neon));
            border-radius: 20px;
            transform: rotate(15deg);

        }
    </style>
</head>
<body>

<!-- TAMBAHAN (BACKGROUND ANIMASI) -->
<div class="grid-bg"></div>
<div class="particles" id="particles"></div>

<!-- KODE ASLI KAMU -->
<div class="bg-wrapper">
    <div class="blob"></div>
</div>

<div class="container login-container">
    <div class="login-card">
        <div class="card-decoration"></div>
        
        <div class="text-center">
            <h1 class="brand-logo">LIBEFWAY</h1>
            <p class="sub-text">Selamat datang kembali, Penjelajah Ilmu.</p>
        </div>

        <form method="post" action="<?= base_url('index.php/auth/login') ?>">
            <div class="input-group-modern">
                <input type="text" name="username" placeholder="Username" required autofocus>
                <i class="fas fa-user-astronaut"></i>
            </div>

            <div class="input-group-modern">
                <input type="password" name="password" placeholder="Password" required>
                <i class="fas fa-shield-halved"></i>
            </div>

            <button type="submit" class="btn-neon">
                Masuk Sistem <i class="fas fa-arrow-right ms-2"></i>
            </button>
        </form>

        <div class="text-center register-text">
            Belum punya akses? <a href="<?= base_url('index.php/auth/register') ?>">Daftar Sekarang</a>
            <div class="mt-4 opacity-50" style="font-size: 0.7rem; letter-spacing: 2px;">
                &copy; 2026 EFWAY CORE SYSTEM
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT PARTICLES -->
<script>
const particles = document.getElementById('particles');

for (let i = 0; i < 40; i++) {
    let span = document.createElement('span');
    let size = Math.random() * 4 + 2;

    span.style.width = size + 'px';
    span.style.height = size + 'px';
    span.style.left = Math.random() * 100 + '%';
    span.style.animationDuration = (Math.random() * 10 + 10) + 's';
    span.style.animationDelay = Math.random() * 5 + 's';

    particles.appendChild(span);
}
</script>

</body>
</html>