<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar_user'); ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
:root{
    --bg-body:#f8fafc;
    --card-bg:#ffffff;
    --text-main:#1e293b;
    --text-muted:#64748b;
    --border:#e2e8f0;
    --soft:#f1f5f9;
    --accent:#6366f1;
    --accent-hover:#4f46e5;
    --success:#22c55e;
    --danger:#ef4444;
    --warning:#f59e0b;
}

body.dark-mode{
    --bg-body:#0f172a;
    --card-bg:#1e293b;
    --text-main:#f1f5f9;
    --text-muted:#94a3b8;
    --border:#334155;
    --soft:#172033;
    --accent:#818cf8;
    --accent-hover:#6366f1;
}

.content-wrapper{
    background:var(--bg-body)!important;
    min-height:100vh;
    padding:25px 0;
    transition:.3s ease;
}

/* HEADER */
.section-header{
    margin-bottom:28px;
}

.section-title{
    font-weight:800;
    color:var(--text-main);
    margin-bottom:6px;
    letter-spacing:-.5px;
}

.section-subtitle{
    color:var(--text-muted);
    margin:0;
    font-size:.92rem;
}

/* CARD */
.book-card{
    border:none;
    background:var(--card-bg);
    border-radius:18px;
    overflow:hidden;
    border:1px solid var(--border);
    transition:.25s ease;
    height:100%;
    display:flex;
    flex-direction:column;
}

.book-card:hover{
    transform:translateY(-6px);
    box-shadow:0 18px 35px rgba(0,0,0,.08);
}

/* COVER */
.cover-container{
    position:relative;
    width:100%;
    padding-top:140%;
    overflow:hidden;
    background:var(--soft);
}

.book-cover{
    position:absolute;
    inset:0;
    width:100%;
    height:100%;
    object-fit:cover;
    transition:.4s ease;
}

.book-card:hover .book-cover{
    transform:scale(1.05);
}

.cover-fallback{
    position:absolute;
    inset:0;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:3rem;
    color:#94a3b8;
    background:linear-gradient(135deg,var(--soft),var(--card-bg));
}

.status-badge{
    position:absolute;
    top:12px;
    right:12px;
    z-index:2;
    padding:6px 10px;
    font-size:.72rem;
    font-weight:700;
    border-radius:10px;
    color:#fff;
    backdrop-filter:blur(8px);
}

.badge-available{ background:rgba(34,197,94,.92); }
.badge-empty{ background:rgba(239,68,68,.92); }

/* BODY */
.book-info{
    padding:16px;
    display:flex;
    flex-direction:column;
    flex-grow:1;
}

.book-title{
    color:var(--text-main);
    font-weight:700;
    font-size:1rem;
    line-height:1.4;
    min-height:44px;
    margin-bottom:6px;
    display:-webkit-box;
    -webkit-line-clamp:2;
    -webkit-box-orient:vertical;
    overflow:hidden;
}

.book-author{
    color:var(--text-muted);
    font-size:.86rem;
    margin-bottom:14px;
}

.book-stock{
    font-size:.82rem;
    color:var(--text-muted);
    margin-bottom:14px;
}

/* BUTTON */
.btn-modern{
    border:none;
    border-radius:12px;
    padding:10px 14px;
    font-weight:700;
    font-size:.88rem;
    transition:.2s ease;
}

.btn-pinjam{
    background:var(--accent);
    color:#fff;
}

.btn-pinjam:hover{
    background:var(--accent-hover);
    color:#fff;
    transform:translateY(-2px);
}

.btn-detail{
    background:var(--soft);
    color:var(--text-main);
    margin-top:8px;
}

.btn-detail:hover{
    background:var(--border);
    color:var(--text-main);
}

.btn-disabled{
    background:#cbd5e1!important;
    color:#64748b!important;
    cursor:not-allowed;
}

body.dark-mode .btn-disabled{
    background:#334155!important;
    color:#94a3b8!important;
}

/* STATUS USER */
.status-user{
    margin-top:8px;
    border-radius:10px;
    padding:8px 10px;
    font-size:.78rem;
    font-weight:600;
    text-align:center;
}

.status-pending{
    background:rgba(245,158,11,.12);
    color:var(--warning);
}

.status-dipinjam{
    background:rgba(59,130,246,.12);
    color:#3b82f6;
}

/* EMPTY */
.empty-box{
    background:var(--card-bg);
    border:1px solid var(--border);
    border-radius:18px;
    padding:50px 20px;
    text-align:center;
}

.empty-box i{
    font-size:3rem;
    color:var(--text-muted);
    opacity:.5;
}

.empty-box p{
    margin-top:15px;
    color:var(--text-muted);
}

/* MOBILE */
@media(max-width:576px){
    .book-title{
        font-size:.92rem;
        min-height:40px;
    }

    .book-info{
        padding:14px;
    }
}
</style>

<div class="content-wrapper">
<section class="content">
<div class="container-fluid">

<?php if($this->session->flashdata('success')): ?>
<script>
Swal.fire({
    icon:'success',
    title:'Berhasil',
    text:'<?= $this->session->flashdata('success') ?>',
    confirmButtonColor:'#6366f1'
});
</script>
<?php endif; ?>

<div class="section-header">
    <h2 class="section-title">📚 Koleksi Perpustakaan</h2>
    <p class="section-subtitle">Pilih buku favoritmu dan ajukan peminjaman sekarang.</p>
</div>

<div class="row">

<?php if(!empty($buku)): ?>
<?php foreach($buku as $b): ?>

<?php
$CI =& get_instance();
$CI->db->where('user_id',$this->session->userdata('id'));
$CI->db->where('buku_id',$b->id);
$CI->db->where_in('status',['pending','dipinjam']);
$trx = $CI->db->get('transaksi')->row();
?>

<div class="col-6 col-md-4 col-lg-3 mb-4">
<div class="book-card">

<div class="cover-container">

<?php if(!empty($b->cover) && file_exists('assets/img/cover/'.$b->cover)): ?>
<img src="<?= base_url('assets/img/cover/'.$b->cover) ?>" class="book-cover" alt="<?= $b->judul ?>">
<?php else: ?>
<div class="cover-fallback">
    <i class="fas fa-book-open"></i>
</div>
<?php endif; ?>

<?php if($b->stok > 0): ?>
<span class="status-badge badge-available">TERSEDIA</span>
<?php else: ?>
<span class="status-badge badge-empty">HABIS</span>
<?php endif; ?>

</div>

<div class="book-info">

<h5 class="book-title"><?= $b->judul ?></h5>

<p class="book-author">
<i class="fas fa-user-edit mr-1"></i>
<?= $b->pengarang ?>
</p>

<div class="book-stock">
<i class="fas fa-cubes mr-1"></i>
Stok: <?= $b->stok ?>
</div>

<div class="mt-auto">

<?php if($b->stok <= 0): ?>

<button class="btn btn-modern btn-disabled w-100">
<i class="fas fa-times-circle mr-1"></i> Stok Habis
</button>

<?php elseif($trx): ?>

<?php if($trx->status == 'pending'): ?>

<button class="btn btn-modern btn-warning w-100" disabled>
<i class="fas fa-clock mr-1"></i> Menunggu
</button>

<div class="status-user status-pending">
Menunggu Persetujuan Admin
</div>

<?php else: ?>

<button class="btn btn-modern btn-info w-100" disabled>
<i class="fas fa-book-reader mr-1"></i> Dipinjam
</button>

<div class="status-user status-dipinjam">
Buku Sedang Kamu Pinjam
</div>

<?php endif; ?>

<?php else: ?>

<button
onclick="confirmPinjam('<?= addslashes($b->judul) ?>','<?= base_url('index.php/user/pinjam/'.$b->id) ?>')"
class="btn btn-modern btn-pinjam w-100">
<i class="fas fa-hand-holding-heart mr-1"></i>
Pinjam Buku
</button>

<?php endif; ?>

<a href="<?= base_url('index.php/user/detail/'.$b->id) ?>" class="btn btn-modern btn-detail w-100">
<i class="fas fa-eye mr-1"></i> Detail Buku
</a>

</div>
</div>
</div>
</div>

<?php endforeach; ?>
<?php else: ?>

<div class="col-12">
<div class="empty-box">
    <i class="fas fa-folder-open"></i>
    <p>Belum ada koleksi buku tersedia.</p>
</div>
</div>

<?php endif; ?>

</div>
</div>
</section>
</div>

<div id="loader" style="display:none;position:fixed;inset:0;background:rgba(15,23,42,.75);z-index:9999;justify-content:center;align-items:center;">
    <div class="text-center text-white">
        <div class="spinner-border text-light" style="width:3rem;height:3rem;"></div>
        <p class="mt-3 font-weight-bold">Memproses peminjaman...</p>
    </div>
</div>

<script>
function confirmPinjam(judul,url){
    Swal.fire({
        title:'Pinjam Buku?',
        html:'Apakah kamu ingin meminjam <br><b>'+judul+'</b> ?',
        icon:'question',
        showCancelButton:true,
        confirmButtonText:'Ya, Pinjam',
        cancelButtonText:'Batal',
        confirmButtonColor:'#6366f1',
        cancelButtonColor:'#94a3b8',
        borderRadius:'14px'
    }).then((result)=>{
        if(result.isConfirmed){
            document.getElementById('loader').style.display='flex';
            setTimeout(function(){
                window.location.href=url;
            },600);
        }
    });
}
</script>

<?php $this->load->view('templates/footer'); ?>