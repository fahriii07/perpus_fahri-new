<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar_admin'); ?>

<style>
/* ==================================================
   THEME VARIABLES
================================================== */
:root{
    --bg-body:#f8fafc;
    --bg-card:#ffffff;
    --text-main:#0f172a;
    --text-muted:#64748b;
    --table-header:#f1f5f9;
    --border-color:#e2e8f0;
    --hover-row:#f8fafc;
    --input-bg:#ffffff;
    --accent:#6366f1;
    --accent2:#8b5cf6;
    --danger:#ef4444;
    --success:#22c55e;
    --warning:#f59e0b;
    --info:#3b82f6;
    --shadow:0 10px 30px rgba(15,23,42,.06);
}

body.dark-mode{
    --bg-body:#0f172a;
    --bg-card:#1e293b;
    --text-main:#f1f5f9;
    --text-muted:#94a3b8;
    --table-header:#334155;
    --border-color:#334155;
    --hover-row:#243244;
    --input-bg:#1e293b;
    --shadow:0 15px 35px rgba(0,0,0,.35);
}

/* ==================================================
   BASE LAYOUT
================================================== */
.content-wrapper{
    background:var(--bg-body)!important;
    background-image:
        radial-gradient(circle at top right, rgba(99,102,241,.08), transparent 30%),
        radial-gradient(circle at bottom left, rgba(139,92,246,.08), transparent 25%);
    padding:25px;
    transition:.3s ease;
}

.page-title{
    font-weight:800;
    color:var(--text-main);
    letter-spacing:-.4px;
}

.text-muted{
    color:var(--text-muted)!important;
}

/* ==================================================
   CARD
================================================== */
.filter-card,
.card-table-container{
    border:1px solid var(--border-color);
    border-radius:20px;
    background:var(--bg-card);
    box-shadow:var(--shadow);
    overflow:hidden;
    transition:.3s ease;
}

.filter-card .card-body{
    padding:22px;
}

/* ==================================================
   FORM
================================================== */
label{
    font-size:.82rem;
    font-weight:700;
    color:var(--text-muted);
    margin-bottom:8px;
}

.form-control-custom{
    height:46px;
    background:var(--table-header);
    border:1px solid var(--border-color);
    color:var(--text-main);
    border-radius:12px;
    padding:10px 14px;
    transition:.2s ease;
}

.form-control-custom:focus{
    background:var(--bg-card);
    color:var(--text-main);
    border-color:var(--accent);
    box-shadow:0 0 0 .18rem rgba(99,102,241,.15);
}

body.dark-mode input[type="date"]::-webkit-calendar-picker-indicator{
    filter:invert(1);
}

/* ==================================================
   BUTTONS
================================================== */
.btn-primary-modern,
.btn-reset-modern,
.btn-export-pdf{
    border:none;
    border-radius:12px;
    padding:10px 18px;
    font-weight:700;
    font-size:.88rem;
    text-decoration:none!important;
    display:inline-flex;
    align-items:center;
    gap:8px;
    transition:.25s ease;
}

.btn-primary-modern{
    background:linear-gradient(135deg,var(--accent),var(--accent2));
    color:#fff;
}

.btn-primary-modern:hover{
    transform:translateY(-2px);
    box-shadow:0 10px 20px rgba(99,102,241,.28);
    color:#fff;
}

.btn-reset-modern{
    background:transparent;
    border:1px solid var(--border-color);
    color:var(--text-muted);
}

.btn-reset-modern:hover{
    background:var(--table-header);
    color:var(--text-main);
}

.btn-export-pdf{
    background:linear-gradient(135deg,#ef4444,#dc2626);
    color:#fff;
}

.btn-export-pdf:hover{
    transform:translateY(-2px);
    box-shadow:0 10px 20px rgba(239,68,68,.25);
    color:#fff;
}

/* ==================================================
   TABLE
================================================== */
.table{
    margin:0;
}

.table thead th{
    background:var(--table-header);
    border:none;
    color:var(--text-muted);
    font-size:.74rem;
    font-weight:800;
    text-transform:uppercase;
    letter-spacing:1px;
    padding:18px 20px;
    white-space:nowrap;
}

.table td{
    border-bottom:1px solid var(--border-color);
    padding:18px 20px;
    vertical-align:middle;
    color:var(--text-main);
    background:transparent;
}

.table tbody tr{
    transition:.2s ease;
}

.table tbody tr:hover{
    background:var(--hover-row)!important;
}

.table tbody tr:last-child td{
    border-bottom:none;
}

/* ==================================================
   STATUS BADGE
================================================== */
.badge-status{
    padding:7px 14px;
    border-radius:30px;
    font-size:.74rem;
    font-weight:800;
    display:inline-block;
    letter-spacing:.3px;
}

.status-pinjam{
    background:rgba(245,158,11,.14);
    color:var(--warning);
}

.status-selesai{
    background:rgba(34,197,94,.14);
    color:var(--success);
}

.status-tolak{
    background:rgba(239,68,68,.14);
    color:var(--danger);
}

.status-menunggu{
    background:rgba(59,130,246,.14);
    color:var(--info);
}

/* ==================================================
   DENDA
================================================== */
.denda-amount{
    font-family:Consolas,monospace;
    padding:6px 11px;
    border-radius:10px;
    font-weight:800;
    font-size:.82rem;
    display:inline-block;
}

.has-denda{
    background:rgba(239,68,68,.12);
    color:var(--danger);
}

.no-denda{
    background:var(--table-header);
    color:var(--text-muted);
}

/* ==================================================
   UTILITIES
================================================== */
.font-weight-bold{
    font-weight:700!important;
}

.text-truncate{
    max-width:220px;
}

.small i{
    width:16px;
}

/* ==================================================
   EMPTY STATE
================================================== */
.empty-box{
    padding:50px 20px;
    text-align:center;
}

.empty-box i{
    opacity:.25;
}

/* ==================================================
   MOBILE
================================================== */
@media(max-width:768px){

    .content-wrapper{
        padding:15px;
    }

    .filter-card .card-body{
        padding:16px;
    }

    .table thead th,
    .table td{
        padding:14px;
    }

    .btn-primary-modern,
    .btn-reset-modern,
    .btn-export-pdf{
        width:100%;
        justify-content:center;
    }
}
</style>

<div class="content-wrapper">
<section class="content">
<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="page-title mb-1">📊 Laporan Transaksi</h3>
    </div>
</div>

<div class="card filter-card mb-4">
<div class="card-body">

<form method="get" action="<?= base_url('index.php/laporan') ?>">
<div class="row align-items-end">

<div class="col-md-3 mb-3 mb-md-0">
    <label>Tanggal Awal</label>
    <input type="date" name="tgl_awal"
           value="<?= $tgl_awal ?>"
           class="form-control form-control-custom shadow-none">
</div>

<div class="col-md-3 mb-3 mb-md-0">
    <label>Tanggal Akhir</label>
    <input type="date" name="tgl_akhir"
           value="<?= $tgl_akhir ?>"
           class="form-control form-control-custom shadow-none">
</div>

<div class="col-md-6 d-flex flex-wrap justify-content-md-end mt-3 mt-md-0" style="gap:10px;">

    <button type="submit" class="btn btn-primary-modern">
        <i class="fas fa-filter"></i> Filter
    </button>

    <a href="<?= base_url('index.php/laporan') ?>" class="btn btn-reset-modern">
        <i class="fas fa-undo"></i> Reset
    </a>

    <a href="<?= base_url('index.php/laporan/export_pdf?jenis=harian') ?>" target="_blank" class="btn btn-export-pdf">
        <i class="fas fa-file-pdf"></i> Harian
    </a>

    <a href="<?= base_url('index.php/laporan/export_pdf?jenis=bulanan') ?>" target="_blank" class="btn btn-export-pdf">
        <i class="fas fa-file-pdf"></i> Bulanan
    </a>

    <a href="<?= base_url('index.php/laporan/export_pdf?jenis=tahunan') ?>" target="_blank" class="btn btn-export-pdf">
        <i class="fas fa-file-pdf"></i> Tahunan
    </a>

</div>

</div>
</form>

</div>
</div>

<div class="card card-table-container">
<div class="card-body p-0">
<div class="table-responsive">

<table class="table mb-0">
<thead>
<tr>
    <th>Peminjam</th>
    <th>Informasi Buku</th>
    <th>Periode Pinjam</th>
    <th>Status</th>
    <th class="text-right">Denda</th>
</tr>
</thead>

<tbody>

<?php if(!empty($laporan)){ ?>
<?php foreach($laporan as $l){ ?>
<tr>

<td>
    <div class="font-weight-bold"><?= $l->nama_user ?: '-' ?></div>
    <small class="text-muted">Member Perpustakaan</small>
</td>

<td style="max-width:220px;">
    <div class="font-weight-bold text-truncate">
        <?= $l->judul ?: '-' ?>
    </div>
    <small class="text-muted">Buku Perpustakaan</small>
</td>

<td>
<div class="small">

<span class="text-success">
<i class="fas fa-calendar-plus mr-1"></i>
<?= date('d M Y', strtotime($l->tanggal_pinjam)) ?>
</span>

<br>

<?php if($l->status == 'dipinjam'){ ?>

<span class="text-warning">
<i class="fas fa-book mr-1"></i>
<i>Sedang Dipinjam</i>
</span>

<?php } elseif($l->status == 'dikembalikan'){ ?>

<span class="text-primary">
<i class="fas fa-calendar-check mr-1"></i>
<?= ($l->tanggal_kembali && $l->tanggal_kembali != '0000-00-00')
? date('d M Y', strtotime($l->tanggal_kembali))
: '-' ?>
</span>

<?php } elseif($l->status == 'ditolak'){ ?>

<span class="text-danger">
<i class="fas fa-times-circle mr-1"></i>
Ditolak Admin
</span>

<?php } else { ?>

<span class="text-info">
<i class="fas fa-clock mr-1"></i>
Menunggu Persetujuan
</span>

<?php } ?>

</div>
</td>

<td>
<?php if($l->status == 'dipinjam'){ ?>
<span class="badge-status status-pinjam">Dipinjam</span>

<?php } elseif($l->status == 'dikembalikan'){ ?>
<span class="badge-status status-selesai">Dikembalikan</span>

<?php } elseif($l->status == 'ditolak'){ ?>
<span class="badge-status status-tolak">Ditolak</span>

<?php } else { ?>
<span class="badge-status status-menunggu">Menunggu</span>
<?php } ?>
</td>

<td class="text-right">
<span class="denda-amount <?= $l->denda > 0 ? 'has-denda' : 'no-denda' ?>">
Rp <?= number_format($l->denda,0,',','.') ?>
</span>
</td>

</tr>
<?php } ?>
<?php } else { ?>

<tr>
<td colspan="5">
<div class="empty-box">
<i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
<p class="text-muted mb-0">Tidak ada data transaksi pada periode ini.</p>
</div>
</td>
</tr>

<?php } ?>

</tbody>
</table>

</div>
</div>
</div>

</div>
</section>
</div>

<?php $this->load->view('templates/footer'); ?>