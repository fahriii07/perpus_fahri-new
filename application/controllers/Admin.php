<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    function __construct(){
        parent::__construct();

        // 🔐 PROTEKSI ADMIN
        if($this->session->userdata('role') != 'admin'){
            redirect('index.php/auth');
        }
    }

    // ================= DASHBOARD =================
    function index(){
        // ===== STATISTIK =====
        $data['total_buku'] = $this->db->count_all('buku');

        $this->db->where('role','user');
        $data['total_anggota'] = $this->db->count_all_results('users');

        $data['total_transaksi'] = $this->db->count_all('transaksi');

        // ===== TRANSAKSI (FIX JOIN) =====
        $this->db->select('transaksi.*, users.nama as nama_user, buku.judul');
        $this->db->from('transaksi');
        $this->db->join('users','users.id = transaksi.user_id','left');
        $this->db->join('buku','buku.id = transaksi.buku_id','left');

        $this->db->order_by('transaksi.id','DESC');
        $this->db->limit(5);

        $data['transaksi'] = $this->db->get()->result();

        $this->load->view('admin/dashboard', $data);
    }

    // ================= DATA TRANSAKSI =================
    function transaksi(){
        // 🔍 TANGKAP FILTER STATUS
        $status_filter = $this->input->get('status');

        $this->db->select('transaksi.*, users.nama as nama_user, buku.judul');
        $this->db->from('transaksi');
        $this->db->join('users','users.id = transaksi.user_id','left');
        $this->db->join('buku','buku.id = transaksi.buku_id','left');

        // 🔥 TERAPKAN FILTER JIKA ADA
        if(!empty($status_filter)){
            $this->db->where('transaksi.status', $status_filter);
        }

        $this->db->order_by('transaksi.id','DESC');
        $data['transaksi'] = $this->db->get()->result();

        $this->load->view('admin/transaksi', $data);
    }

    // ================= PROSES KEMBALIKAN BUKU =================
    function kembalikan($id){
        // 1. Cari data transaksi
        $trx = $this->db->get_where('transaksi', ['id' => $id])->row();

        if($trx && $trx->status == 'pinjam'){
            $tgl_kembali = date('Y-m-d');
            $tgl_pinjam  = $trx->tanggal_pinjam;

            // 2. Hitung Denda (Batas 7 hari, denda Rp 1.000/hari)
            $denda = 0;
            $tgl_deadline = date('Y-m-d', strtotime($tgl_pinjam . ' +7 days'));
            
            if($tgl_kembali > $tgl_deadline){
                $selisih = (strtotime($tgl_kembali) - strtotime($tgl_deadline)) / (60 * 60 * 24);
                $denda = floor($selisih) * 1000;
            }

            // 3. Update status transaksi
            $this->db->where('id', $id);
            $this->db->update('transaksi', [
                'tanggal_kembali' => $tgl_kembali,
                'status'          => 'kembali',
                'denda'           => $denda
            ]);

            // 4. Kembalikan stok buku (+1)
            $this->db->set('stok', 'stok+1', FALSE);
            $this->db->where('id', $trx->buku_id);
            $this->db->update('buku');

            $pesan = ($denda > 0) ? "Buku kembali. User dikenakan denda Rp " . number_format($denda) : "Buku telah dikembalikan tepat waktu.";
            $this->session->set_flashdata('success', $pesan);
        }

        redirect('index.php/admin/transaksi');
    }

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

    // ================= HAPUS TRANSAKSI =================
    function hapus_transaksi($id){
        $trx = $this->db->get_where('transaksi',['id'=>$id])->row();

        if($trx){
            // jika masih dipinjam → kembalikan stok sebelum log dihapus
            if($trx->status == 'pinjam'){
                $this->db->set('stok','stok+1',FALSE);
                $this->db->where('id',$trx->buku_id);
                $this->db->update('buku');
            }

            $this->db->delete('transaksi',['id'=>$id]);
        }

        $this->session->set_flashdata('success','Transaksi berhasil dihapus');
        redirect('index.php/admin/transaksi');
    }
}