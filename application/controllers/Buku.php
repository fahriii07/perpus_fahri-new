<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends CI_Controller {

    function __construct(){
        parent::__construct();

        $this->load->library(['form_validation', 'upload']);

        // ===== SAFE SESSION CHECK =====
        $role = $this->session->userdata('role');

        if(empty($role)){
            redirect('auth');
            exit;
        }

        if($role != 'admin'){
            redirect('auth');
            exit;
        }
    }

    // ================= LIST =================
    function index(){
        $data['buku'] = $this->db->get('buku')->result();
        $this->load->view('admin/buku', $data);
    }

    // ================= TAMBAH =================
    function tambah(){
        $data['old'] = $this->session->flashdata('old') ?? [];
        $this->load->view('admin/tambah_buku', $data);
    }

    // ================= SIMPAN =================
    function simpan(){

        $this->form_validation->set_rules('judul', 'Judul Buku', 'required|trim');
        $this->form_validation->set_rules('pengarang', 'Pengarang', 'required|trim');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');

        $old = $this->input->post();

        if($this->form_validation->run() == FALSE){

            $this->session->set_flashdata('old', $old);
            $data['old'] = $old;

            $this->load->view('admin/tambah_buku', $data);
            return;
        }

        $cover = null;

        if(!empty($_FILES['cover']['name'])){
            $cover = $this->_upload_cover();
        }

        $data = [
            'judul'     => $this->input->post('judul', true),
            'pengarang' => $this->input->post('pengarang', true),
            'stok'      => $this->input->post('stok', true),
            'cover'     => $cover
        ];

        $this->db->insert('buku', $data);

        redirect('buku');
    }

    // ================= EDIT =================
    function edit($id){

        $data['buku'] = $this->db->get_where('buku', ['id'=>$id])->row();

        if(!$data['buku']){
            redirect('buku');
            exit;
        }

        $data['old'] = [];
        $this->load->view('admin/edit_buku', $data);
    }

    // ================= UPDATE =================
    function update(){

        $id = $this->input->post('id');
        $buku = $this->db->get_where('buku', ['id'=>$id])->row();

        if(!$buku){
            redirect('buku');
            exit;
        }

        $this->form_validation->set_rules('judul', 'Judul Buku', 'required|trim');
        $this->form_validation->set_rules('pengarang', 'Pengarang', 'required|trim');
        $this->form_validation->set_rules('stok', 'Stok', 'required|numeric');

        $old = $this->input->post();

        if($this->form_validation->run() == FALSE){

            $data['buku'] = $buku;
            $data['old']  = $old;

            $this->load->view('admin/edit_buku', $data);
            return;
        }

        $data = [
            'judul'     => $this->input->post('judul', true),
            'pengarang' => $this->input->post('pengarang', true),
            'stok'      => $this->input->post('stok', true)
        ];

        if(!empty($_FILES['cover']['name'])){
            $data['cover'] = $this->_upload_cover();

            if(!empty($buku->cover) && file_exists('./assets/img/cover/'.$buku->cover)){
                unlink('./assets/img/cover/'.$buku->cover);
            }
        }

        $this->db->where('id', $id);
        $this->db->update('buku', $data);

        redirect('buku');
    }

    // ================= HAPUS =================
    function hapus($id){

        $buku = $this->db->get_where('buku', ['id'=>$id])->row();

        if($buku){

            if(!empty($buku->cover) && file_exists('./assets/img/cover/'.$buku->cover)){
                unlink('./assets/img/cover/'.$buku->cover);
            }

            $this->db->where('id', $id);
            $this->db->delete('buku');
        }

        redirect('buku');
    }

    // ================= UPLOAD =================
    private function _upload_cover(){

        if(!is_dir('./assets/img/cover/')){
            mkdir('./assets/img/cover/', 0777, true);
        }

        $config['upload_path']   = './assets/img/cover/';
        $config['allowed_types'] = 'jpg|jpeg|png|webp';
        $config['max_size']      = 2048;
        $config['encrypt_name']  = TRUE;

        $this->upload->initialize($config);

        if($this->upload->do_upload('cover')){
            return $this->upload->data('file_name');
        }

        return null;
    }
}