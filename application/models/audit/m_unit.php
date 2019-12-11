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
    public function getUnitReady($id = null, $cabang= null)
    {
        if ($id===null) {
            $this->db->select('a.no_mesin, a.no_rangka, a.part_number, a.kondisi, a.keterangan, a.penanggung_jawab');
            $this->db->from('unit_ready a');
            
            $this->db->where('a.id_cabang', $cabang);
            $result = $this->db->get()->result();
            return $result;
        }else{
            $this->db->select('a.no_mesin, a.no_rangka, a.part_number, a.kondisi, a.keterangan, a.penanggung_jawab');
            $this->db->from('unit_ready a');
            $this->db->where('a.id_cabang', $cabang);
            $this->db->where("a.no_mesin LIKE '%$id%' OR a.no_rangka LIKE '%$id%' OR a.part_number LIKE '%$id%'");
            $result = $this->db->get()->result();
            return $result;
        }
    }

    public function addUnitReady($data)
    {
        $this->db->insert('unit_ready', $data);
        return $this->db->affected_rows();  
    }

    public function getCariUnitNrfs($id =null, $cabang = null)
    {
        if ($id === null) {
            $this->db->select('a.no_mesin, a.no_rangka, a.part_number, a.kondisi, a.penanggung_jawab, a.keterangan, a.id_cabang, a.id_lokasi ');
            $this->db->from('unit_ready a');
            $result = $this->db->get()->result();

            return $result;
        }else {
            $this->db->select('a.no_mesin, a.no_rangka, a.part_number, a.kondisi, a.penanggung_jawab, a.keterangan, a.id_cabang, a.id_lokasi ');
            $this->db->from('unit_ready a');
            $this->db->where("a.no_mesin LIKE '%$id%' OR a.no_rangka LIKE '%$id%' OR a.part_number LIKE '%$id%' AND a.id_cabang='$cabang'");
            
            $result = $this->db->get()->result();

            return $result;
        }
    }

}

/* End of file M_Unit.php */
