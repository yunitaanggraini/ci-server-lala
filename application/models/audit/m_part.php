<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class M_Part extends CI_Model {

    public function getPart($id=null)
    {
        if ($id === null) {
            $this->db->select('part.*,nama_cabang, nama_lokasi');
            $this->db->from('part');
            $this->db->join('cabang', 'part.id_cabang = cabang.id_cabang', 'left');
            $this->db->join('lokasi', 'part.id_lokasi = lokasi.id_lokasi', 'left');
             
            $result = $this->db->get()->result();

            return $result;
        }else {
            $this->db->select('part.*,nama_cabang, nama_lokasi');
            $this->db->from('part');
            $this->db->join('cabang', 'part.id_cabang = cabang.id_cabang', 'left');
            $this->db->join('lokasi', 'part.id_lokasi = lokasi.id_lokasi', 'left');
            $this->db->where('id_part', $id);
            
            
            
            $result = $this->db->get()->result();

            return $result;
        }
        
    }

}

/* End of file M_Unit.php */
