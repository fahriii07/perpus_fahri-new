<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota extends CI_Controller {

    function __construct(){
        parent::__construct();

        // Proteksi admin
        if($this->session->userdata('role') != 'admin'){
            redirect('index.php/auth');
        }
    }

    // 🔥 TAMPIL DATA ANGGOTA
    function index(){
        $data['anggota'] = $this->db
            ->where('role','user')
            ->get('users')
            ->result();

        $this->load->view('admin/anggota', $data);
    }

    // 🔥 FORM TAMBAH ANGGOTA
    function tambah(){
        $this->load->view('admin/tambah_anggota');
    }

    // 🔥 SIMPAN ANGGOTA
    function simpan(){
        // Validasi Username Unik
        $cek = $this->db->get_where('users', [
            'username' => $this->input->post('username')
        ])->row();

        if($cek){
            $this->session->set_flashdata('error','Username sudah digunakan!');
            redirect('index.php/anggota/tambah');
        }

        $data = [
            'nama'     => $this->input->post('nama'),
            'username' => $this->input->post('username'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'role'     => 'user',
            'kelas'    => $this->input->post('kelas'),
            'jurusan'  => $this->input->post('jurusan'),
            'kontak'   => $this->input->post('kontak'),
            'alamat'   => $this->input->post('alamat')
        ];

        $this->db->insert('users', $data);
        $this->session->set_flashdata('success','Anggota berhasil ditambahkan');
        redirect('index.php/anggota');
    }

    // 🔥 DETAIL ANGGOTA
    function detail($id){
        $data['anggota'] = $this->db->get_where('users', ['id' => $id])->row();
        
        if(!$data['anggota']){
            show_404();
        }

        $this->load->view('admin/detail_anggota', $data);
    }

    // 🔥 FORM EDIT ANGGOTA
    function edit($id){
        $data['anggota'] = $this->db->get_where('users', ['id' => $id])->row();
        
        if(!$data['anggota']){
            show_404();
        }

        $this->load->view('admin/edit_anggota', $data);
    }

    // 🔥 PROSES UPDATE ANGGOTA
    function proses_update(){
        $id = $this->input->post('id');
        
        $data = [
            'nama'    => $this->input->post('nama'),
            'kelas'   => $this->input->post('kelas'),
            'jurusan' => $this->input->post('jurusan'),
            'kontak'  => $this->input->post('kontak'),
            'alamat'  => $this->input->post('alamat')
        ];

        // Update password hanya jika diisi (opsional)
        if($this->input->post('password')){
            $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        }

        $this->db->where('id', $id);
        $this->db->update('users', $data);

        $this->session->set_flashdata('success', 'Data anggota berhasil diperbarui');
        redirect('index.php/anggota');
    }

    // 🔥 HAPUS ANGGOTA
    function hapus($id){
        // Mencegah admin menghapus dirinya sendiri atau admin lain melalui menu ini
        $user = $this->db->get_where('users', ['id' => $id])->row();

        if($user && $user->role == 'admin'){
            $this->session->set_flashdata('error','Admin tidak bisa dihapus!');
            redirect('index.php/anggota');
        }

        $this->db->delete('users', ['id' => $id]);
        $this->session->set_flashdata('success','Anggota berhasil dihapus');
        redirect('index.php/anggota');
    }
}