<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class M_aksesoris extends CI_Model{
        public function getAksesoris($id=null)
        {
            if ($id === null) {
                $this->db->select('aksesoris.*, nama_cabang, nama_lokasi ');
                $this->db->from('aksesoris');
                $this->db->join('lokasi', 'aksesoris.id_lokasi = lokasi.id_lokasi', 'left');
                $this->db->join('cabang', 'aksesoris.id_cabang = cabang.id_cabang', 'left');
  
                $result = $this->db->get()->result();
    
                return $result;
            }else {
                $this->db->select('aksesoris.*, nama_cabang, nama_lokasi ');
                $this->db->from('aksesoris');
                $this->db->join('lokasi', 'aksesoris.id_lokasi = lokasi.id_lokasi', 'left');
                $this->db->join('cabang', 'aksesoris.id_cabang = cabang.id_cabang', 'left');
                                
                $result = $this->db->get()->result();
    
                return $result;
            }
            
        }

        public function addAksesoris($data)
        {
            $result = $this->db->insert('aksesoris',$data); 
            return $result;
        }

        public function editAksesoris($data,$id)
        {
            $this->db->where('id_aksesoris', $id);
            $this->db->update('aksesoris', $data);  
            return $this->db->affected_rows();
        }

        public function delAksesoris($id_aksesoris)
        {
            $this->db->where('id_aksesoris', $id_aksesoris);
            $this->db->delete('aksesoris');
            return $this->db->affected_rows();
            
    }

    }

    
    /* End of file Controllername.php */
    
?>