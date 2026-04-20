<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    function __construct(){
        parent::__construct();

        if($this->session->userdata('role') != 'admin'){
            redirect('index.php/auth');
        }
    }

    // ================= DASHBOARD =================
    function index(){

        $data['total_buku'] = $this->db->count_all('buku');

        $this->db->where('role','user');
        $data['total_anggota'] = $this->db->count_all_results('users');

        $data['total_transaksi'] = $this->db->count_all('transaksi');

        // jumlah notif baru admin
        $this->db->where('role','admin');
        $this->db->where('status','baru');
        $data['notif_baru'] = $this->db->count_all_results('notifikasi');

        $this->db->select('transaksi.*, users.nama as nama_user, buku.judul');
        $this->db->from('transaksi');
        $this->db->join('users','users.id = transaksi.user_id','left');
        $this->db->join('buku','buku.id = transaksi.buku_id','left');
        $this->db->order_by('transaksi.id','DESC');
        $this->db->limit(5);
        $data['transaksi'] = $this->db->get()->result();

        $query = $this->db->query("
            SELECT tanggal_pinjam, COUNT(*) as total
            FROM transaksi
            GROUP BY tanggal_pinjam
            ORDER BY tanggal_pinjam ASC
            LIMIT 7
        ")->result();

        $data['chart_label'] = [];
        $data['chart_data']  = [];

        foreach($query as $q){
            $data['chart_label'][] = date('d M', strtotime($q->tanggal_pinjam));
            $data['chart_data'][]  = $q->total;
        }

        if(empty($data['chart_label'])){
            $data['chart_label'] = ["Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu"];
            $data['chart_data']  = [0,0,0,0,0,0,0];
        }

        $data['chart_data_buku']    = [2,4,1,0,8,3,5];
        $data['chart_data_anggota'] = [1,2,5,2,3,1,4];

        $data['buku_populer'] = $this->db->query("
            SELECT buku.judul, COUNT(*) as total
            FROM transaksi
            JOIN buku ON buku.id = transaksi.buku_id
            GROUP BY buku_id
            ORDER BY total DESC
            LIMIT 5
        ")->result();

        $this->db->select_sum('denda');
        $data['total_denda'] = $this->db->get('transaksi')->row()->denda ?? 0;

        $this->db->where('tanggal_pinjam', date('Y-m-d'));
        $data['transaksi_hari_ini'] = $this->db->count_all_results('transaksi');

        $this->load->view('admin/dashboard', $data);
    }

    // ================= LOG TRANSAKSI =================
    function transaksi(){

        $status_filter = $this->input->get('status');

        $this->db->select('transaksi.*, users.nama as nama_user, buku.judul');
        $this->db->from('transaksi');
        $this->db->join('users','users.id = transaksi.user_id','left');
        $this->db->join('buku','buku.id = transaksi.buku_id','left');

        if(!empty($status_filter)){
            $this->db->where('transaksi.status', $status_filter);
        }

        $this->db->order_by('transaksi.id','DESC');
        $data['transaksi'] = $this->db->get()->result();

        $this->load->view('admin/transaksi', $data);
    }

    // ================= HALAMAN KONFIRMASI =================
    function konfirmasi(){

        $this->db->select('transaksi.*, users.nama as nama_user, buku.judul');
        $this->db->from('transaksi');
        $this->db->join('users','users.id = transaksi.user_id','left');
        $this->db->join('buku','buku.id = transaksi.buku_id','left');
        $this->db->where('transaksi.status', 'menunggu');
        $this->db->order_by('transaksi.id','DESC');

        $data['transaksi'] = $this->db->get()->result();

        $this->load->view('admin/konfirmasi', $data);
    }

    // ================= SETUJUI =================
    function setujui($id){

        $trx = $this->db->get_where('transaksi', ['id'=>$id])->row();

        if(!$trx){
            show_404();
            return;
        }

        if($trx->status != 'menunggu'){
            $this->session->set_flashdata('error','Status transaksi tidak valid');
            redirect('index.php/admin/konfirmasi');
            return;
        }

        $buku = $this->db->get_where('buku', ['id'=>$trx->buku_id])->row();

        if(!$buku || $buku->stok <= 0){
            $this->session->set_flashdata('error','Stok buku habis');
            redirect('index.php/admin/konfirmasi');
            return;
        }

        $this->db->trans_start();

        // update transaksi
        $this->db->where('id',$id);
        $this->db->update('transaksi',[
            'status' => 'dipinjam'
        ]);

        // kurangi stok
        $this->db->set('stok','stok-1',FALSE);
        $this->db->where('id',$trx->buku_id);
        $this->db->update('buku');

        // notif ke user
        $this->db->insert('notifikasi',[
            'user_id' => $trx->user_id,
            'role'    => 'user',
            'judul'   => 'Peminjaman Disetujui',
            'pesan'   => 'Pengajuan peminjaman buku Anda telah disetujui admin.',
            'status'  => 'baru'
        ]);

        $this->db->trans_complete();

        $this->session->set_flashdata('success','Peminjaman berhasil disetujui');
        redirect('index.php/admin/konfirmasi');
    }

    // ================= TOLAK =================
    function tolak($id){

        $trx = $this->db->get_where('transaksi', ['id'=>$id])->row();

        if(!$trx){
            show_404();
            return;
        }

        $this->db->trans_start();

        $this->db->where('id',$id);
        $this->db->update('transaksi',[
            'status' => 'ditolak'
        ]);

        // notif ke user
        $this->db->insert('notifikasi',[
            'user_id' => $trx->user_id,
            'role'    => 'user',
            'judul'   => 'Peminjaman Ditolak',
            'pesan'   => 'Maaf, pengajuan peminjaman Anda ditolak admin.',
            'status'  => 'baru'
        ]);

        $this->db->trans_complete();

        $this->session->set_flashdata('success','Permintaan berhasil ditolak');
        redirect('index.php/admin/konfirmasi');
    }

    // ================= KEMBALIKAN =================
    function kembalikan($id){

        $trx = $this->db->get_where('transaksi', ['id'=>$id])->row();

        if(!$trx){
            show_404();
            return;
        }

        if($trx->status != 'dipinjam'){
            $this->session->set_flashdata('error','Buku tidak bisa dikembalikan');
            redirect('index.php/admin/transaksi');
            return;
        }

        $this->db->trans_start();

        $this->db->where('id',$id);
        $this->db->update('transaksi',[
            'status'           => 'dikembalikan',
            'tanggal_kembali'  => date('Y-m-d')
        ]);

        $this->db->set('stok','stok+1',FALSE);
        $this->db->where('id',$trx->buku_id);
        $this->db->update('buku');

        // notif ke user
        $this->db->insert('notifikasi',[
            'user_id' => $trx->user_id,
            'role'    => 'user',
            'judul'   => 'Buku Dikembalikan',
            'pesan'   => 'Status buku Anda telah dikembalikan.',
            'status'  => 'baru'
        ]);

        $this->db->trans_complete();

        $this->session->set_flashdata('success','Buku berhasil dikembalikan');
        redirect('index.php/admin/transaksi');
    }

    // ================= DETAIL =================
    function detail($id){

        $this->db->select('transaksi.*, users.nama as nama_user, buku.judul');
        $this->db->from('transaksi');
        $this->db->join('users','users.id = transaksi.user_id','left');
        $this->db->join('buku','buku.id = transaksi.buku_id','left');
        $this->db->where('transaksi.id', $id);

        $data['trx'] = $this->db->get()->row();

        if(!$data['trx']){
            show_404();
        }

        $this->load->view('admin/detail_transaksi', $data);
    }

    // ================= HAPUS =================
    function hapus_transaksi($id){

        $trx = $this->db->get_where('transaksi',['id'=>$id])->row();

        if($trx){

            if($trx->status == 'dipinjam'){
                $this->db->set('stok','stok+1',FALSE);
                $this->db->where('id',$trx->buku_id);
                $this->db->update('buku');
            }

            $this->db->delete('transaksi',['id'=>$id]);
        }

        $this->session->set_flashdata('success','Transaksi berhasil dihapus');
        redirect('index.php/admin/transaksi');
    }

    // ================= DATA NOTIF ADMIN (AJAX) =================
    function get_notifikasi(){

        $this->db->where('role','admin');
        $this->db->order_by('id','DESC');
        $this->db->limit(10);

        echo json_encode(
            $this->db->get('notifikasi')->result()
        );
    }

    // ================= BACA NOTIF ADMIN =================
    function baca_notifikasi(){

        $this->db->where('role','admin');
        $this->db->update('notifikasi',[
            'status' => 'dibaca'
        ]);
    }
}