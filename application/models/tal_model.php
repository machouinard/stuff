<?php

class Tal_model extends CI_Model{



    function db_insert($data){
        $this->db->insert('podcasts', $data);
        return $this->db->insert_id();
    }



}




?>