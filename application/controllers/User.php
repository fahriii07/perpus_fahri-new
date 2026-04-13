<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct(){
        parent::__construct();

        // Proteksi: Hanya role user yang bisa masuk
        if($this->session->userdata('role') != 'user'){
            redirect('index.php/auth');
        }

        $this->load->model('Buku_model');
    }

    // ================= DASHBOARD =================
    function index(){
        $this->load->view('user/dashboard');
    }

    // ================= PROFIL & AVATAR (UPDATED TABLE NAME) =================
    function update_profil(){
        $id_user = $this->session->userdata('id'); 
        $nama    = $this->input->post('nama');
        $avatar  = $this->input->post('avatar');

        $data = [
            'nama'   => $nama,
            'avatar' => $avatar
        ];

        // MENGGUNAKAN TABEL 'users'
        $this->db->where('id', $id_user);
        $update = $this->db->update('users', $data);

        if($update){
            // Update Session agar perubahan langsung terlihat di UI
            $this->session->set_userdata('nama', $nama);
            $this->session->set_userdata('user_avatar', $avatar);

            $this->session->set_flashdata('success', 'Profil dan Avatar berhasil diperbarui!');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui profil.');
        }

        redirect($_SERVER['HTTP_REFERER']);
    }

    // ================= DAFTAR BUKU =================
    function buku(){
        $keyword = $this->input->get('cari');

        if($keyword){
            $this->db->like('judul', $keyword);
            $this->db->or_like('pengarang', $keyword);
        }

        $data['buku'] = $this->db->get('buku')->result();
        $this->load->view('user/buku', $data);
    }

    // ================= RIWAYAT (FILTERED BY USER) =================
    function riwayat(){
        $user_id = $this->session->userdata('id');

        $this->db->select('transaksi.*, buku.judul');
        $this->db->from('transaksi');
        $this->db->join('buku','buku.id = transaksi.buku_id');
        $this->db->where('transaksi.user_id', $user_id);

        if($this->input->get('status')){
            $this->db->where('transaksi.status', $this->input->get('status'));
        }

        $this->db->order_by('transaksi.id','DESC');

        $data['riwayat'] = $this->db->get()->result();
        $this->load->view('user/riwayat', $data);
    }

    // ================= PROSES PINJAM BUKU =================
    function pinjam($id){
        $buku = $this->db->get_where('buku', ['id' => $id])->row();

        if(!$buku){
            $this->session->set_flashdata('error','Buku tidak ditemukan!');
            redirect('index.php/user/buku');
        }

        if($buku->stok <= 0){
            $this->session->set_flashdata('error','Maaf, stok buku ini sedang habis!');
            redirect('index.php/user/buku');
        }

        $data = [
            'user_id'        => $this->session->userdata('id'),
            'buku_id'        => $id,
            'tanggal_pinjam' => date('Y-m-d'),
            'status'         => 'pinjam',
            'denda'          => 0
        ];

        $this->db->insert('transaksi', $data);

        $this->db->set('stok', 'stok-1', FALSE);
        $this->db->where('id', $id);
        $this->db->update('buku');

        $this->session->set_flashdata('success', 'Buku "' . $buku->judul . '" berhasil dipinjam!');
        redirect('index.php/user/riwayat');
    }

    // ================= PROSES KEMBALI BUKU =================
    function kembali($id){
        $trx = $this->db->get_where('transaksi', ['id' => $id])->row();

        if(!$trx){
            redirect('index.php/user/riwayat');
        }

        $tgl_pinjam  = strtotime($trx->tanggal_pinjam);
        $tgl_kembali = strtotime(date('Y-m-d'));
        $selisih     = ($tgl_kembali - $tgl_pinjam) / (60*60*24);

        $denda = 0;
        if($selisih > 7){
            $terlambat = $selisih - 7;
            $denda     = $terlambat * 1000;
        }

        $this->db->where('id', $id);
        $this->db->update('transaksi', [
            'status'          => 'kembali',
            'tanggal_kembali' => date('Y-m-d'),
            'denda'           => $denda
        ]);

        $this->db->set('stok', 'stok+1', FALSE);
        $this->db->where('id', $trx->buku_id);
        $this->db->update('buku');

        if($denda > 0){
            $this->session->set_flashdata('success', 'Buku dikembalikan. Terlambat ' . $terlambat . ' hari, denda: Rp ' . number_format($denda));
        } else {
            $this->session->set_flashdata('success', 'Terima kasih! Buku dikembalikan tepat waktu.');
        }

        redirect('index.php/user/riwayat');
    }
}