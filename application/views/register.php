<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register | LIBEFWAY</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;500;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
:root{
    --bg-dark:#05070a;
    --accent-neon:#00f2ff;
    --accent-purple:#7000ff;
    --glass:rgba(15,23,42,.82);
    --glass-border:rgba(255,255,255,.08);
}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    min-height:100vh;
    font-family:'Space Grotesk',sans-serif;
    background:#05070a;
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:40px 15px;
    overflow-x:hidden;
}

/* BACKGROUND */
.bg-wrapper{
    position:fixed;
    inset:0;
    z-index:-2;
    background:
    radial-gradient(circle at 15% 20%, rgba(0,242,255,.15), transparent 30%),
    radial-gradient(circle at 85% 80%, rgba(112,0,255,.18), transparent 35%),
    linear-gradient(135deg,#05070a,#08111f,#05070a);
}

.grid{
    position:fixed;
    inset:0;
    z-index:-1;
    background-image:
    linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px);
    background-size:35px 35px;
    mask-image:linear-gradient(to bottom, transparent, black);
}

/* CARD */
.register-box{
    width:100%;
    max-width:760px;
}

.card-register{
    background:var(--glass);
    border:1px solid var(--glass-border);
    backdrop-filter:blur(24px);
    -webkit-backdrop-filter:blur(24px);
    border-radius:28px;
    padding:38px;
    box-shadow:0 25px 80px rgba(0,0,0,.45);
}

.brand{
    text-align:center;
    margin-bottom:28px;
}

.brand-icon{
    width:74px;
    height:74px;
    margin:auto;
    border-radius:22px;
    display:flex;
    align-items:center;
    justify-content:center;
    background:linear-gradient(135deg,var(--accent-neon),var(--accent-purple));
    color:#fff;
    font-size:30px;
    box-shadow:0 0 30px rgba(0,242,255,.35);
    margin-bottom:16px;
}

.brand h1{
    font-size:2rem;
    font-weight:700;
    margin-bottom:6px;
    background:linear-gradient(to right,#fff,var(--accent-neon));
    -webkit-background-clip:text;
    -webkit-text-fill-color:transparent;
}

.brand p{
    color:#94a3b8;
    font-size:.92rem;
}

.section-title{
    font-size:.76rem;
    text-transform:uppercase;
    letter-spacing:2px;
    color:var(--accent-neon);
    margin:28px 0 14px;
    font-weight:700;
}

/* INPUT */
.input-wrap{
    position:relative;
    margin-bottom:16px;
}

.input-wrap i.left{
    position:absolute;
    left:16px;
    top:15px;
    color:#64748b;
}

.input-wrap input,
.input-wrap textarea{
    width:100%;
    border:none;
    outline:none;
    border-radius:14px;
    padding:13px 15px 13px 44px;
    background:rgba(255,255,255,.04);
    border:1px solid rgba(255,255,255,.08);
    color:#fff;
    transition:.25s;
}

.input-wrap textarea{
    resize:none;
    min-height:90px;
}

.input-wrap input:focus,
.input-wrap textarea:focus{
    border-color:var(--accent-neon);
    box-shadow:0 0 0 4px rgba(0,242,255,.08);
}

.toggle-pass{
    position:absolute;
    right:14px;
    top:14px;
    color:#94a3b8;
    cursor:pointer;
}

/* BUTTON */
.btn-submit{
    width:100%;
    border:none;
    border-radius:14px;
    padding:14px;
    font-weight:700;
    letter-spacing:.5px;
    color:#000;
    background:#fff;
    transition:.25s;
    margin-top:12px;
}

.btn-submit:hover{
    transform:translateY(-2px);
    background:var(--accent-neon);
    box-shadow:0 0 25px rgba(0,242,255,.35);
}

.bottom-text{
    text-align:center;
    margin-top:18px;
    color:#94a3b8;
    font-size:.92rem;
}

.bottom-text a{
    color:var(--accent-neon);
    text-decoration:none;
    font-weight:700;
}

.small-error{
    font-size:.82rem;
    color:#ff6b6b;
    display:none;
    margin-top:-8px;
    margin-bottom:10px;
}

@media(max-width:768px){
    .card-register{
        padding:24px;
    }
}
</style>
</head>
<body>

<div class="bg-wrapper"></div>
<div class="grid"></div>

<div class="register-box">
<div class="card-register">

<div class="brand">
    <div class="brand-icon">
        <i class="fas fa-book-open"></i>
    </div>
    <h1>LIBEFWAY</h1>
    <p>Buat akun dan mulai perjalanan literasimu.</p>
</div>

<?php if($this->session->flashdata('error')): ?>
<script>
Swal.fire({
    icon:'error',
    title:'Gagal',
    text:'<?= $this->session->flashdata('error'); ?>',
    background:'#0f172a',
    color:'#fff',
    confirmButtonColor:'#00f2ff'
});
</script>
<?php endif; ?>

<form method="post" action="<?= base_url('index.php/auth/proses_register'); ?>" onsubmit="return validasiRegister()">

<div class="section-title">Data Akun</div>

<div class="input-wrap">
    <input type="text" name="nama" placeholder="Nama Lengkap" required>
    <i class="fas fa-id-card left"></i>
</div>

<div class="input-wrap">
    <input type="text" name="username" placeholder="Username" required>
    <i class="fas fa-user left"></i>
</div>

<div class="row">
<div class="col-md-6">
    <div class="input-wrap">
        <input type="password" id="password" name="password" placeholder="Password" required minlength="6">
        <i class="fas fa-lock left"></i>
        <span class="toggle-pass" onclick="togglePass('password','eye1')">
            <i class="fas fa-eye" id="eye1"></i>
        </span>
    </div>
</div>

<div class="col-md-6">
    <div class="input-wrap">
        <input type="password" id="konfirmasi" placeholder="Ulangi Password" required minlength="6">
        <i class="fas fa-shield-alt left"></i>
    </div>
</div>
</div>

<div class="small-error" id="passError">
Password tidak cocok.
</div>

<div class="section-title">Informasi Tambahan</div>

<div class="row">
<div class="col-md-6">
    <div class="input-wrap">
        <input type="text" name="kelas" placeholder="Kelas">
        <i class="fas fa-school left"></i>
    </div>
</div>

<div class="col-md-6">
    <div class="input-wrap">
        <input type="text" name="jurusan" placeholder="Jurusan">
        <i class="fas fa-graduation-cap left"></i>
    </div>
</div>
</div>

<div class="input-wrap">
    <input type="text" name="kontak" placeholder="Nomor WhatsApp">
    <i class="fab fa-whatsapp left"></i>
</div>

<div class="input-wrap">
    <textarea name="alamat" placeholder="Alamat Lengkap"></textarea>
    <i class="fas fa-map-marker-alt left"></i>
</div>

<button type="submit" class="btn-submit">
    DAFTAR SEKARANG <i class="fas fa-arrow-right ms-2"></i>
</button>

</form>

<div class="bottom-text">
    Sudah punya akun?
    <a href="<?= base_url('index.php/auth'); ?>">Masuk</a>
</div>

</div>
</div>

<script>
function togglePass(id,iconId){
    let input = document.getElementById(id);
    let icon  = document.getElementById(iconId);

    if(input.type === 'password'){
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    }else{
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

function validasiRegister(){

    let pass  = document.getElementById('password').value;
    let konf  = document.getElementById('konfirmasi').value;
    let error = document.getElementById('passError');

    if(pass.length < 6){
        Swal.fire({
            icon:'warning',
            title:'Password Lemah',
            text:'Password minimal 6 karakter.',
            confirmButtonColor:'#00f2ff'
        });
        return false;
    }

    if(pass !== konf){
        error.style.display='block';

        Swal.fire({
            icon:'error',
            title:'Gagal',
            text:'Konfirmasi password tidak sesuai.',
            confirmButtonColor:'#00f2ff'
        });

        return false;
    }

    return true;
}
</script>

</body>
</html>