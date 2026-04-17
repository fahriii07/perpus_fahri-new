<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    // ================= HALAMAN LOGIN =================
    public function index(){
        $this->load->view('login');
    }

    // ================= LOGIN =================
    public function login(){

        $username = trim($this->input->post('username'));
        $password = $this->input->post('password');

        if(empty($username) || empty($password)){
            $this->session->set_flashdata('error','Username & Password wajib diisi!');
            redirect('index.php/auth');
        }

        $user = $this->db->get_where('users', [
            'username' => $username
        ])->row();

        if(!$user){
            $this->session->set_flashdata('error','Username tidak ditemukan!');
            redirect('index.php/auth');
        }

        $login_valid = false;

        // ================= PASSWORD HASH MODERN =================
        if(password_verify($password, $user->password)){
            $login_valid = true;
        }

        // ================= MIGRASI DARI MD5 LAMA =================
        elseif($user->password == md5($password)){

            $hashBaru = password_hash($password, PASSWORD_DEFAULT);

            $this->db->where('id', $user->id);
            $this->db->update('users', [
                'password' => $hashBaru
            ]);

            $login_valid = true;
        }

        if($login_valid){

            $this->session->set_userdata([
                'id'   => $user->id,
                'nama' => $user->nama,
                'role' => $user->role
            ]);

            $this->session->set_flashdata('success','Login berhasil!');

            if($user->role == 'admin'){
                redirect('index.php/admin');
            }else{
                redirect('index.php/user');
            }

        }else{
            $this->session->set_flashdata('error','Password salah!');
            redirect('index.php/auth');
        }
    }

    // ================= HALAMAN REGISTER =================
    public function register(){
        $this->load->view('register');
    }

    // ================= PROSES REGISTER =================
    public function proses_register(){

        $nama     = trim($this->input->post('nama'));
        $username = trim($this->input->post('username'));
        $password = $this->input->post('password');

        if(empty($nama) || empty($username) || empty($password)){
            $this->session->set_flashdata('error','Semua field wajib diisi!');
            redirect('index.php/auth/register');
        }

        $cek = $this->db->get_where('users', [
            'username' => $username
        ])->row();

        if($cek){
            $this->session->set_flashdata('error','Username sudah digunakan!');
            redirect('index.php/auth/register');
        }

        // ================= HASH PASSWORD =================
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);

        $data = [
            'nama'     => $nama,
            'username' => $username,
            'password' => $hashPassword,
            'role'     => 'user',
            'kelas'    => $this->input->post('kelas'),
            'jurusan'  => $this->input->post('jurusan'),
            'kontak'   => $this->input->post('kontak'),
            'alamat'   => $this->input->post('alamat')
        ];

        $this->db->insert('users', $data);

        $this->session->set_flashdata('success','Register berhasil! Silakan login.');
        redirect('index.php/auth');
    }

    // ================= GANTI PASSWORD =================
    public function ganti_password(){

        $id       = $this->session->userdata('id');
        $lama     = $this->input->post('password_lama');
        $baru     = $this->input->post('password_baru');
        $konfirm  = $this->input->post('konfirmasi_password');

        if(!$id){
            redirect('index.php/auth');
        }

        if(empty($lama) || empty($baru) || empty($konfirm)){
            $this->session->set_flashdata('error','Semua field password wajib diisi!');
            redirect($_SERVER['HTTP_REFERER']);
        }

        if($baru != $konfirm){
            $this->session->set_flashdata('error','Konfirmasi password tidak cocok!');
            redirect($_SERVER['HTTP_REFERER']);
        }

        $user = $this->db->get_where('users', ['id'=>$id])->row();

        $valid = false;

        if(password_verify($lama, $user->password)){
            $valid = true;
        }elseif($user->password == md5($lama)){
            $valid = true;
        }

        if(!$valid){
            $this->session->set_flashdata('error','Password lama salah!');
            redirect($_SERVER['HTTP_REFERER']);
        }

        $hashBaru = password_hash($baru, PASSWORD_DEFAULT);

        $this->db->where('id',$id);
        $this->db->update('users', [
            'password' => $hashBaru
        ]);

        $this->session->set_flashdata('success','Password berhasil diubah!');
        redirect($_SERVER['HTTP_REFERER']);
    }

    // ================= LOGOUT =================
    public function logout(){
        $this->session->sess_destroy();
        redirect('index.php/auth');
    }
}