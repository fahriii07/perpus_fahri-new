<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

    function __construct(){
        parent::__construct();

        $this->load->helper('url'); 
        $this->load->library('pdf'); 

        if($this->session->userdata('role') != 'admin'){
            redirect('index.php/auth');
        }
    }

    // ===============================
    // LAPORAN UTAMA (VIEW + FILTER)
    // ===============================
    function index(){

        $tgl_awal  = $this->input->get('tgl_awal');
        $tgl_akhir = $this->input->get('tgl_akhir');

        $this->db->select('transaksi.*, users.nama as nama_user, buku.judul');
        $this->db->from('transaksi');
        $this->db->join('users','users.id = transaksi.user_id','left');
        $this->db->join('buku','buku.id = transaksi.buku_id','left');

        // FILTER RANGE TANGGAL
        if(!empty($tgl_awal) && !empty($tgl_akhir)){
            $this->db->where('tanggal_pinjam >=', $tgl_awal);
            $this->db->where('tanggal_pinjam <=', $tgl_akhir);
        }

        $this->db->order_by('transaksi.id','DESC');

        $data['laporan']   = $this->db->get()->result();
        $data['tgl_awal']  = $tgl_awal;
        $data['tgl_akhir'] = $tgl_akhir;

        $this->load->view('admin/laporan', $data);
    }

    // ===============================
    // EXPORT PDF (HARIAN / BULANAN / TAHUNAN)
    // ===============================
    function export_pdf(){

        $jenis = $this->input->get('jenis');

        $this->db->select('transaksi.*, users.nama as nama_user, buku.judul');
        $this->db->from('transaksi');
        $this->db->join('users','users.id = transaksi.user_id','left');
        $this->db->join('buku','buku.id = transaksi.buku_id','left');

        // ======================
        // FILTER PDF
        // ======================
        if($jenis == 'harian'){
            $this->db->where('DATE(tanggal_pinjam)', date('Y-m-d'));

        } elseif($jenis == 'bulanan'){
            $this->db->where("DATE_FORMAT(tanggal_pinjam,'%Y-%m')", date('Y-m'));

        } elseif($jenis == 'tahunan'){
            $this->db->where("YEAR(tanggal_pinjam)", date('Y'));
        }

        $this->db->order_by('transaksi.id','DESC');

        $data['laporan'] = $this->db->get()->result();
        $data['jenis']   = $jenis;

        // ======================
        // GENERATE PDF
        // ======================
        $html = $this->load->view('admin/export_pdf', $data, true);

        $filename = 'Laporan_' . $jenis . '_' . date('Ymd');

        $this->pdf->generate($html, $filename . '.pdf', 'A4', 'landscape');
    }
}