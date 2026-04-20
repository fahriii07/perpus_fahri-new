<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notifikasi extends CI_Controller {

    function get_admin(){
        $data = $this->db
        ->where('role','admin')
        ->where('status','baru')
        ->order_by('id','DESC')
        ->get('notifikasi')
        ->result();

        echo json_encode($data);
    }

    function get_user(){
        $id = $this->session->userdata('id');

        $data = $this->db
        ->where('role','user')
        ->where('user_id',$id)
        ->where('status','baru')
        ->order_by('id','DESC')
        ->get('notifikasi')
        ->result();

        echo json_encode($data);
    }

    function read_admin(){
        $this->db->where('role','admin')->update('notifikasi',['status'=>'dibaca']);
    }

    function read_user(){
        $id = $this->session->userdata('id');
        $this->db->where('user_id',$id)->update('notifikasi',['status'=>'dibaca']);
    }
}