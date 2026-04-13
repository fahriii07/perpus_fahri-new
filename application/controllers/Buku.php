<?php
class Buku extends CI_Controller {

    function __construct(){
        parent::__construct();

        // proteksi login admin
        if($this->session->userdata('role') != 'admin'){
            redirect('index.php/auth');
        }
    }

    // ================= LIST BUKU =================
    function index(){
        $data['buku'] = $this->db->get('buku')->result();
        $this->load->view('admin/buku', $data);
    }

    // ================= TAMBAH =================
    function tambah(){
        $this->load->view('admin/tambah_buku');
    }

    function simpan(){
        $data = [
            'judul' => $this->input->post('judul'),
            'pengarang' => $this->input->post('pengarang'),
            'stok' => $this->input->post('stok')
        ];

        $this->db->insert('buku', $data);

        redirect('index.php/buku');
    }

    // ================= EDIT =================
    function edit($id){
        $data['buku'] = $this->db->get_where('buku',['id'=>$id])->row();
        $this->load->view('admin/edit_buku', $data);
    }

    function update(){
        $id = $this->input->post('id');

        $data = [
            'judul' => $this->input->post('judul'),
            'pengarang' => $this->input->post('pengarang'),
            'stok' => $this->input->post('stok')
        ];

        $this->db->where('id',$id);
        $this->db->update('buku', $data);

        redirect('index.php/buku');
    }

    // ================= HAPUS =================
    function hapus($id){
        $this->db->where('id',$id);
        $this->db->delete('buku');

        redirect('index.php/buku');
    }
}