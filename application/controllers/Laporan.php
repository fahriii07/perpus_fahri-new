<?php
class Laporan extends CI_Controller {

    function __construct(){
        parent::__construct();

        if($this->session->userdata('role') != 'admin'){
            redirect('index.php/auth');
        }
    }

    function index(){

        $tgl_awal  = $this->input->get('tgl_awal');
        $tgl_akhir = $this->input->get('tgl_akhir');
        $export    = $this->input->get('export'); // 🔥 TAMBAHAN

        $this->db->select('transaksi.*, users.nama as nama_user, buku.judul');
        $this->db->from('transaksi');
        $this->db->join('users','users.id = transaksi.user_id','left');
        $this->db->join('buku','buku.id = transaksi.buku_id','left');

        // 🔥 FILTER TANGGAL
        if($tgl_awal && $tgl_akhir){
            $this->db->where('tanggal_pinjam >=', $tgl_awal);
            $this->db->where('tanggal_pinjam <=', $tgl_akhir);
        }

        $this->db->order_by('transaksi.id','DESC');

        $data['laporan'] = $this->db->get()->result();
        $data['tgl_awal'] = $tgl_awal;
        $data['tgl_akhir'] = $tgl_akhir;

        // 🔥 EXPORT EXCEL
        if($export == 'excel'){

            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=Laporan_Transaksi_" . date('Ymd') . ".xls");

            $this->load->view('admin/export_excel', $data);
            return;
        }

        // 🔥 VIEW NORMAL
        $this->load->view('admin/laporan', $data);
    }
}