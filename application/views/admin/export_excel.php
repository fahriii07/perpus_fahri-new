<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Transaksi.xls");
?>

<!-- JUDUL -->
<h2 style="text-align:center;">LAPORAN TRANSAKSI PERPUSTAKAAN</h2>
<h4 style="text-align:center;">SEKRETARIAT</h4>

<br>

<!-- PERIODE -->
<p>
    Periode : 
    <?= !empty($tgl_awal) ? date('d-m-Y', strtotime($tgl_awal)) : '-' ?> 
    s/d 
    <?= !empty($tgl_akhir) ? date('d-m-Y', strtotime($tgl_akhir)) : '-' ?>
</p>

<br>

<!-- TABEL -->
<table border="1" cellpadding="5" cellspacing="0" width="100%">
    <tr style="background-color:#d9d9d9; font-weight:bold; text-align:center;">
        <th>No</th>
        <th>Nama</th>
        <th>Buku</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali</th>
        <th>Status</th>
        <th>Denda</th>
    </tr>

    <?php 
    $no = 1;
    $total_denda = 0;
    ?>

    <?php if(!empty($laporan)){ ?>
        <?php foreach($laporan as $l){ 
            $total_denda += $l->denda;
        ?>
        <tr>
            <td align="center"><?= $no++ ?></td>
            <td><?= !empty($l->nama_user) ? $l->nama_user : '-' ?></td>
            <td><?= !empty($l->judul) ? $l->judul : '-' ?></td>

            <td><?= date('d-m-Y', strtotime($l->tanggal_pinjam)) ?></td>

            <td>
                <?= (!empty($l->tanggal_kembali) && $l->tanggal_kembali != '0000-00-00') 
                    ? date('d-m-Y', strtotime($l->tanggal_kembali)) 
                    : '-' ?>
            </td>

            <td align="center">
                <?= ($l->status == 'pinjam') ? 'Dipinjam' : 'Selesai' ?>
            </td>

            <td>
                Rp <?= number_format($l->denda, 0, ',', '.') ?>
            </td>
        </tr>
        <?php } ?>

        <!-- TOTAL -->
        <tr>
            <td colspan="6" align="right"><b>Total Denda</b></td>
            <td><b>Rp <?= number_format($total_denda, 0, ',', '.') ?></b></td>
        </tr>

    <?php } else { ?>
        <tr>
            <td colspan="7" align="center">Data tidak ditemukan</td>
        </tr>
    <?php } ?>
</table>

<br><br>

<!-- TANDA TANGAN -->
<table width="100%">
    <tr>
        <td></td>
        <td width="200" align="center">
            Kampungsengon, <?= date('d-m-Y') ?>
            <br><br><br><br>
            <b>Admin Perpustakaan</b>
        </td>
    </tr>
</table>