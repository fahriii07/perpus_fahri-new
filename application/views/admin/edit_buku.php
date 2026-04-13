<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar_admin'); ?>

<div class="content-wrapper">
<section class="content">
<div class="container-fluid">

    <h3 class="mb-4">✏️ Edit Buku</h3>

    <div class="card shadow">
        <div class="card-body">

            <form method="post" action="<?= base_url('index.php/buku/update') ?>">

                <input type="hidden" name="id" value="<?= $buku->id ?>">

                <div class="form-group">
                    <label>Judul Buku</label>
                    <input type="text" name="judul" value="<?= $buku->judul ?>" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Pengarang</label>
                    <input type="text" name="pengarang" value="<?= $buku->pengarang ?>" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Stok</label>
                    <input type="number" name="stok" value="<?= $buku->stok ?>" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success">
                    Update
                </button>

                <a href="<?= base_url('index.php/buku') ?>" class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>
    </div>

</div>
</section>
</div>

<?php $this->load->view('templates/footer'); ?>