<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar_user'); ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
/* ================= ROOT (FIX LIGHT MODE) ================= */
:root {
    --primary-gradient: linear-gradient(135deg, #8b5cf6 0%, #6366f1 100%);
    --primary-glow: rgba(139, 92, 246, 0.4);

    /* LIGHT MODE */
    --bg-body: #f8fafc;
    --bg-card: #ffffff;
    --text-main: #1e293b;
    --text-muted: #64748b;
    --border-color: #e2e8f0;
    --input-bg: #ffffff;
}

/* DARK MODE */
body.dark-mode {
    --bg-body: #0f172a;
    --bg-card: #1e293b;
    --text-main: #f1f5f9;
    --text-muted: #94a3b8;
    --border-color: #334155;
    --input-bg: #0f172a;
}

/* GLOBAL */
body {
    background: var(--bg-body);
    color: var(--text-main);
    transition: all 0.3s ease;
}

.content-wrapper {
    background: var(--bg-body) !important;
}

/* ================= SEARCH ================= */
.search-container {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    padding: 20px;
    border-radius: 20px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.05);
}

.form-control {
    background-color: var(--input-bg) !important;
    border: 1px solid var(--border-color) !important;
    color: var(--text-main) !important;
    border-radius: 12px !important;
}

.input-group-text {
    background-color: var(--input-bg) !important;
    border: 1px solid var(--border-color) !important;
    color: var(--text-muted);
}

/* ================= BOOK CARD ================= */
.book-card {
    background: var(--bg-card);
    border: 1px solid var(--border-color);
    border-radius: 20px;
    transition: 0.4s;
    height: 100%;
}

.book-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px var(--primary-glow);
    border-color: #8b5cf6;
}

.book-cover-placeholder {
    background: var(--primary-gradient);
    height: 180px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 4rem;
    color: rgba(255,255,255,0.8);
    border-radius: 18px 18px 5px 5px;
    margin: 8px;
}

.book-title {
    color: var(--text-main);
    font-weight: 700;
}

.book-author {
    color: var(--text-muted);
    font-size: 0.85rem;
}

/* ================= BADGE ================= */
.badge-status {
    padding: 6px 12px;
    border-radius: 8px;
    font-weight: 700;
    font-size: 0.75rem;
}

.status-available {
    background: rgba(16,185,129,0.1);
    color: #10b981;
}

.status-empty {
    background: rgba(239,68,68,0.1);
    color: #ef4444;
}

/* ================= BUTTON ================= */
.btn-primary {
    background: var(--primary-gradient) !important;
    border: none !important;
    border-radius: 12px !important;
    font-weight: 700 !important;
    box-shadow: 0 4px 12px var(--primary-glow);
}

.btn-primary:hover {
    transform: scale(1.03);
}

.btn-outline-secondary {
    border: 1px solid var(--border-color) !important;
    color: var(--text-muted) !important;
    border-radius: 12px !important;
}

/* ================= LOADER ================= */
.loading-overlay {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(15,23,42,0.9);
    display: none;
    z-index: 9999;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    color: #8b5cf6;
}

.spinner-border {
    border-right-color: transparent;
    color: #8b5cf6 !important;
}
</style>

<!-- LOADER -->
<div id="loader" class="loading-overlay">
    <div class="spinner-border" style="width:3.5rem;height:3.5rem;"></div>
    <h5 class="mt-4 animate__animated animate__fadeIn animate__infinite">
        MENYIAPKAN BUKU...
    </h5>
</div>

<div class="content-wrapper">
<section class="content pt-4">
<div class="container-fluid">

<div class="d-flex justify-content-between mb-4">
    <h3 style="color:var(--text-main)">📚 Koleksi Perpustakaan</h3>
    <span class="badge p-2" style="background:var(--bg-card);color:var(--text-muted);border:1px solid var(--border-color)">
        <?= count($buku) ?> Buku
    </span>
</div>

<!-- SEARCH -->
<div class="search-container mb-5">
<form method="get">
<div class="row">
<div class="col-md-8">
<div class="input-group">
<span class="input-group-text"><i class="fas fa-search"></i></span>
<input type="text" name="cari" class="form-control" placeholder="Cari buku...">
</div>
</div>
<div class="col-md-2">
<button class="btn btn-primary w-100">CARI</button>
</div>
<div class="col-md-2">
<a href="" class="btn btn-outline-secondary w-100">RESET</a>
</div>
</div>
</form>
</div>

<!-- LIST -->
<div class="row">
<?php foreach($buku as $b){ ?>
<div class="col-md-3 mb-4">
<div class="card book-card">

<div class="book-cover-placeholder">
<i class="fas fa-book"></i>
</div>

<div class="p-3 text-center">

<?php if($b->stok > 0){ ?>
<span class="badge-status status-available">TERSEDIA</span>
<?php } else { ?>
<span class="badge-status status-empty">HABIS</span>
<?php } ?>

<h5 class="book-title"><?= $b->judul ?></h5>
<p class="book-author"><?= $b->pengarang ?></p>

<?php if($b->stok > 0){ ?>
<button onclick="confirmPinjam('<?= $b->judul ?>','<?= base_url('index.php/user/pinjam/'.$b->id) ?>')" 
class="btn btn-primary w-100">Pinjam</button>
<?php } ?>

</div>
</div>
</div>
<?php } ?>
</div>

</div>
</section>
</div>

<script>
function confirmPinjam(judul,url){
Swal.fire({
title:'Pinjam Buku?',
html:'<b>'+judul+'</b>',
icon:'question',
showCancelButton:true,
confirmButtonColor:'#8b5cf6',
cancelButtonColor:'#64748b',
background: document.body.classList.contains('dark-mode') ? '#1e293b' : '#fff',
color: document.body.classList.contains('dark-mode') ? '#fff' : '#000'
}).then((r)=>{
if(r.isConfirmed){
document.getElementById('loader').style.display='flex';
setTimeout(()=>{window.location=url},1000);
}
})
}
</script>

<?php $this->load->view('templates/footer'); ?>