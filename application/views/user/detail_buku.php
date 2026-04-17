<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar_user'); ?>

<style>
.detail-card {
    background: var(--bg-card);
    border-radius: 20px;
    border: 1px solid var(--border-color);
    padding: 30px;
}

.book-icon {
    font-size: 80px;
    color: var(--accent-neon);
}

.label {
    font-size: 0.75rem;
    color: var(--text-muted);
    text-transform: uppercase;
}

.value {
    font-weight: 600;
    color: var(--text-main);
}
</style>

<div class="content-wrapper">
<section class="content pt-4">
<div class="container-fluid">

<a href="<?= base_url('index.php/user/buku') ?>" class="btn btn-light mb-3">
    ← Kembali
</a>

<div class="detail-card shadow-sm">

<div class="row align-items-center">

<div class="col-md-4 text-center">
    <i class="fas fa-book book-icon"></i>
</div>

<div class="col-md-8">

<h3 class="mb-3"><?= $buku->judul ?></h3>

<div class="row">

<div class="col-md-6 mb-3">
    <div class="label">Pengarang</div>
    <div class="value"><?= $buku->pengarang ?></div>
</div>

<div class="col-md-6 mb-3">
    <div class="label">Penerbit</div>
    <div class="value"><?= $buku->penerbit ?? '-' ?></div>
</div>

<div class="col-md-6 mb-3">
    <div class="label">Tahun</div>
    <div class="value"><?= $buku->tahun ?? '-' ?></div>
</div>

<div class="col-md-6 mb-3">
    <div class="label">Stok</div>
    <div class="value">
        <?= $buku->stok > 0 ? $buku->stok.' tersedia' : 'Habis' ?>
    </div>
</div>

</div>

<hr>

<div class="mb-3">
    <div class="label">Deskripsi</div>
    <div class="value">
        <?= $buku->deskripsi ?? 'Tidak ada deskripsi.' ?>
    </div>
</div>

<!-- ACTION -->
<?php if($buku->stok > 0){ ?>
<a href="<?= base_url('index.php/user/pinjam/'.$buku->id) ?>" 
   class="btn btn-primary">
   📚 Pinjam Buku
</a>
<?php } else { ?>
<button class="btn btn-secondary">Stok Habis</button>
<?php } ?>

</div>

</div>

</div>

</div>
</section>
</div>

<?php $this->load->view('templates/footer'); ?>