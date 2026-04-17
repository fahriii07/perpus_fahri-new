<?php $this->load->view('templates/header'); ?>
<?php $this->load->view('templates/sidebar_admin'); ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
/* --- BASE CSS (TIDAK DIUBAH) --- */
.content-wrapper {
    background: var(--bg-main) !important;
    padding: 25px !important; 
    transition: 0.4s ease;
}

:root {
    --bg-main: #f8fafc;
    --bg-card: #ffffff;
    --primary-grad: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
    --text-title: #0f172a;
    --text-body: #475569;
    --table-border: #f1f5f9;
    --table-hover: #f8fafc;
    --badge-bg: #6366f11a;
    --badge-color: #6366f1;
}

body.dark-mode {
    --bg-main: #020617;
    --bg-card: #0f172a;
    --text-title: #f8fafc;
    --text-body: #94a3b8;
    --table-border: #1e293b;
    --table-hover: #1e293b80;
    --badge-bg: #818cf82a;
    --badge-color: #818cf8;
}

.welcome-banner {
    background: var(--primary-grad);
    border-radius: 25px;
    padding: 35px 45px;
    color: white;
    margin-bottom: 30px;
    box-shadow: 0 10px 20px rgba(79, 70, 229, 0.2);
}

.stat-card-v3 {
    background: var(--bg-card);
    border-radius: 22px;
    padding: 28px;
    display: flex;
    align-items: center;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}

.icon-circle {
    width: 65px;
    height: 65px;
    border-radius: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    margin-right: 22px;
    color: white;
    background: var(--primary-grad);
}

.stat-value-v3 {
    font-size: 2.2rem;
    font-weight: 800;
    color: var(--text-title);
}

.chart-card {
    background: var(--bg-card);
    border-radius: 20px;
    padding: 25px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    border: 1px solid rgba(0,0,0,0.05);
    height: 100%;
}

.chart-container {
    position: relative;
    height: 220px; /* Ukuran disesuaikan agar pas 3 kolom */
    width: 100%;
}

/* --- UPGRADE STYLING BUKU POPULER --- */
.table-modern {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 8px;
}

.table-modern thead th {
    border: none;
    color: var(--text-body);
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 1px;
    padding: 10px 15px;
    font-weight: 700;
}

.table-modern tbody td {
    background: transparent;
    border-top: 1px solid var(--table-border);
    border-bottom: 1px solid var(--table-border);
    padding: 15px;
    vertical-align: middle;
    color: var(--text-title);
    transition: 0.3s;
}

.table-modern tbody td:first-child {
    border-left: 1px solid var(--table-border);
    border-radius: 12px 0 0 12px;
}

.table-modern tbody td:last-child {
    border-right: 1px solid var(--table-border);
    border-radius: 0 12px 12px 0;
}

.table-modern tbody tr:hover td {
    background: var(--table-hover);
}

.book-title-wrapper {
    display: flex;
    align-items: center;
    gap: 12px;
}

.book-icon-box {
    width: 35px;
    height: 35px;
    background: var(--badge-bg);
    color: var(--badge-color);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9rem;
}

.total-badge {
    background: var(--badge-bg);
    color: var(--badge-color);
    padding: 6px 14px;
    border-radius: 10px;
    font-weight: 700;
    font-size: 0.85rem;
    display: inline-block;
}
</style>

<div class="content-wrapper">
<section class="content">
<div class="container-fluid">

<div class="welcome-banner">
    <h1>Halo Admin 🚀</h1>
    <p>Ringkasan data perpustakaan hari ini</p>
</div>

<div class="row">
    <div class="col-md-4 mb-4">
        <div class="stat-card-v3">
            <div class="icon-circle"><i class="fas fa-book"></i></div>
            <div>
                <p style="color: var(--text-body); margin: 0;">Koleksi Buku</p>
                <h2 class="stat-value-v3"><?= $total_buku ?></h2>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="stat-card-v3">
            <div class="icon-circle" style="background: #10b981"><i class="fas fa-users"></i></div>
            <div>
                <p style="color: var(--text-body); margin: 0;">Anggota</p>
                <h2 class="stat-value-v3"><?= $total_anggota ?></h2>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="stat-card-v3">
            <div class="icon-circle" style="background: #f59e0b"><i class="fas fa-exchange-alt"></i></div>
            <div>
                <p style="color: var(--text-body); margin: 0;">Transaksi</p>
                <h2 class="stat-value-v3"><?= $total_transaksi ?></h2>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-lg-4 mb-4">
        <div class="chart-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 style="font-weight: 700; color: var(--text-title); margin:0;">📈 Grafik Transaksi</h6>
                <span class="badge badge-primary">7 Hari</span>
            </div>
            <div class="chart-container">
                <canvas id="chartTransaksi"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-4 mb-4">
        <div class="chart-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 style="font-weight: 700; color: var(--text-title); margin:0;">📚 Grafik Buku</h6>
                <span class="badge badge-success">Baru</span>
            </div>
            <div class="chart-container">
                <canvas id="chartBuku"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-4 mb-4">
        <div class="chart-card">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 style="font-weight: 700; color: var(--text-title); margin:0;">👥 Grafik Anggota</h6>
                <span class="badge badge-warning">Aktif</span>
            </div>
            <div class="chart-container">
                <canvas id="chartAnggota"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="chart-card mb-4">
    <div class="d-flex align-items-center mb-4">
        <div style="font-size: 1.5rem; margin-right: 12px;">🔥</div>
        <h5 class="mb-0" style="font-weight: 700; color: var(--text-title);">Buku Terpopuler</h5>
    </div>

    <div class="table-responsive">
        <table class="table-modern">
            <thead>
                <tr>
                    <th>Judul Buku</th>
                    <th class="text-right">Total Pinjam</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($buku_populer)): ?>
                    <?php foreach($buku_populer as $b): ?>
                    <tr>
                        <td>
                            <div class="book-title-wrapper">
                                <div class="book-icon-box">
                                    <i class="fas fa-book"></i>
                                </div>
                                <span style="font-weight: 600;"><?= $b->judul ?></span>
                            </div>
                        </td>
                        <td class="text-right">
                            <span class="total-badge"><?= $b->total ?> Pinjam</span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2" class="text-center py-4" style="color: var(--text-body);">Belum ada data peminjaman</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</div>
</section>
</div>

<script>
const isDark = document.body.classList.contains('dark-mode');
const commonOptions = {
    responsive: true,
    maintainAspectRatio: false,
    plugins: { legend: { display: false } },
    scales: {
        y: {
            beginAtZero: true,
            grid: { color: isDark ? '#1e293b' : '#f1f5f9' },
            ticks: { color: isDark ? '#94a3b8' : '#64748b', stepSize: 1 }
        },
        x: {
            grid: { display: false },
            ticks: { color: isDark ? '#94a3b8' : '#64748b' }
        }
    }
};

// 1. Chart Transaksi
new Chart(document.getElementById('chartTransaksi'), {
    type: 'line',
    data: {
        labels: <?= json_encode($chart_label) ?>,
        datasets: [{
            data: <?= json_encode($chart_data) ?>,
            borderColor: '#6366f1',
            backgroundColor: 'rgba(99, 102, 241, 0.1)',
            borderWidth: 3,
            tension: 0.4,
            fill: true,
            pointBackgroundColor: '#6366f1'
        }]
    },
    options: commonOptions
});

// 2. Chart Buku (Menggunakan data $chart_data_buku jika ada, jika tidak pakai data dummy sebagai contoh)
new Chart(document.getElementById('chartBuku'), {
    type: 'bar',
    data: {
        labels: <?= json_encode($chart_label) ?>,
        datasets: [{
            data: <?= isset($chart_data_buku) ? json_encode($chart_data_buku) : json_encode($chart_data) ?>, 
            backgroundColor: '#10b981',
            borderRadius: 5
        }]
    },
    options: commonOptions
});

// 3. Chart Anggota
new Chart(document.getElementById('chartAnggota'), {
    type: 'line',
    data: {
        labels: <?= json_encode($chart_label) ?>,
        datasets: [{
            data: <?= isset($chart_data_anggota) ? json_encode($chart_data_anggota) : json_encode($chart_data) ?>,
            borderColor: '#f59e0b',
            backgroundColor: 'rgba(245, 158, 11, 0.1)',
            borderWidth: 3,
            tension: 0.4,
            fill: true,
            pointBackgroundColor: '#f59e0b'
        }]
    },
    options: commonOptions
});
</script>

<?php $this->load->view('templates/footer'); ?>