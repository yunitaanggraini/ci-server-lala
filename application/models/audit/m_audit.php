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
    public function editAuditket($data,$id)
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

    public function GetauditBefore($id = null)
    {
        if ($id === null) {
            $where = "temp_unit.no_rangka NOT IN (SELECT no_rangka FROM unit)";
            $this->db->where($where);
            return $this->db->get('temp_unit')->result();
        }else {
            $where = "temp_unit.no_rangka NOT IN (SELECT no_rangka FROM unit) AND (temp_unit.id_unit = '$id' OR temp_unit.no_mesin='$id' OR temp_unit.no_rangka='$id')";
            $this->db->where($where);
            return $this->db->get('temp_unit')->result();
        }
    }
    public function AuditEnd()
    {
        $query = "
            INSERT INTO unit (id_unit, no_mesin, no_rangka) 
            SELECT id_unit, no_mesin, no_rangka 
            FROM temp_unit 
            WHERE temp_unit.no_rangka NOT IN (
                SELECT no_rangka FROM unit)
        ";
        $this->db->query($query);
        $query2 = "
            UPDATE unit 
            SET status_unit = 'Tidak ditemukan'
            WHERE status_unit is null
        ";
        $this->db->query($query2);
        return  $this->db->affected_rows();
    }
}
?>