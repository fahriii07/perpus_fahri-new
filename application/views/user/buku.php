<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar_user'); ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
.btn-disabled {
    background: #cbd5f5 !important;
    cursor: not-allowed;
}

.status-user {
    font-size: 0.75rem;
    margin-top: 5px;
    font-weight: 600;
}

.status-pending { color: #f59e0b; }
.status-dipinjam { color: #3b82f6; }
</style>

<div class="content-wrapper">
<section class="content pt-4">
<div class="container-fluid">

<!-- 🔥 NOTIFIKASI -->
<?php if($this->session->flashdata('success')){ ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Berhasil',
    text: '<?= $this->session->flashdata('success') ?>',
    confirmButtonColor: '#8b5cf6'
});
</script>
<?php } ?>

<?php if($this->session->flashdata('error')){ ?>
<script>
Swal.fire({
    icon: 'error',
    title: 'Gagal',
    text: '<?= $this->session->flashdata('error') ?>',
    confirmButtonColor: '#ef4444'
});
</script>
<?php } ?>

<h3>📚 Koleksi Buku</h3>

<div class="row">
<?php foreach($buku as $b){ ?>

<?php
// 🔥 CEK STATUS USER
$CI =& get_instance();
$CI->db->where('user_id', $this->session->userdata('id'));
$CI->db->where('buku_id', $b->id);
$CI->db->where_in('status', ['pending','dipinjam']);
$trx = $CI->db->get('transaksi')->row();
?>

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

<!-- 🔥 LOGIKA BUTTON -->
<?php if($b->stok <= 0){ ?>

<button class="btn btn-secondary w-100 btn-disabled">Stok Habis</button>

<?php } elseif($trx){ ?>

    <?php if($trx->status == 'pending'){ ?>
        <button class="btn btn-warning w-100 btn-disabled">Menunggu</button>
        <div class="status-user status-pending">
            ⏳ Menunggu konfirmasi admin
        </div>

    <?php } elseif($trx->status == 'dipinjam'){ ?>
        <button class="btn btn-info w-100 btn-disabled">Sedang Dipinjam</button>
        <div class="status-user status-dipinjam">
            📖 Kamu sedang meminjam buku ini
        </div>
    <?php } ?>

<?php } else { ?>

<button onclick="confirmPinjam('<?= $b->judul ?>','<?= base_url('index.php/user/pinjam/'.$b->id) ?>')" 
class="btn btn-primary w-100">Pinjam</button>

<?php } ?>

<!-- 🔥 DETAIL -->
<a href="<?= base_url('index.php/user/detail/'.$b->id) ?>" 
   class="btn btn-outline-secondary w-100 mt-2">
   Detail
</a>

</div>
</div>
</div>
<?php } ?>
</div>

</div>
</section>
</div>

<!-- LOADER -->
<div id="loader" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:#000000cc;z-index:9999;justify-content:center;align-items:center;">
    <div style="color:white;text-align:center">
        <div class="spinner-border"></div>
        <p>Memproses...</p>
    </div>
</div>

<script>
function confirmPinjam(judul,url){
Swal.fire({
title:'Pinjam Buku?',
html:'<b>'+judul+'</b>',
icon:'question',
showCancelButton:true,
confirmButtonColor:'#8b5cf6',
cancelButtonColor:'#64748b'
}).then((r)=>{
if(r.isConfirmed){
document.getElementById('loader').style.display='flex';
setTimeout(()=>{
    window.location.href = url; // 🔥 redirect aman
},800);
}
})
}
</script>

<?php $this->load->view('templates/footer'); ?>