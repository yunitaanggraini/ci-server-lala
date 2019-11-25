<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class M_Unit extends CI_Model {

    public function getUnit($id=null)
    {
        if ($id === null) {
            $this->db->select('unit.*,nama_cabang, nama_lokasi');
            $this->db->from('unit');
            $this->db->join('cabang', 'unit.id_cabang = cabang.id_cabang', 'left');
            $this->db->join('lokasi', 'unit.id_lokasi = lokasi.id_lokasi', 'left');
             
            $result = $this->db->get()->result();

            return $result;
        }else {
            $this->db->select('unit.*,nama_cabang, nama_lokasi');
            $this->db->from('unit');
            $this->db->join('cabang', 'unit.id_cabang = cabang.id_cabang', 'left');
            $this->db->join('lokasi', 'unit.id_lokasi = lokasi.id_lokasi', 'left');
            $this->db->where('id_unit', $id);
            
            
            
            $result = $this->db->get()->result();

            return $result;
        }
        
    }

}

/* End of file M_Unit.php */
