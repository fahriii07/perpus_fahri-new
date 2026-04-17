<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct(){
        parent::__construct();

        if($this->session->userdata('role') != 'user'){
            redirect('index.php/auth');
        }

        $this->load->model('Buku_model');
    }

    // ================= DASHBOARD =================
    function index(){

        $user_id = $this->session->userdata('id');

        // 🔥 HITUNG XP (dari buku yang sudah dikembalikan)
        $this->db->where('user_id', $user_id);
        $this->db->where('status', 'dikembalikan');
        $total_selesai = $this->db->count_all_results('transaksi');

        $xp = $total_selesai * 50;

        // 🔥 LEVELING SYSTEM
        if($xp >= 1000){
            $level = 'Legend';
        } elseif($xp >= 500){
            $level = 'Elite';
        } elseif($xp >= 200){
            $level = 'Pro';
        } else {
            $level = 'Beginner';
        }

        // 🔥 PINJAMAN AKTIF
        $this->db->where('user_id', $user_id);
        $this->db->where('status', 'dipinjam');
        $pinjaman_aktif = $this->db->count_all_results('transaksi');

        $data = [
            'xp' => $xp,
            'level' => $level,
            'pinjaman_aktif' => $pinjaman_aktif
        ];

        $this->load->view('user/dashboard', $data);
    }

    // ================= DETAIL BUKU =================
    function detail($id){
        $data['buku'] = $this->db->get_where('buku', ['id' => $id])->row();

        if(!$data['buku']){
            show_404();
        }

        $this->load->view('user/detail_buku', $data);
    }

    // ================= PROFIL =================
    function update_profil(){
        $id_user = $this->session->userdata('id'); 
        $nama    = $this->input->post('nama');
        
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      = 2048;
        $config['file_name']     = 'user_'.time();

        $this->load->library('upload', $config);

        $avatar = $this->session->userdata('user_avatar');

        if (!empty($_FILES['avatar']['name'])) {
            if ($this->upload->do_upload('avatar')) {
                $upload_data = $this->upload->data();
                $avatar = base_url('uploads/') . $upload_data['file_name'];
            } else {
                $this->session->set_flashdata('error', $this->upload->display_errors());
                redirect($_SERVER['HTTP_REFERER']);
                return;
            }
        }

        $data = [
            'nama'   => $nama,
            'avatar' => $avatar
        ];

        $this->db->where('id', $id_user);
        $update = $this->db->update('users', $data);

        if($update){
            $this->session->set_userdata('nama', $nama);
            $this->session->set_userdata('user_avatar', $avatar);
            $this->session->set_flashdata('success', 'Profil berhasil diperbarui!');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui database.');
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

    // ================= RIWAYAT =================
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

    // ================= PINJAM =================
    function pinjam($id){
        $user_id = $this->session->userdata('id');

        $buku = $this->db->get_where('buku', ['id' => $id])->row();

        if(!$buku){
            $this->session->set_flashdata('error','Buku tidak ditemukan!');
            redirect('index.php/user/buku');
        }

        if($buku->stok <= 0){
            $this->session->set_flashdata('error','Stok buku habis!');
            redirect('index.php/user/buku');
        }

        $cek = $this->db->where('user_id', $user_id)
                        ->where_in('status', ['pending','dipinjam'])
                        ->count_all_results('transaksi');

        if($cek >= 3){
            $this->session->set_flashdata('error','Maksimal 3 buku');
            redirect('index.php/user/buku');
        }

        $data = [
            'user_id'        => $user_id,
            'buku_id'        => $id,
            'tanggal_pinjam' => date('Y-m-d'),
            'status'         => 'pending',
            'denda'          => 0
        ];

        $this->db->insert('transaksi', $data);

        $this->session->set_flashdata('success', 
            'Pengajuan "' . $buku->judul . '" menunggu konfirmasi admin'
        );

        redirect('index.php/user/riwayat');
    }

    // ================= KEMBALI =================
    function kembali($id){
        $trx = $this->db->get_where('transaksi', ['id' => $id])->row();

        if(!$trx) redirect('index.php/user/riwayat');

        if($trx->status != 'dipinjam'){
            $this->session->set_flashdata('error','Belum disetujui admin!');
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
            'status' => 'dikembalikan',
            'tanggal_kembali' => date('Y-m-d'),
            'denda' => $denda
        ]);

        $this->db->set('stok', 'stok+1', FALSE);
        $this->db->where('id', $trx->buku_id);
        $this->db->update('buku');

        redirect('index.php/user/riwayat');
    }

    // ================= CETAK =================
    public function cetak_kartu() {
        $id_user = $this->session->userdata('id');
        $data['user'] = $this->db->get_where('users', ['id' => $id_user])->row();
        
        $this->load->view('user/cetak_kartu', $data);
    }
}