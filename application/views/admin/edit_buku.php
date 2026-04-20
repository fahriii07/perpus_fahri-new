<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar_admin'); ?>

<div class="content-wrapper">
<section class="content">
<div class="container-fluid">

    <h3 class="mb-4">✏️ Edit Buku</h3>

    <div class="card shadow">
        <div class="card-body">

            <!-- ERROR ALERT (jika upload gagal / validasi) -->
            <?php if(!empty($error)): ?>
                <div class="alert alert-danger">
                    <?= $error; ?>
                </div>
            <?php endif; ?>

            <form method="post" action="<?= base_url('index.php/buku/update') ?>" enctype="multipart/form-data">

                <input type="hidden" name="id" value="<?= $buku->id ?>">

                <!-- JUDUL -->
                <div class="form-group">
                    <label>Judul Buku</label>
                    <input type="text" name="judul" value="<?= $buku->judul ?>" class="form-control" required>
                </div>

                <!-- PENGARANG -->
                <div class="form-group">
                    <label>Pengarang</label>
                    <input type="text" name="pengarang" value="<?= $buku->pengarang ?>" class="form-control" required>
                </div>

                <!-- STOK -->
                <div class="form-group">
                    <label>Stok</label>
                    <input type="number" name="stok" value="<?= $buku->stok ?>" class="form-control" required>
                </div>

                <!-- COVER LAMA -->
                <div class="form-group">
                    <label>Cover Saat Ini</label><br>

                    <?php if(!empty($buku->cover)): ?>
                        <img src="<?= base_url('assets/img/cover/'.$buku->cover) ?>" 
                             width="120" 
                             class="img-thumbnail mb-2">
                    <?php else: ?>
                        <p class="text-muted">Tidak ada cover</p>
                    <?php endif; ?>
                </div>

                <!-- UPLOAD COVER BARU -->
                <div class="form-group">
                    <label>Ganti Cover (opsional)</label>
                    <input type="file" name="cover" class="form-control">
                    <small class="text-muted">
                        Format: jpg, jpeg, png, webp (Max 2MB)
                    </small>
                </div>

                <!-- BUTTON -->
                <button type="submit" class="btn btn-success">
                    💾 Update
                </button>

                <a href="<?= base_url('index.php/buku') ?>" class="btn btn-secondary">
                    ↩ Kembali
                </a>

            </form>

        </div>
    </div>

</div>
</section>
</div>

<?php $this->load->view('templates/footer'); ?>