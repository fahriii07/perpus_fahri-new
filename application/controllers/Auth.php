<?php
class Auth extends CI_Controller {

    // ================= HALAMAN LOGIN =================
    function index(){
        $this->load->view('login'); // WAJIB ADA
    }

    // ================= LOGIN =================
    function login(){

        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // VALIDASI
        if(empty($username) || empty($password)){
            $this->session->set_flashdata('error','Username & Password wajib diisi!');
            redirect('index.php/auth');
        }

        $user = $this->db->get_where('users', [
            'username' => $username
        ])->row();

        if($user){

            if($user->password == md5($password)){

                $this->session->set_userdata([
                    'id'   => $user->id,
                    'nama' => $user->nama,
                    'role' => $user->role
                ]);

                $this->session->set_flashdata('success','Login berhasil!');

                if($user->role == 'admin'){
                    redirect('index.php/admin');
                } else {
                    redirect('index.php/user');
                }

            } else {
                $this->session->set_flashdata('error','Password salah!');
                redirect('index.php/auth');
            }

        } else {
            $this->session->set_flashdata('error','Username tidak ditemukan!');
            redirect('index.php/auth');
        }
    }

    // ================= HALAMAN REGISTER =================
    function register(){
        $this->load->view('register');
    }

    // ================= PROSES REGISTER =================
    function proses_register(){

        $nama     = $this->input->post('nama');
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // VALIDASI
        if(empty($nama) || empty($username) || empty($password)){
            $this->session->set_flashdata('error','Semua field wajib diisi!');
            redirect('index.php/auth/register');
        }

        // CEK USERNAME
        $cek = $this->db->get_where('users', [
            'username' => $username
        ])->row();

        if($cek){
            $this->session->set_flashdata('error','Username sudah digunakan!');
            redirect('index.php/auth/register');
        }

        // SIMPAN
        $data = [
        'nama'     => $this->input->post('nama'),
        'username' => $this->input->post('username'),
        'password' => md5($this->input->post('password')),
        'role'     => 'user',

        // 🔥 INI YANG KEMARIN BELUM MASUK
        'kelas'    => $this->input->post('kelas'),
        'jurusan'  => $this->input->post('jurusan'),
        'kontak'   => $this->input->post('kontak'),
        'alamat'   => $this->input->post('alamat')
    ];

    $this->db->insert('users', $data);

    $this->session->set_flashdata('success','Register berhasil!');
    redirect('index.php/auth');
}

    // ================= LOGOUT =================
    function logout(){
        $this->session->sess_destroy();
        redirect('index.php/auth');
    }
}