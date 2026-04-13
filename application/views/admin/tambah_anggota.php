<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar_admin'); ?>

<div class="content-wrapper">
<section class="content">
<div class="container-fluid">

    <h3 class="mb-4">➕ Tambah Anggota</h3>

    <div class="card shadow">
        <div class="card-body">

            <form method="post" action="<?= base_url('index.php/anggota/simpan') ?>">

                <!-- NAMA -->
                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>

                <!-- USERNAME -->
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>

                <!-- PASSWORD -->
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <hr>

                <!-- 🔥 TAMBAHAN DATA -->
                <div class="form-group">
                    <label>Kelas</label>
                    <input type="text" name="kelas" class="form-control" placeholder="Contoh: XII RPL 1">
                </div>

                <div class="form-group">
                    <label>Jurusan</label>
                    <input type="text" name="jurusan" class="form-control">
                </div>

                <div class="form-group">
                    <label>No Kontak</label>
                    <input type="text" name="kontak" class="form-control">
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat" class="form-control"></textarea>
                </div>

                <!-- BUTTON -->
                <button type="submit" class="btn btn-success mt-2">
                    Simpan
                </button>

                <a href="<?= base_url('index.php/anggota') ?>" class="btn btn-secondary mt-2">
                    Kembali
                </a>

            </form>

        </div>
    </div>

</div>
</section>
</div>

<?php $this->load->view('templates/footer'); ?>