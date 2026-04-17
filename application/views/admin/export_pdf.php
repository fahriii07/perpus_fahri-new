<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi Perpustakaan</title>

    <style>
        body {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #444;
            padding-bottom: 10px;
        }

        .header h3 {
            margin: 0;
            font-size: 18px;
            text-transform: uppercase;
        }

        .sub-title {
            font-size: 13px;
            margin-top: 5px;
        }

        .info-periode {
            margin: 15px 0;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f2f2f2;
            font-size: 11px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 6px;
            word-wrap: break-word;
        }

        .text-center {
            text-align: center;
        }

        .status {
            font-weight: bold;
            font-size: 11px;
        }

        .pinjam {
            color: #b45309;
        }

        .kembali {
            color: #15803d;
        }

        .footer {
            margin-top: 20px;
            text-align: right;
            font-size: 10px;
            font-style: italic;
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <div class="header">
        <h3>Laporan Transaksi Perpustakaan</h3>
        <div class="sub-title">Sistem Informasi Perpustakaan</div>
    </div>

    <!-- PERIODE -->
    <p class="info-periode">
        Periode:
        <?php
            $tgl_awal = isset($tgl_awal) ? $tgl_awal : null;
            $tgl_akhir = isset($tgl_akhir) ? $tgl_akhir : null;
            $jenis = isset($jenis) ? $jenis : null;

            if(!empty($tgl_awal) && !empty($tgl_akhir)){
                echo date('d M Y', strtotime($tgl_awal)) . " s/d " . date('d M Y', strtotime($tgl_akhir));
            } elseif(!empty($jenis)) {
                echo strtoupper($jenis);
            } else {
                echo "SEMUA DATA";
            }
        ?>
    </p>

    <!-- TABLE -->
    <table>
        <thead>
            <tr>
                <th width="30">No</th>
                <th>Nama User</th>
                <th>Judul Buku</th>
                <th width="100">Tgl Pinjam</th>
                <th width="100">Tgl Kembali</th>
                <th width="80">Status</th>
            </tr>
        </thead>

        <tbody>

        <?php if(!empty($laporan) && is_array($laporan)): ?>
            <?php $no = 1; foreach($laporan as $l): ?>

                <tr>
                    <td class="text-center"><?= $no++ ?></td>

                    <td>
                        <?= !empty($l->nama_user) ? htmlspecialchars($l->nama_user) : '-' ?>
                    </td>

                    <td>
                        <?= !empty($l->judul) ? htmlspecialchars($l->judul) : '-' ?>
                    </td>

                    <td class="text-center">
                        <?= !empty($l->tanggal_pinjam) ? date('d/m/Y', strtotime($l->tanggal_pinjam)) : '-' ?>
                    </td>

                    <td class="text-center">
                        <?php if(!empty($l->tanggal_kembali) && $l->tanggal_kembali != '0000-00-00'): ?>
                            <?= date('d/m/Y', strtotime($l->tanggal_kembali)) ?>
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>

                    <td class="text-center">
                        <?php if($l->status == 'pinjam'): ?>
                            <span class="status pinjam">PINJAM</span>
                        <?php else: ?>
                            <span class="status kembali">KEMBALI</span>
                        <?php endif; ?>
                    </td>
                </tr>

            <?php endforeach; ?>

        <?php else: ?>

            <tr>
                <td colspan="6" class="text-center">
                    Tidak ada data transaksi ditemukan
                </td>
            </tr>

        <?php endif; ?>

        </tbody>
    </table>

    <!-- FOOTER -->
    <div class="footer">
        Dicetak otomatis pada: <?= date('d/m/Y H:i') ?>
    </div>

</body>
</html>