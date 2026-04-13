<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join | EFWAY Library Community</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;500;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-dark: #05070a;
            --accent-neon: #00f2ff;
            --accent-purple: #7000ff;
            --glass: rgba(15, 23, 42, 0.8);
        }

        body, html {
            min-height: 100%;
            margin: 0;
            font-family: 'Space Grotesk', sans-serif;
            background-color: var(--bg-dark);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 50px 0;
        }

        /* Ambient Background */
        .bg-wrapper {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: radial-gradient(circle at 90% 10%, rgba(112, 0, 255, 0.2) 0%, transparent 40%),
                        radial-gradient(circle at 10% 90%, rgba(0, 242, 255, 0.15) 0%, transparent 40%);
            z-index: -1;
        }

        .register-box {
            width: 100%;
            max-width: 600px;
            padding: 20px;
        }

        .login-card {
            background: var(--glass);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 40px;
            padding: 40px;
            box-shadow: 0 40px 100px rgba(0, 0, 0, 0.6);
            position: relative;
        }

        .brand-logo {
            font-size: 2rem;
            font-weight: 700;
            background: linear-gradient(to right, #fff, var(--accent-neon));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -1px;
        }

        .section-divider {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: var(--accent-neon);
            margin: 30px 0 20px;
            display: flex;
            align-items: center;
            font-weight: 700;
        }

        .section-divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: linear-gradient(to right, rgba(0, 242, 255, 0.3), transparent);
            margin-left: 15px;
        }

        /* Modern Inputs */
        .input-group-modern {
            margin-bottom: 18px;
            position: relative;
        }

        .input-group-modern input, 
        .input-group-modern textarea {
            width: 100%;
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            padding: 12px 15px 12px 45px;
            color: #fff;
            transition: 0.4s;
            font-size: 0.95rem;
        }

        .input-group-modern input:focus,
        .input-group-modern textarea:focus {
            outline: none;
            border-color: var(--accent-neon);
            background: rgba(255, 255, 255, 0.07);
            box-shadow: 0 0 15px rgba(0, 242, 255, 0.1);
        }

        .input-group-modern i {
            position: absolute;
            left: 18px;
            top: 16px;
            color: #64748b;
            transition: 0.3s;
        }

        .input-group-modern input:focus + i {
            color: var(--accent-neon);
        }

        /* Password Toggle Adjust */
        .pass-toggle {
            position: absolute;
            right: 15px;
            top: 13px;
            cursor: pointer;
            color: #64748b;
            z-index: 10;
        }

        /* Button Neon */
        .btn-neon {
            background: #fff;
            color: #000;
            border: none;
            padding: 15px;
            border-radius: 15px;
            font-weight: 700;
            width: 100%;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: 0.3s;
            margin-top: 20px;
        }

        .btn-neon:hover {
            background: var(--accent-neon);
            box-shadow: 0 0 30px rgba(0, 242, 255, 0.4);
            transform: translateY(-2px);
        }

        .login-text {
            margin-top: 25px;
            color: #94a3b8;
            font-size: 0.9rem;
        }

        .login-text a {
            color: var(--accent-neon);
            text-decoration: none;
            font-weight: 600;
        }

        /* Animation for error */
        #msg {
            font-size: 0.8rem;
            color: #ff4d4d;
            margin-top: -10px;
            margin-bottom: 15px;
            display: block;
        }
    </style>
</head>

<body>

<div class="bg-wrapper"></div>

<div class="register-box">
    <div class="login-card">
        <div class="text-center mb-4">
            <h1 class="brand-logo">LIBEFWAY</h1>
            <p class="text-muted small">Mulai petualangan literasimu di sini.</p>
        </div>

        <form method="post" action="<?= base_url('index.php/auth/proses_register') ?>">
            
            <div class="section-divider">Data Akun</div>

            <div class="input-group-modern">
                <input type="text" name="nama" placeholder="Nama Lengkap" required>
                <i class="fas fa-id-card"></i>
            </div>

            <div class="input-group-modern">
                <input type="text" name="username" placeholder="Username Unik" required>
                <i class="fas fa-at"></i>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="input-group-modern">
                        <input type="password" id="password" name="password" placeholder="Password" required>
                        <i class="fas fa-lock"></i>
                        <span class="pass-toggle" onclick="togglePassword('password', 'eye-1')">
                            <i class="fas fa-eye" id="eye-1"></i>
                        </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group-modern">
                        <input type="password" id="confirm_password" placeholder="Ulangi Password" required>
                        <i class="fas fa-shield-check"></i>
                    </div>
                </div>
            </div>
            <small id="msg" class="d-none"><i class="fas fa-exclamation-circle"></i> Password tidak cocok!</small>

            <div class="section-divider">Informasi Studi</div>

            <div class="row">
                <div class="col-6">
                    <div class="input-group-modern">
                        <input type="text" name="kelas" placeholder="Kelas">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-group-modern">
                        <input type="text" name="jurusan" placeholder="Jurusan">
                        <i class="fas fa-microchip"></i>
                    </div>
                </div>
            </div>

            <div class="input-group-modern">
                <input type="text" name="kontak" placeholder="Nomor WhatsApp (Aktif)">
                <i class="fab fa-whatsapp"></i>
            </div>

            <div class="input-group-modern">
                <textarea name="alamat" placeholder="Alamat Lengkap" rows="2" style="padding-top: 12px;"></textarea>
                <i class="fas fa-map-marker-alt"></i>
            </div>

            <button type="submit" class="btn-neon" onclick="return validateForm()">
                Buat Akun Sekarang <i class="fas fa-rocket ms-2"></i>
            </button>
        </form>

        <div class="text-center login-text">
            Sudah punya akun? <a href="<?= base_url('index.php/auth') ?>">Masuk Kembali</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function togglePassword(id, eyeId){
    var pass = document.getElementById(id);
    var icon = document.getElementById(eyeId);
    if(pass.type === "password"){
        pass.type = "text";
        icon.classList.replace("fa-eye","fa-eye-slash");
    } else {
        pass.type = "password";
        icon.classList.replace("fa-eye-slash","fa-eye");
    }
}

function validateForm(){
    var pass = document.getElementById("password").value;
    var confirm = document.getElementById("confirm_password").value;
    var msg = document.getElementById("msg");

    if(pass !== confirm){
        msg.classList.remove("d-none");
        Swal.fire({ 
            icon: 'error', 
            title: 'Gagal', 
            text: 'Konfirmasi password tidak sesuai.',
            background: '#0f172a',
            color: '#fff',
            confirmButtonColor: '#00f2ff' 
        });
        return false;
    }
    return true;
}
</script>

</body>
</html>