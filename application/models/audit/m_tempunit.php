<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_TempUnit extends CI_Model {

    public function getTempUnit($id=null)
    {
        if ($id === null) {
            $this->db->select('temp_unit.*, nama_lokasi');
            $this->db->from('temp_unit');
            $this->db->join('lokasi', 'temp_unit.id_lokasi = lokasi.id_lokasi', 'left');
             
            $result = $this->db->get()->result();

            return $result;
        }else {
            $this->db->select('temp_unit.*, nama_lokasi');
            $this->db->from('temp_unit');
            $this->db->join('lokasi', 'temp_unit.id_lokasi = lokasi.id_lokasi', 'left');
            $this->db->where('id_unit', $id);
            
            
            
            $result = $this->db->get()->result();

            return $result;
        }
        
    }
}