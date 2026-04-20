<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar_admin'); ?>

<style>
:root{
    --bg-body:#f8fafc;
    --bg-card:#ffffff;
    --text-main:#0f172a;
    --text-muted:#64748b;
    --border:#e2e8f0;
    --thead:#f1f5f9;
    --row-hover:#f8fafc;
    --shadow:0 10px 30px rgba(15,23,42,.06);
}

body.dark-mode{
    --bg-body:#0f172a;
    --bg-card:#1e293b;
    --text-main:#f8fafc;
    --text-muted:#94a3b8;
    --border:#334155;
    --thead:#243244;
    --row-hover:#263244;
    --shadow:0 12px 30px rgba(0,0,0,.35);
}

.content-wrapper{
    background:var(--bg-body)!important;
    min-height:100vh;
    transition:.3s ease;
}

/* HEADER */
.page-title{
    color:var(--text-main);
    font-weight:800;
    margin-bottom:4px;
}

.page-subtitle{
    color:var(--text-muted);
    font-size:.92rem;
    margin-bottom:0;
}

/* CARD */
.request-card{
    background:var(--bg-card);
    border:none;
    border-radius:20px;
    box-shadow:var(--shadow);
    overflow:hidden;
}

/* TABLE */
.table-modern{
    margin:0;
}

.table-modern thead th{
    background:var(--thead);
    color:var(--text-muted);
    border:none!important;
    padding:18px 20px;
    font-size:.78rem;
    text-transform:uppercase;
    letter-spacing:1px;
    font-weight:800;
}

.table-modern td{
    padding:18px 20px;
    vertical-align:middle;
    border-top:none!important;
    border-bottom:1px solid var(--border);
    color:var(--text-main);
    background:var(--bg-card);
}

.table-modern tbody tr:hover td{
    background:var(--row-hover);
}

/* USER */
.user-name{
    font-weight:700;
    margin-bottom:3px;
}

.user-id{
    color:var(--text-muted);
    font-size:.78rem;
}

/* BOOK */
.book-title{
    font-weight:700;
}

.book-meta{
    color:var(--text-muted);
    font-size:.8rem;
}

/* BADGE */
.badge-waiting{
    padding:8px 14px;
    border-radius:999px;
    font-size:.75rem;
    font-weight:700;
    background:rgba(245,158,11,.15);
    color:#f59e0b;
}

/* BUTTON */
.btn-action{
    border:none;
    border-radius:12px;
    padding:8px 14px;
    font-weight:700;
    font-size:.82rem;
    text-decoration:none!important;
    display:inline-flex;
    align-items:center;
    gap:6px;
    transition:.2s ease;
}

.btn-action:hover{
    transform:translateY(-2px);
    color:#fff!important;
}

.btn-approve{
    background:rgba(34,197,94,.12);
    color:#22c55e;
}

.btn-approve:hover{
    background:#22c55e;
}

.btn-reject{
    background:rgba(225,29,72,.12);
    color:#e11d48;
}

.btn-reject:hover{
    background:#e11d48;
}

/* EMPTY */
.empty-box{
    padding:60px 20px;
    text-align:center;
}

.empty-box i{
    font-size:48px;
    color:var(--text-muted);
    margin-bottom:15px;
}

.empty-box p{
    color:var(--text-muted);
    margin:0;
}

/* MOBILE */
@media(max-width:768px){
    .table-modern thead{
        display:none;
    }

    .table-modern,
    .table-modern tbody,
    .table-modern tr,
    .table-modern td{
        display:block;
        width:100%;
    }

    .table-modern tr{
        border-bottom:1px solid var(--border);
    }

    .table-modern td{
        padding:12px 15px;
    }

    .table-modern td::before{
        content:attr(data-label);
        display:block;
        font-size:.75rem;
        color:var(--text-muted);
        margin-bottom:4px;
        font-weight:700;
        text-transform:uppercase;
    }
}
</style>

<div class="content-wrapper p-4">

<div class="mb-4">
    <h3 class="page-title">📚 Permintaan Peminjaman</h3>
    <p class="page-subtitle">Kelola pengajuan pinjam buku dari pengguna</p>
</div>

<div class="card request-card">
<div class="table-responsive">

<table class="table table-modern">
<thead>
<tr>
    <th>User</th>
    <th>Buku</th>
    <th>Tanggal</th>
    <th>Status</th>
    <th class="text-center">Aksi</th>
</tr>
</thead>

<tbody>

<?php if(!empty($transaksi)){ ?>
<?php foreach($transaksi as $t){ ?>
<tr>

<td data-label="User">
    <div class="user-name"><?= $t->nama_user ?></div>
    <div class="user-id">ID #<?= str_pad($t->id,4,'0',STR_PAD_LEFT) ?></div>
</td>

<td data-label="Buku">
    <div class="book-title"><?= $t->judul ?></div>
    <div class="book-meta">Perpustakaan Digital</div>
</td>

<td data-label="Tanggal">
    <?= date('d M Y', strtotime($t->tanggal_pinjam)) ?>
</td>

<td data-label="Status">
    <span class="badge-waiting">
        <i class="fas fa-clock mr-1"></i> Menunggu
    </span>
</td>

<td data-label="Aksi" class="text-center">
    <div class="d-flex justify-content-center flex-wrap" style="gap:8px;">

        <a href="<?= base_url('index.php/admin/setujui/'.$t->id) ?>"
           class="btn-action btn-approve"
           onclick="confirmApprove(event,this.href)">
            <i class="fas fa-check"></i>
            Setujui
        </a>

        <a href="<?= base_url('index.php/admin/tolak/'.$t->id) ?>"
           class="btn-action btn-reject"
           onclick="confirmReject(event,this.href)">
            <i class="fas fa-times"></i>
            Tolak
        </a>

    </div>
</td>

</tr>
<?php } ?>
<?php } else { ?>

<tr>
<td colspan="5">
    <div class="empty-box">
        <i class="fas fa-inbox"></i>
        <p>Tidak ada permintaan peminjaman saat ini.</p>
    </div>
</td>
</tr>

<?php } ?>

</tbody>
</table>

</div>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function confirmApprove(e,url){
    e.preventDefault();

    const dark=document.body.classList.contains('dark-mode');

    Swal.fire({
        title:'Setujui Permintaan?',
        text:'Buku akan masuk status dipinjam.',
        icon:'question',
        showCancelButton:true,
        confirmButtonText:'Ya, Setujui',
        cancelButtonText:'Batal',
        confirmButtonColor:'#22c55e',
        cancelButtonColor:'#64748b',
        background:dark ? '#1e293b' : '#ffffff',
        color:dark ? '#f8fafc' : '#0f172a'
    }).then((r)=>{
        if(r.isConfirmed){
            window.location.href=url;
        }
    });
}

function confirmReject(e,url){
    e.preventDefault();

    const dark=document.body.classList.contains('dark-mode');

    Swal.fire({
        title:'Tolak Permintaan?',
        text:'Pengajuan pinjam akan ditolak.',
        icon:'warning',
        showCancelButton:true,
        confirmButtonText:'Ya, Tolak',
        cancelButtonText:'Batal',
        confirmButtonColor:'#e11d48',
        cancelButtonColor:'#64748b',
        background:dark ? '#1e293b' : '#ffffff',
        color:dark ? '#f8fafc' : '#0f172a'
    }).then((r)=>{
        if(r.isConfirmed){
            window.location.href=url;
        }
    });
}
</script>

<?php $this->load->view('templates/footer'); ?>