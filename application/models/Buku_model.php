<?php
class Buku_model extends CI_Model {

    function get_all(){
        return $this->db->get('buku')->result();
    }

    function insert($data){
        $this->db->insert('buku',$data);
    }

    function delete($id){
        $this->db->delete('buku',['id'=>$id]);
    }
}