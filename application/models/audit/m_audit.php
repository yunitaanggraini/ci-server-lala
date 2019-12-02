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

    public function GetList($id = null, $cabang = null)
    {
        if ($id===null) {
            $this->db->select('temp_unit.*, nama_cabang, nama_lokasi');
            $this->db->from('temp_unit');
            $this->db->join('cabang', 'temp_unit.id_cabang = cabang.id_cabang', 'left');
            $this->db->join('lokasi', 'temp_unit.id_lokasi = lokasi.id_lokasi', 'left');
            
            $result = $this->db->get()->result();
            return $result;   
        }else {
            $this->db->select('temp_unit.*, nama_cabang, nama_lokasi');
            $this->db->from('temp_unit');
            $this->db->join('cabang', 'temp_unit.id_cabang = cabang.id_cabang', 'left');
            $this->db->join('lokasi', 'temp_unit.id_lokasi = lokasi.id_lokasi', 'left');
            $this->db->where("id_unit = '$id' OR no_mesin = '$id' OR no_rangka = '$id' AND temp_unit.id_cabang= '$cabang'" );
            $result = $this->db->get()->result();
            return $result;
        }
        
        
    }

    public function AddList($data)
    {
        $this->db->insert('unit', $data);
        return $this->db->affected_rows(); 
    }
    public function EditList($id,$data)
    {
            $this->db->where("id_unit = '$id' OR no_mesin = '$id' OR no_rangka = '$id'" );
            $this->db->update('unit', $data);
        return $this->db->affected_rows(); 
    }
    public function GetAuList($id = null)
    {
        if ($id === null) {
            $this->db->select('unit.*, nama_cabang, nama_lokasi');
            $this->db->from('unit');
            $this->db->join('cabang', 'unit.id_cabang = cabang.id_cabang', 'left');
            $this->db->join('lokasi', 'unit.id_lokasi = lokasi.id_lokasi', 'left');
            return $this->db->get()->result();
        }else{
            $this->db->select('unit.*, nama_cabang, nama_lokasi');
            $this->db->from('unit');
            $this->db->join('cabang', 'unit.id_cabang = cabang.id_cabang', 'left');
            $this->db->join('lokasi', 'unit.id_lokasi = lokasi.id_lokasi', 'left');
            $this->db->where("id_unit = '$id' OR no_mesin = '$id' OR no_rangka = '$id'" );
            $result = $this->db->get()->result();
            return $result;
        }
    }
    public function GetListStatus($status = null)
    {
            $this->db->select('unit.*, nama_cabang, nama_lokasi');
            $this->db->from('unit');
            $this->db->join('cabang', 'unit.id_cabang = cabang.id_cabang', 'left');
            $this->db->join('lokasi', 'unit.id_lokasi = lokasi.id_lokasi', 'left');
            $this->db->like("status_unit",$status);
            $result = $this->db->get()->result();
            return $result;
    }

    public function GetauditBefore($id = null, $cabang=null)
    {
        if ($id === null) {
            $where = "temp_unit.no_rangka NOT IN (SELECT no_rangka FROM unit) AND id_cabang='$cabang'";
            $this->db->where($where);
            return $this->db->get('temp_unit')->result();
        }else {
            $where = "temp_unit.no_rangka NOT IN (SELECT no_rangka FROM unit) AND (temp_unit.id_unit = '$id' OR temp_unit.no_mesin='$id' OR temp_unit.no_rangka='$id' AND temp_unit.id_cabang='$cabang')";
            $this->db->where($where);
            return $this->db->get('temp_unit')->result();
        }
    }
    public function AuditEnd($cabang)
    {
        $query = "
            INSERT INTO unit (id_unit, no_mesin, no_rangka, id_cabang, id_lokasi) 
            SELECT id_unit, no_mesin, no_rangka,id_cabang, id_lokasi
            FROM temp_unit 
            WHERE temp_unit.no_rangka NOT IN (
                SELECT no_rangka FROM unit)
                AND temp_unit.id_cabang='$cabang'
        ";
        $this->db->query($query);
        $query2 = "
            UPDATE unit 
            SET status_unit = 'Tidak ditemukan'
            WHERE status_unit is null AND unit.id_cabang = '$cabang'
        ";
        $this->db->query($query2);
        return  $this->db->affected_rows();
    }



    public function cariJadwalAudit($auditor=null, $tanggal_audit=null, $jenis_audit=null)
    {
        if ($auditor!=null && $tanggal_audit!=null && $jenis_audit!=null) {
            $this->db->select('jadwal_audit.*, jenis_audit, nama_cabang');
            $this->db->from('jadwal_audit');
            $this->db->join('jenis_audit', 'jadwal_audit.idjenis_audit = jenis_audit.idjenis_audit', 'left');
            $this->db->join('cabang', 'jadwal_audit.id_cabang = cabang.id_cabang', 'left');
            $this->db->like('auditor', $auditor);
            $this->db->like('tanggal_audit', $tanggal_audit);
            $this->db->like('jenis_audit', $jenis_audit);
            
            $result = $this->db->get()->result();

            return $result;
        }elseif ($auditor!=null && $tanggal_audit=null && $jenis_audit=null) {
            $this->db->select('jadwal_audit.*, jenis_audit, nama_cabang');
            $this->db->from('jadwal_audit');
            $this->db->join('jenis_audit', 'jadwal_audit.idjenis_audit = jenis_audit.idjenis_audit', 'left');
            $this->db->join('cabang', 'jadwal_audit.id_cabang = cabang.id_cabang', 'left');
            $this->db->like('auditor', $auditor);
            
            $result = $this->db->get()->result();
            return $result;
            
        }elseif ($auditor=null && $tanggal_audit!=null && $jenis_audit=null) {
            $this->db->select('jadwal_audit.*, jenis_audit, nama_cabang');
            $this->db->from('jadwal_audit');
            $this->db->join('jenis_audit', 'jadwal_audit.idjenis_audit = jenis_audit.idjenis_audit', 'left');
            $this->db->join('cabang', 'jadwal_audit.id_cabang = cabang.id_cabang', 'left');
            $this->db->like('tanggal_audit', $tanggal_audit);
            
            $result = $this->db->get()->result();
            return $result;
            
        }elseif ($auditor=null && $tanggal_audit=null && $jenis_audit!=null) {
            $this->db->select('jadwal_audit.*, jenis_audit, nama_cabang');
            $this->db->from('jadwal_audit');
            $this->db->join('jenis_audit', 'jadwal_audit.idjenis_audit = jenis_audit.idjenis_audit', 'left');
            $this->db->join('cabang', 'jadwal_audit.id_cabang = cabang.id_cabang', 'left');
            $this->db->like('jenis_audit', $jenis_audit);
            
            $result = $this->db->get()->result();
            return $result;
        
    }
    
}}
?>