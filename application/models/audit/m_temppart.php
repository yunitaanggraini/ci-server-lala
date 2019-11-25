<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_TempPart extends CI_Model {

    public function getTempPart($id=null)
    {
        if ($id === null) {
            $this->db->select('temp_part.*,nama_cabang, nama_lokasi');
            $this->db->from('temp_part');
            $this->db->join('cabang', 'temp_part.id_cabang = cabang.id_cabang', 'left');
            $this->db->join('lokasi', 'temp_part.id_lokasi = lokasi.id_lokasi', 'left');
             
            $result = $this->db->get()->result();

            return $result;
        }else {
            $this->db->select('temp_part.*,nama_cabang, nama_lokasi');
            $this->db->from('temp_part');
            $this->db->join('cabang', 'temp_part.id_cabang = cabang.id_cabang', 'left');
            $this->db->join('lokasi', 'temp_part.id_lokasi = lokasi.id_lokasi', 'left');
            $this->db->where('id_part', $id);
            
            
            
            $result = $this->db->get()->result();

            return $result;
        }
        
    }

}