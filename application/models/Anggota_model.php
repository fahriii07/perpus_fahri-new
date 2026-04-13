<?php
class Anggota_model extends CI_Model {

    function get_all(){
        $this->db->where('role','user');
        return $this->db->get('users')->result();
    }

    function insert($data){
        return $this->db->insert('users', $data);
    }

    function delete($id){
        return $this->db->delete('users', ['id'=>$id]);
    }
}