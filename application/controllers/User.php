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

        // XP dari buku selesai dikembalikan
        $this->db->where('user_id', $user_id);
        $this->db->where('status', 'dikembalikan');
        $total_selesai = $this->db->count_all_results('transaksi');

        $xp = $total_selesai * 50;

        if($xp >= 1000){
            $level = 'Legend';
        } elseif($xp >= 500){
            $level = 'Elite';
        } elseif($xp >= 200){
            $level = 'Pro';
        } else {
            $level = 'Beginner';
        }

        // Pinjaman aktif
        $this->db->where('user_id', $user_id);
        $this->db->where('status', 'dipinjam');
        $pinjaman_aktif = $this->db->count_all_results('transaksi');

        // Menunggu konfirmasi
        $this->db->where('user_id', $user_id);
        $this->db->where('status', 'menunggu');
        $menunggu = $this->db->count_all_results('transaksi');

        $data = [
            'xp' => $xp,
            'level' => $level,
            'pinjaman_aktif' => $pinjaman_aktif,
            'menunggu' => $menunggu
        ];

        $this->load->view('user/dashboard', $data);
    }

    // ================= DETAIL BUKU =================
    function detail($id){

        $data['buku'] = $this->db->get_where('buku', ['id'=>$id])->row();

        if(!$data['buku']){
            show_404();
        }

        $this->load->view('user/detail_buku', $data);
    }

    // ================= UPDATE PROFIL =================
    function update_profil(){

        $id_user = $this->session->userdata('id');
        $nama    = $this->input->post('nama');

        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      = 2048;
        $config['file_name']     = 'user_'.time();

        $this->load->library('upload', $config);

        $avatar = $this->session->userdata('user_avatar');

        if(!empty($_FILES['avatar']['name'])){

            if($this->upload->do_upload('avatar')){

                $upload_data = $this->upload->data();
                $avatar = base_url('uploads/'.$upload_data['file_name']);

            }else{

                $this->session->set_flashdata(
                    'error',
                    strip_tags($this->upload->display_errors())
                );

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

            $this->session->set_flashdata(
                'success',
                'Profil berhasil diperbarui!'
            );

        }else{

            $this->session->set_flashdata(
                'error',
                'Gagal memperbarui profil!'
            );
        }

        redirect($_SERVER['HTTP_REFERER']);
    }

    // ================= DAFTAR BUKU =================
    function buku(){

        $keyword = $this->input->get('cari');

        if($keyword){
            $this->db->group_start();
            $this->db->like('judul', $keyword);
            $this->db->or_like('pengarang', $keyword);
            $this->db->group_end();
        }

        $data['buku'] = $this->db->get('buku')->result();

        $this->load->view('user/buku', $data);
    }

    // ================= RIWAYAT =================
    function riwayat(){

        $user_id = $this->session->userdata('id');

        $this->db->select('transaksi.*, buku.judul');
        $this->db->from('transaksi');
        $this->db->join('buku', 'buku.id = transaksi.buku_id', 'left');
        $this->db->where('transaksi.user_id', $user_id);

        if($this->input->get('status')){
            $this->db->where(
                'transaksi.status',
                $this->input->get('status')
            );
        }

        $this->db->order_by('transaksi.id', 'DESC');

        $data['riwayat'] = $this->db->get()->result();

        $this->load->view('user/riwayat', $data);
    }

    // ================= PINJAM BUKU =================
    function pinjam($id){

        $user_id = $this->session->userdata('id');

        $buku = $this->db->get_where('buku', ['id'=>$id])->row();

        if(!$buku){
            $this->session->set_flashdata('error','Buku tidak ditemukan!');
            redirect('index.php/user/buku');
        }

        if($buku->stok <= 0){
            $this->session->set_flashdata('error','Stok buku habis!');
            redirect('index.php/user/buku');
        }

        // maksimal 3 buku aktif + menunggu
        $cek = $this->db->where('user_id', $user_id)
                        ->where_in('status', ['menunggu','dipinjam'])
                        ->count_all_results('transaksi');

        if($cek >= 3){
            $this->session->set_flashdata(
                'error',
                'Maksimal 3 buku (aktif / menunggu)'
            );
            redirect('index.php/user/buku');
        }

        // cegah pinjam buku sama dua kali sebelum selesai
        $cek_buku = $this->db->where('user_id', $user_id)
                             ->where('buku_id', $id)
                             ->where_in('status', ['menunggu','dipinjam'])
                             ->count_all_results('transaksi');

        if($cek_buku > 0){
            $this->session->set_flashdata(
                'error',
                'Buku ini masih dalam pengajuan / dipinjam.'
            );
            redirect('index.php/user/buku');
        }

        $data = [
            'user_id'        => $user_id,
            'buku_id'        => $id,
            'tanggal_pinjam' => date('Y-m-d'),
            'tanggal_kembali'=> NULL,
            'status'         => 'menunggu',
            'denda'          => 0
        ];

        $this->db->insert('transaksi', $data);

        $this->session->set_flashdata(
            'success',
            'Pengajuan peminjaman "'.$buku->judul.'" menunggu konfirmasi admin.'
        );

        $this->db->insert('notifikasi',[
    'role'  => 'admin',
    'judul' => 'Pengajuan Baru',
    'pesan' => $this->session->userdata('nama').' mengajukan pinjam buku '.$buku->judul
]);
        

        redirect('index.php/user/riwayat');
        
    }

    // ================= KEMBALI BUKU =================
    function kembali($id){

        $user_id = $this->session->userdata('id');

        $trx = $this->db->get_where('transaksi', [
            'id'      => $id,
            'user_id' => $user_id
        ])->row();

        if(!$trx){
            redirect('index.php/user/riwayat');
        }

        if($trx->status != 'dipinjam'){
            $this->session->set_flashdata(
                'error',
                'Buku belum disetujui admin / sudah selesai.'
            );
            redirect('index.php/user/riwayat');
        }

        $tgl_pinjam  = strtotime($trx->tanggal_pinjam);
        $tgl_kembali = strtotime(date('Y-m-d'));

        $selisih = ($tgl_kembali - $tgl_pinjam) / 86400;

        $denda = 0;

        if($selisih > 7){
            $terlambat = $selisih - 7;
            $denda = $terlambat * 1000;
        }

        $this->db->where('id', $id);
        $this->db->update('transaksi', [
            'status'          => 'dikembalikan',
            'tanggal_kembali' => date('Y-m-d'),
            'denda'           => $denda
        ]);

        // stok kembali
        $this->db->set('stok', 'stok+1', FALSE);
        $this->db->where('id', $trx->buku_id);
        $this->db->update('buku');

        $this->session->set_flashdata(
            'success',
            'Buku berhasil dikembalikan.'
        );

        redirect('index.php/user/riwayat');
    }

    // ================= CETAK KARTU =================
    public function cetak_kartu(){

        $id_user = $this->session->userdata('id');

        $data['user'] = $this->db->get_where('users', [
            'id'=>$id_user
        ])->row();

        $this->load->view('user/cetak_kartu', $data);
    }
}