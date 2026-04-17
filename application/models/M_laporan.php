<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_laporan extends CI_Model {

    /**
     * Ambil data laporan transaksi + filter tanggal
     */
    public function get_laporan($tgl_awal = null, $tgl_akhir = null)
    {
        $this->db->select('transaksi.*, users.nama as nama_user, buku.judul');
        $this->db->from('transaksi');

        // JOIN users
        $this->db->join('users', 'users.id = transaksi.user_id', 'left');

        // JOIN buku
        $this->db->join('buku', 'buku.id = transaksi.buku_id', 'left');

        // FILTER tanggal (lebih aman pakai alias tabel)
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('transaksi.tanggal_pinjam >=', $tgl_awal);
            $this->db->where('transaksi.tanggal_pinjam <=', $tgl_akhir);
        }

        $this->db->order_by('transaksi.id', 'DESC');

        return $this->db->get()->result();
    }


    /**
     * Hitung total denda
     */
    public function get_total_denda($tgl_awal = null, $tgl_akhir = null)
    {
        $this->db->select_sum('denda');
        $this->db->from('transaksi');

        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('tanggal_pinjam >=', $tgl_awal);
            $this->db->where('tanggal_pinjam <=', $tgl_akhir);
        }

        $query = $this->db->get();
        $result = $query->row();

        return !empty($result->denda) ? $result->denda : 0;
    }
}