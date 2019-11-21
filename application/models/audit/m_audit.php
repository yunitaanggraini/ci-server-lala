<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Audit extends CI_Model {

    public function getAudit($id=null)
    {
        if ($id===null) {
            $this->db->select('jadwal_audit.*, jenis_audit, nama_cabang');
            $this->db->from('jadwal_audit');
            $this->db->join('jenis_audit', 'jadwal_audit.idjenis_audit = jenis_audit.idjenis_audit', 'left');
            $this->db->join('cabang', 'jadwal_audit.id_cabang = cabang.id_cabang', 'left');
            
            $result = $this->db->get()->result();
            return $result;              
        }else {
            $this->db->select('jadwal_audit.*, jenis_audit, nama_cabang');
            $this->db->from('jadwal_audit');
            $this->db->join('jenis_audit', 'jadwal_audit.idjenis_audit = jenis_audit.idjenis_audit', 'left');
            $this->db->join('cabang', 'jadwal_audit.id_cabang = cabang.id_cabang', 'left');
            
            $result = $this->db->get()->result();
            return $result;
        }
    }
    public function addAudit($data)
    {
        $this->db->insert('jadwal_audit', $data);
        return $this->db->affected_rows();  
    }
    public function editAudit($data,$id)
    {
        $this->db->where('idjadwal_audit', $id);
        $this->db->update('jadwal_audit', $data);
        return $this->db->affected_rows(); 
    }
    public function delAudit($id)
    {
       $this->db->where('idjadwal_audit', $id);
       $this->db->delete('jadwal_audit');  
       return $this->db->affected_rows();
    }

    public function GetList($id = null)
    {
        if ($id===null) {
            $result = $this->db->get('temp_unit')->result();
            return $result;   
        }else {
            $this->db->where("id_unit = '$id' OR no_mesin = '$id' OR no_rangka = '$id'" );
            $result = $this->db->get('temp_unit')->result();
            return $result;
        }
        
        
    }

    public function AddList($data)
    {
        $this->db->insert('unit', $data);
        return $this->db->affected_rows(); 
    }
    public function GetAuList($id = null)
    {
        if ($id === null) {
            return $this->db->get('unit')->result();
        }else{
            $this->db->where("id_unit = '$id' OR no_mesin = '$id' OR no_rangka = '$id'" );
            $result = $this->db->get('unit')->result();
            return $result;
        }
    }
}
?>