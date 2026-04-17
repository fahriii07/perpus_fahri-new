<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>ID Card - <?= $user->nama ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Mengatur ukuran kertas saat print (ukuran kartu ID standar) */
        @page {
            size: auto;
            margin: 0mm;
        }

        body {
            background: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }

        .id-card {
            width: 450px;
            height: 260px;
            background: #1e293b; /* Fallback color */
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border-radius: 12px;
            color: white;
            padding: 25px;
            position: relative;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            overflow: hidden;
            border: 1px solid rgba(255,255,255,0.1);
            /* Memaksa browser mencetak warna latar */
            print-color-adjust: exact;
            -webkit-print-color-adjust: exact;
        }

        /* Hiasan lingkaran futuristik */
        .id-card::after {
            content: "";
            position: absolute;
            top: -20px;
            right: -20px;
            width: 120px;
            height: 120px;
            background: rgba(14, 165, 233, 0.2);
            border-radius: 50%;
            z-index: 1;
        }

        .header {
            display: flex;
            align-items: center;
            border-bottom: 2px solid #0ea5e9;
            padding-bottom: 12px;
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
        }

        .header i {
            font-size: 26px;
            color: #0ea5e9;
            margin-right: 12px;
        }

        .header h3 {
            margin: 0;
            font-size: 18px;
            letter-spacing: 2px;
            font-weight: 800;
        }

        .body-card {
            display: flex;
            gap: 25px;
            position: relative;
            z-index: 2;
        }

        .photo-area {
            width: 110px;
            height: 140px;
            background: #334155;
            border: 3px solid #0ea5e9;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }

        .photo-area img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .info-area {
            flex-grow: 1;
        }

        .info-area h2 {
            margin: 0;
            font-size: 22px;
            color: #0ea5e9;
            font-weight: 700;
            line-height: 1.2;
        }

        .info-area p {
            margin: 4px 0;
            font-size: 13px;
            color: #94a3b8;
        }

        .label {
            font-size: 9px !important;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #64748b !important;
            margin-top: 10px !important;
        }

        .barcode {
            margin-top: 15px;
            background: white;
            padding: 5px;
            border-radius: 4px;
            display: inline-block;
            height: 30px;
            opacity: 0.8;
        }

        .footer-card {
            position: absolute;
            bottom: 20px;
            right: 25px;
            font-size: 10px;
            color: rgba(148, 163, 184, 0.6);
            text-align: right;
            z-index: 2;
        }

        .status-badge {
            display: inline-block;
            background: rgba(34, 197, 94, 0.2);
            color: #22c55e;
            padding: 2px 8px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: bold;
            border: 1px solid #22c55e;
        }

        @media print {
            body { background: white; }
            .id-card {
                box-shadow: none;
                border: none;
                margin: 0;
            }
            /* Tombol atau elemen lain bisa disembunyikan di sini jika ada */
        }
    </style>
</head>
<body onload="setTimeout(function(){ window.print(); }, 500);">

    <div class="id-card">
        <div class="header">
            <i class="fas fa-university"></i>
            <h3>PERPUSTAKAAN DIGITAL</h3>
        </div>
        
        <div class="body-card">
            <div class="photo-area">
                <?php 
                // Pastikan path foto benar. Jika $user->avatar hanya nama file:
                // $foto_path = base_url('uploads/'.$user->avatar);
                // Jika $user->avatar sudah full URL:
                $foto_path = $user->avatar;
                
                if(!empty($user->avatar)): ?>
                    <img src="<?= $foto_path ?>" alt="Foto User">
                <?php else: ?>
                    <img src="https://via.placeholder.com/110x140?text=NO+PHOTO" alt="No Photo">
                <?php endif; ?>
            </div>
            
            <div class="info-area">
                <p class="label">Nama Lengkap</p>
                <h2><?= strtoupper($user->nama) ?></h2>
                
                <p class="label" style="margin-top: 15px !important;">ID Anggota</p>
                <p style="color: white; font-weight: bold; font-size: 16px;">
                    #<?= str_pad($user->id, 5, '0', STR_PAD_LEFT) ?>
                </p>
                
                <div style="margin-top: 10px;">
                    <span class="status-badge">MEMBER AKTIF</span>
                </div>

                <div class="barcode">
                    <img src="https://bwipjs-api.metafloor.com/?bcid=code128&text=<?= $user->id ?>&scale=1&height=10&includetext=false" alt="barcode">
                </div>
            </div>
        </div>

        <div class="footer-card">
            <p style="margin: 0;">Dikeluarkan: <?= date('d M Y') ?></p>
            <p style="margin: 0; color: #0ea5e9;">Verified Digital Member</p>
        </div>
    </div>

</body>
</html>