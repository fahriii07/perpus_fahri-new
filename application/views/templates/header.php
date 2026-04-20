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
/* ================= GLOBAL ================= */
body{
    transition:.3s ease;
    font-family:Inter,Segoe UI,sans-serif;
}

.main-header{
    border:none!important;
    box-shadow:0 8px 25px rgba(0,0,0,.05);
    backdrop-filter:blur(14px);
    z-index:1040;
}

/* LIGHT MODE */
body:not(.dark-mode) .main-header{
    background:rgba(255,255,255,.92)!important;
}

/* DARK MODE */
body.dark-mode .main-header{
    background:rgba(15,23,42,.92)!important;
}

/* ================= NAV ICON ================= */
.top-btn{
    width:42px;
    height:42px;
    border-radius:14px;
    display:flex!important;
    align-items:center;
    justify-content:center;
    transition:.25s;
    cursor:pointer;
    position:relative;
}

body:not(.dark-mode) .top-btn{
    background:#f8fafc;
    color:#334155!important;
}

body.dark-mode .top-btn{
    background:rgba(255,255,255,.06);
    color:#f8fafc!important;
}

.top-btn:hover{
    transform:translateY(-2px);
}

/* ================= USER ================= */
.user-box{
    display:flex;
    align-items:center;
    gap:10px;
    padding:6px 14px;
    border-radius:16px;
}

body:not(.dark-mode) .user-box{
    background:#f8fafc;
}

body.dark-mode .user-box{
    background:rgba(255,255,255,.05);
}

.avatar-user{
    width:38px;
    height:38px;
    border-radius:12px;
    background:linear-gradient(135deg,#6366f1,#8b5cf6);
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:700;
    overflow:hidden;
}

.user-name{
    font-size:.9rem;
    font-weight:700;
    margin:0;
}

body:not(.dark-mode) .user-name{
    color:#1e293b;
}

body.dark-mode .user-name{
    color:#fff;
}

/* ================= BELL ================= */
.badge-bell{
    position:absolute;
    top:-4px;
    right:-4px;
    min-width:19px;
    height:19px;
    border-radius:30px;
    background:#ef4444;
    color:#fff;
    font-size:.68rem;
    font-weight:700;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:0 4px;
}

.notif-dropdown{
    position:absolute;
    top:55px;
    right:0;
    width:340px;
    max-height:430px;
    overflow-y:auto;
    border-radius:18px;
    display:none;
    box-shadow:0 20px 50px rgba(0,0,0,.15);
    z-index:99999;
}

body:not(.dark-mode) .notif-dropdown{
    background:#fff;
}

body.dark-mode .notif-dropdown{
    background:#1e293b;
}

.notif-head{
    padding:14px 16px;
    font-weight:700;
    border-bottom:1px solid rgba(0,0,0,.05);
    position:sticky;
    top:0;
}

body.dark-mode .notif-head{
    color:#fff;
    border-color:rgba(255,255,255,.05);
}

.notif-item{
    padding:13px 16px;
    border-bottom:1px solid rgba(0,0,0,.05);
}

body.dark-mode .notif-item{
    border-color:rgba(255,255,255,.04);
}

.notif-title{
    font-size:.85rem;
    font-weight:700;
}

.notif-desc{
    font-size:.75rem;
    opacity:.75;
    margin-top:4px;
}

body.dark-mode .notif-title,
body.dark-mode .notif-desc{
    color:#f8fafc;
}

/* ================= MOBILE ================= */
@media(max-width:768px){
    .user-name{
        display:none;
    }

    .notif-dropdown{
        width:300px;
        right:-70px;
    }
}
</style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

<?php
/* ================= NOTIFIKASI ================= */
$this->db->where('status','menunggu');
$total_menunggu = $this->db->count_all_results('transaksi');

$this->db->select('transaksi.*, users.nama as nama_user, buku.judul');
$this->db->from('transaksi');
$this->db->join('users','users.id=transaksi.user_id','left');
$this->db->join('buku','buku.id=transaksi.buku_id','left');
$this->db->order_by('transaksi.id','DESC');
$this->db->limit(8);
$list_notif = $this->db->get()->result();
?>

<nav class="main-header navbar navbar-expand">

<!-- LEFT -->
<ul class="navbar-nav">
<li class="nav-item">
<a class="nav-link top-btn" data-widget="pushmenu" href="#">
<i class="fas fa-bars"></i>
</a>
</li>
</ul>

<!-- RIGHT -->
<ul class="navbar-nav ms-auto align-items-center" style="gap:12px;">

<!-- BELL -->
<li class="nav-item position-relative">

<a class="nav-link top-btn" onclick="toggleNotif()">
<i class="fas fa-bell"></i>

<?php if($total_menunggu > 0){ ?>
<span class="badge-bell"><?= $total_menunggu ?></span>
<?php } ?>
</a>

<div class="notif-dropdown" id="notifBox">
<div class="notif-head">🔔 Notifikasi</div>

<?php if($list_notif){ ?>
<?php foreach($list_notif as $n){ ?>
<div class="notif-item">
<div class="notif-title">
<?= $n->nama_user ?: 'User' ?> - <?= $n->judul ?: '-' ?>
</div>

<div class="notif-desc">
<?php
if($n->status=='menunggu'){
echo '⏳ Menunggu persetujuan';
}elseif($n->status=='dipinjam'){
echo '📚 Sedang dipinjam';
}elseif($n->status=='dikembalikan'){
echo '✅ Sudah dikembalikan';
}elseif($n->status=='ditolak'){
echo '❌ Ditolak';
}
?>
</div>
</div>
<?php } ?>
<?php }else{ ?>
<div class="notif-item text-center">Tidak ada notifikasi</div>
<?php } ?>

</div>
</li>

<!-- THEME -->
<li class="nav-item">
<a class="nav-link top-btn" id="theme-toggle">
<i class="fas fa-moon"></i>
</a>
</li>

<!-- USER -->
<li class="nav-item">
<div class="user-box">

<div class="avatar-user">
<?php if($this->session->userdata('user_avatar')){ ?>
<img src="<?= $this->session->userdata('user_avatar') ?>" style="width:100%;height:100%;object-fit:cover;">
<?php }else{ ?>
<?= strtoupper(substr($this->session->userdata('nama'),0,1)); ?>
<?php } ?>
</div>

<p class="user-name mb-0">
<?= $this->session->userdata('nama'); ?>
</p>

</div>
</li>

</ul>
</nav>

<script>
const body = document.body;
const btnToggle = document.querySelector('#theme-toggle');
const iconToggle = btnToggle.querySelector('i');

/* Load Theme */
if(localStorage.getItem('theme')==='dark'){
    enableDark();
}

btnToggle.addEventListener('click',()=>{
    if(body.classList.contains('dark-mode')){
        disableDark();
    }else{
        enableDark();
    }
});

function enableDark(){
    body.classList.add('dark-mode');
    iconToggle.classList.replace('fa-moon','fa-sun');
    localStorage.setItem('theme','dark');
}

function disableDark(){
    body.classList.remove('dark-mode');
    iconToggle.classList.replace('fa-sun','fa-moon');
    localStorage.setItem('theme','light');
}

/* Notification */
function toggleNotif(){
    let box=document.getElementById('notifBox');
    box.style.display = box.style.display==='block' ? 'none':'block';
}

document.addEventListener('click',function(e){
    if(!e.target.closest('.position-relative')){
        document.getElementById('notifBox').style.display='none';
    }
});
</script>