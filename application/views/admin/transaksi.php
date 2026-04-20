<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar_admin'); ?>

<style>
:root{
    --bg-body:#f8fafc;
    --bg-card:#ffffff;
    --text-main:#1e293b;
    --text-muted:#64748b;
    --table-header:#f1f5f9;
    --border-color:#e2e8f0;
    --hover-row:#f8fafc;
    --input-bg:#ffffff;
    --shadow:0 8px 24px rgba(15,23,42,.06);
}

/* ================= DARK MODE SUPPORT ================= */
body.dark-mode{
    --bg-body:#0f172a;
    --bg-card:#1e293b;
    --text-main:#f8fafc;
    --text-muted:#94a3b8;
    --table-header:#334155;
    --border-color:#475569;
    --hover-row:#263244;
    --input-bg:#243244;
    --shadow:0 10px 30px rgba(0,0,0,.35);
}

body,
.content-wrapper,
.card,
.table,
.table td,
.table th,
.form-control,
select,
option,
small,
p,
span,
div{
    transition:.25s ease;
}

.content-wrapper{
    background:var(--bg-body)!important;
    padding-top:25px;
    min-height:100vh!important;
}

.page-title{
    font-weight:800;
    color:var(--text-main);
}

.text-muted{
    color:var(--text-muted)!important;
}

.filter-card,
.card-table-container{
    border:none;
    border-radius:18px;
    background:var(--bg-card)!important;
    box-shadow:var(--shadow)!important;
}

/* ================= FORM ================= */
.form-control-custom{
    background:var(--input-bg)!important;
    border:1px solid var(--border-color)!important;
    color:var(--text-main)!important;
    border-radius:10px;
    padding:10px 15px;
}

.form-control-custom:focus{
    box-shadow:none!important;
    border-color:#6366f1!important;
    background:var(--input-bg)!important;
    color:var(--text-main)!important;
}

body.dark-mode select option{
    background:#1e293b;
    color:#f8fafc;
}

/* ================= TABLE ================= */
.table{
    color:var(--text-main)!important;
    margin-bottom:0;
}

.table thead th{
    background:var(--table-header)!important;
    border:none!important;
    color:var(--text-muted)!important;
    font-size:.75rem;
    text-transform:uppercase;
    letter-spacing:1px;
    padding:18px 20px;
}

.table td{
    border-bottom:1px solid var(--border-color)!important;
    padding:18px 20px;
    vertical-align:middle;
    color:var(--text-main)!important;
    background:var(--bg-card)!important;
}

.table tbody tr{
    background:var(--bg-card)!important;
}

.table tbody tr:hover td{
    background:var(--hover-row)!important;
}

.table-responsive{
    border-radius:18px;
}

/* ================= STATUS ================= */
.badge-status{
    padding:7px 14px;
    border-radius:10px;
    font-size:.75rem;
    font-weight:700;
}

.status-pinjam{
    background:rgba(245,158,11,.15);
    color:#f59e0b;
}

.status-selesai{
    background:rgba(34,197,94,.15);
    color:#22c55e;
}

/* ================= DENDA ================= */
.denda-amount{
    font-family:monospace;
    padding:5px 10px;
    border-radius:8px;
    font-weight:700;
    font-size:.82rem;
}

.has-denda{
    background:rgba(225,29,72,.1);
    color:#e11d48;
}

.no-denda{
    background:var(--table-header);
    color:var(--text-muted);
}

/* ================= BUTTON ================= */
.btn-action{
    border:none;
    border-radius:10px;
    padding:8px 12px;
    font-weight:700;
    display:inline-flex;
    align-items:center;
    gap:6px;
    text-decoration:none!important;
    transition:.2s;
}

.btn-action:hover{
    color:#fff!important;
    transform:translateY(-2px);
}

.btn-detail-modern{
    background:rgba(14,165,233,.12);
    color:#0ea5e9;
}
.btn-detail-modern:hover{
    background:#0ea5e9;
}

.btn-kembali-modern{
    background:rgba(34,197,94,.12);
    color:#22c55e;
}
.btn-kembali-modern:hover{
    background:#22c55e;
}

.btn-delete-modern{
    background:rgba(225,29,72,.12);
    color:#e11d48;
}
.btn-delete-modern:hover{
    background:#e11d48;
}

/* ================= ALERT ================= */
.alert-custom{
    border-radius:12px;
    background:rgba(34,197,94,.12);
    border:none;
    color:#22c55e;
}

.btn-reset-modern{
    text-decoration:none;
    color:var(--text-muted);
    font-weight:600;
}

.btn-reset-modern:hover{
    color:#6366f1;
}

/* ================= EMPTY DATA ================= */
.empty-box i,
.empty-box p{
    color:var(--text-muted)!important;
}
</style>

<div class="content-wrapper">
<section class="content">
<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="page-title mb-1">📋 Log Transaksi</h3>
        <p class="text-muted small mb-0">Pantau arus peminjaman dan pengembalian buku</p>
    </div>
</div>

<div class="card filter-card shadow-sm mb-4">
<div class="card-body">

<form method="get" action="<?= base_url('index.php/admin/transaksi') ?>">
<div class="row align-items-end">

<div class="col-md-4">
<label class="small font-weight-bold text-muted">Filter Status</label>

<select name="status" class="form-control form-control-custom border-0 shadow-none">
    <option value="">Semua Status</option>
    <option value="dipinjam" <?= ($this->input->get('status')=='dipinjam') ? 'selected' : '' ?>>
        Dipinjam
    </option>
    <option value="dikembalikan" <?= ($this->input->get('status')=='dikembalikan') ? 'selected' : '' ?>>
        Dikembalikan
    </option>
</select>
</div>

<div class="col-md-4">
<button type="submit"
class="btn btn-primary px-4 font-weight-bold"
style="border-radius:10px;background:#6366f1;border:none;">
<i class="fas fa-filter mr-1"></i> Terapkan Filter
</button>

<a href="<?= base_url('index.php/admin/transaksi') ?>" class="btn-reset-modern small ml-2">
<i class="fas fa-undo-alt"></i> Reset
</a>
</div>

</div>
</form>

</div>
</div>

<?php if($this->session->flashdata('success')){ ?>
<div class="alert alert-custom shadow-sm mb-4">
    <i class="fas fa-check-circle mr-2"></i>
    <?= $this->session->flashdata('success') ?>
</div>
<?php } ?>

<div class="card card-table-container shadow-sm">
<div class="card-body p-0">
<div class="table-responsive">

<table class="table mb-0">
<thead>
<tr>
    <th>Peminjam</th>
    <th>Informasi Buku</th>
    <th>Periode Pinjam</th>
    <th>Status</th>
    <th>Denda</th>
    <th class="text-center">Aksi</th>
</tr>
</thead>

<tbody>

<?php foreach($transaksi as $t){ ?>
<tr>

<td>
    <div class="font-weight-bold"><?= $t->nama_user ?: '-' ?></div>
    <small class="text-muted">
        ID: #<?= str_pad($t->id,4,'0',STR_PAD_LEFT) ?>
    </small>
</td>

<td style="max-width:220px;">
    <div class="font-weight-bold text-truncate">
        <?= $t->judul ?: '-' ?>
    </div>
    <small class="text-muted">Buku Perpustakaan</small>
</td>

<td>
<div class="small">

<span class="text-success">
<i class="fas fa-calendar-plus mr-1"></i>
<?= date('d M Y', strtotime($t->tanggal_pinjam)) ?>
</span>

<br>

<?php if($t->status == 'dipinjam'){ ?>

<span class="text-danger">
<i class="fas fa-book mr-1"></i>
<i>Sedang Dipinjam</i>
</span>

<?php } else { ?>

<span class="text-primary">
<i class="fas fa-calendar-check mr-1"></i>

<?=
($t->tanggal_kembali && $t->tanggal_kembali != '0000-00-00')
? date('d M Y', strtotime($t->tanggal_kembali))
: '-'
?>

</span>

<?php } ?>

</div>
</td>

<td>
<?php if($t->status == 'dipinjam'){ ?>
    <span class="badge-status status-pinjam">Dipinjam</span>
<?php } else { ?>
    <span class="badge-status status-selesai">Dikembalikan</span>
<?php } ?>
</td>

<td>
<span class="denda-amount <?= ($t->denda > 0) ? 'has-denda' : 'no-denda' ?>">
Rp <?= number_format($t->denda) ?>
</span>
</td>

<td class="text-center">
<div class="d-flex justify-content-center flex-wrap" style="gap:8px;">

<?php if($t->status == 'dipinjam'){ ?>
<a href="<?= base_url('index.php/admin/kembalikan/'.$t->id) ?>"
class="btn-action btn-kembali-modern"
onclick="confirmReturn(event,this.href)">
<i class="fas fa-undo-alt"></i>
<small>Kembalikan</small>
</a>
<?php } ?>

<a href="<?= base_url('index.php/admin/detail/'.$t->id) ?>"
class="btn-action btn-detail-modern">
<i class="fas fa-eye"></i>
</a>

<a href="<?= base_url('index.php/admin/hapus_transaksi/'.$t->id) ?>"
class="btn-action btn-delete-modern"
onclick="confirmDelete(event,this.href)">
<i class="fas fa-trash-alt"></i>
</a>

</div>
</td>

</tr>
<?php } ?>

<?php if(empty($transaksi)){ ?>
<tr>
<td colspan="6" class="text-center py-5 empty-box">
<i class="fas fa-folder-open fa-3x mb-3"></i>
<p>Tidak ada riwayat transaksi ditemukan.</p>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function confirmDelete(e,url){
    e.preventDefault();

    const isDark=document.body.classList.contains('dark-mode');

    Swal.fire({
        title:'Hapus Log?',
        text:'Data transaksi akan dihapus permanen.',
        icon:'warning',
        showCancelButton:true,
        confirmButtonText:'Ya, Hapus',
        cancelButtonText:'Batal',
        confirmButtonColor:'#e11d48',
        cancelButtonColor:'#64748b',
        background:isDark ? '#1e293b' : '#ffffff',
        color:isDark ? '#f1f5f9' : '#1e293b'
    }).then((result)=>{
        if(result.isConfirmed){
            window.location.href=url;
        }
    });
}

function confirmReturn(e,url){
    e.preventDefault();

    const isDark=document.body.classList.contains('dark-mode');

    Swal.fire({
        title:'Kembalikan Buku?',
        text:'Status akan berubah menjadi dikembalikan.',
        icon:'question',
        showCancelButton:true,
        confirmButtonText:'Ya, Kembalikan',
        cancelButtonText:'Batal',
        confirmButtonColor:'#22c55e',
        cancelButtonColor:'#64748b',
        background:isDark ? '#1e293b' : '#ffffff',
        color:isDark ? '#f1f5f9' : '#1e293b'
    }).then((result)=>{
        if(result.isConfirmed){
            window.location.href=url;
        }
    });
}
</script>

<?php $this->load->view('templates/footer'); ?>