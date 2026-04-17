<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium Login | EFWAY</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --bg-dark: #05070a;
            --accent-neon: #00f2ff;
            --accent-purple: #7000ff;
            --glass: rgba(15, 23, 42, 0.6);
            --glass-border: rgba(255, 255, 255, 0.1);
        }

        body, html {
            height: 100%;
            margin: 0;
            background-color: var(--bg-dark);
            overflow: hidden;
            color: #fff;
        }

        /* ================= BACKGROUND ================= */
        .grid-bg {
            position: fixed;
            width: 200%;
            height: 200%;
            background-image: 
                linear-gradient(rgba(0, 242, 255, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 242, 255, 0.05) 1px, transparent 1px);
            background-size: 50px 50px;
            transform: perspective(500px) rotateX(60deg);
            animation: moveGrid 15s linear infinite;
            z-index: -3;
        }

        @keyframes moveGrid {
            0% { transform: perspective(500px) rotateX(60deg) translateY(0); }
            100% { transform: perspective(500px) rotateX(60deg) translateY(50px); }
        }

        /* ================= PARTICLES ================= */
        .particles span {
            position: absolute;
            width: 3px;
            height: 3px;
            background: var(--accent-neon);
            border-radius: 50%;
            animation: moveUp linear infinite;
        }

        @keyframes moveUp {
            0% { transform: translateY(100vh); opacity:0; }
            20% { opacity:1; }
            100% { transform: translateY(-10vh); opacity:0; }
        }

        /* ================= LOGIN CARD ================= */
        .login-container {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background: var(--glass);
            backdrop-filter: blur(25px);
            border-radius: 35px;
            padding: 50px;
            width: 100%;
            max-width: 420px;
            border: 1px solid var(--glass-border);
            box-shadow: 0 0 40px rgba(0,0,0,0.5);
            position: relative;
        }

        /* ================= ICON BUKU ================= */
        .book-icon {
            font-size: 60px;
            margin-bottom: 10px;
            color: var(--accent-neon);
            animation: floatBook 3s ease-in-out infinite;
            filter: drop-shadow(0 0 15px var(--accent-neon));
        }

        @keyframes floatBook {
            0%,100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        /* ================= TITLE ================= */
        .brand-logo {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(to right, #fff, var(--accent-neon));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .sub-text {
            color: #94a3b8;
            font-size: 0.9rem;
            margin-bottom: 30px;
        }

        /* ================= INPUT ================= */
        .input-group-modern {
            margin-bottom: 20px;
            position: relative;
        }

        .input-group-modern input {
            width: 100%;
            padding: 15px 20px 15px 45px;
            border-radius: 15px;
            border: 1px solid rgba(255,255,255,0.1);
            background: rgba(255,255,255,0.05);
            color: white;
        }

        .input-group-modern i {
            position: absolute;
            left: 15px;
            top: 15px;
            color: #94a3b8;
        }

        /* ================= BUTTON ================= */
        .btn-neon {
            width: 100%;
            padding: 15px;
            border-radius: 15px;
            border: none;
            background: white;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-neon:hover {
            background: var(--accent-neon);
            box-shadow: 0 0 30px var(--accent-neon);
        }

        /* ================= REGISTER ================= */
        .register-text {
            margin-top: 25px;
            font-size: 0.9rem;
            color: #94a3b8;
        }

        .register-text a {
            color: var(--accent-neon);
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="grid-bg"></div>

<div class="particles" id="particles"></div>

<div class="container login-container">
    <div class="login-card text-center">

        <!-- 🔥 ICON BUKU (TAMBAHAN TANPA MERUBAH STRUKTUR) -->
        <div class="book-icon">
            <i class="fas fa-book-open"></i>
        </div>

        <h1 class="brand-logo">LIBEFWAY</h1>
        <p class="sub-text">Pintu gerbang menuju galaksi pengetahuan.</p>

        <!-- FORM LOGIN (TETAP ASLI) -->
        <form method="post" action="<?= base_url('index.php/auth/login') ?>">

            <div class="input-group-modern">
                <input type="text" name="username" placeholder="Username" required autofocus>
                <i class="fas fa-user"></i>
            </div>

            <div class="input-group-modern">
                <input type="password" name="password" placeholder="Password" required>
                <i class="fas fa-lock"></i>
            </div>

            <button type="submit" class="btn-neon">
                MASUK <i class="fas fa-arrow-right ms-2"></i>
            </button>
        </form>

        <!-- REGISTER TIDAK DIHAPUS -->
        <div class="register-text">
            Belum punya akun?
            <a href="<?= base_url('index.php/auth/register') ?>">Daftar</a>
        </div>

    </div>
</div>

<script>
/* PARTICLES */
const particles = document.getElementById('particles');

for (let i = 0; i < 30; i++) {
    const span = document.createElement('span');
    span.style.left = Math.random() * 100 + '%';
    span.style.animationDuration = (Math.random()*5+5)+'s';
    span.style.animationDelay = Math.random()*5+'s';
    particles.appendChild(span);
}
</script>

</body>
</html>