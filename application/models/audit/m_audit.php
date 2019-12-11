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
            $this->db->order_by('keterangan', 'asc');
            
            
            $result = $this->db->get()->result();
            return $result;              
        }else {
            $this->db->select('jadwal_audit.*, jenis_audit, nama_cabang');
            $this->db->from('jadwal_audit');
            $this->db->join('jenis_audit', 'jadwal_audit.idjenis_audit = jenis_audit.idjenis_audit', 'left');
            $this->db->join('cabang', 'jadwal_audit.id_cabang = cabang.id_cabang', 'left');
            $this->db->order_by('keterangan', 'asc');
            $this->db->where('idjadwal_audit', $id);
            
            
            $result = $this->db->get()->result();
            return $result;
        }
    }
    public function cariAudit($id=null)
    {
        if ($id===null) {
            $this->db->select('jadwal_audit.*, jenis_audit, nama_cabang');
            $this->db->from('jadwal_audit');
            $this->db->join('jenis_audit', 'jadwal_audit.idjenis_audit = jenis_audit.idjenis_audit', 'left');
            $this->db->join('cabang', 'jadwal_audit.id_cabang = cabang.id_cabang', 'left');
            $this->db->order_by('keterangan', 'asc');
            
            
            $result = $this->db->get()->result();
            return $result;              
        }else {
            $this->db->select('a.*, jenis_audit, nama_cabang');
            $this->db->from('jadwal_audit a');
            $this->db->join('jenis_audit', 'a.idjenis_audit = jenis_audit.idjenis_audit', 'left');
            $this->db->join('cabang', 'a.id_cabang = cabang.id_cabang', 'left');
            $this->db->order_by('keterangan', 'asc');
            $this->db->where(" a.idjadwal_audit LIKE '%$id%' OR jenis_audit LIKE '%$id%' OR a.auditor LIKE '%$id%' OR nama_cabang  LIKE '%$id%'");
            
            
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
            $this->db->select('a.id_unit, a.no_mesin, a.no_rangka, a.type, a.tahun, a.kode_item, a.id_cabang, a.id_lokasi, b.nama_cabang, c.nama_lokasi');
            $this->db->from('temp_unit a');
            $this->db->join('cabang b', 'a.id_cabang = b.id_cabang', 'left');
            $this->db->join('lokasi c', 'a.id_lokasi = c.id_lokasi', 'left');
            
            $result = $this->db->get()->result();
            return $result;   
        }else {
            $this->db->select('a.id_unit, a.no_mesin, a.no_rangka, a.type, a.tahun, a.kode_item, a.id_cabang, a.id_lokasi, b.nama_cabang, c.nama_lokasi');
            $this->db->from('temp_unit a');
            $this->db->join('cabang b', 'a.id_cabang = b.id_cabang', 'left');
            $this->db->join('lokasi c', 'a.id_lokasi = c.id_lokasi', 'left');
            $this->db->where("a.no_mesin = '$id' OR a.no_rangka = '$id' AND a.id_cabang= '$cabang'" );
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
            $this->db->where("no_mesin = '$id' OR no_rangka = '$id'" );
            $this->db->update('unit', $data);
        return $this->db->affected_rows(); 
    }
    public function GetAuList($id = null,$cabang= null)
    {
        if ($id === null) {
            $this->db->select('
                a.id_unit, a.no_mesin, a.no_rangka, 
                a.type, a.tahun, a.kode_item, a.umur_unit, 
                a.id_cabang, a.id_lokasi, a.spion, a.tools, a.helm,
                a.buku_service, a.aki, a.status_unit, 
                b.nama_cabang, c.nama_lokasi
        
        ');
            $this->db->from('unit a');
            $this->db->join('cabang b', 'a.id_cabang = b.id_cabang', 'left');
            $this->db->join('lokasi c', 'a.id_lokasi = c.id_lokasi', 'left');
            $this->db->where('a.id_cabang', $cabang);
            
            return $this->db->get()->result();
        }else{
            $this->db->select('
                a.id_unit, a.no_mesin, a.no_rangka, 
                a.type, a.tahun, a.kode_item, a.umur_unit, 
                a.id_cabang, a.id_lokasi, a.spion, a.tools, a.helm,
                a.buku_service, a.aki, a.status_unit, 
                b.nama_cabang, c.nama_lokasi
        
        ');
            $this->db->from('unit a');
            $this->db->join('cabang b', 'a.id_cabang = b.id_cabang', 'left');
            $this->db->join('lokasi c', 'a.id_lokasi = c.id_lokasi', 'left');
            $this->db->where(" a.no_mesin = '$id' OR a.no_rangka = '$id'" );
            $this->db->where('a.id_cabang', $cabang);

            $result = $this->db->get()->result();
            return $result;
        }
    }
    public function GetListStatus($status = null,$cabang = null)
    {
        $this->db->select('
                a.id_unit, a.no_mesin, a.no_rangka, 
                a.type, a.tahun, a.kode_item, a.umur_unit, 
                a.id_cabang, a.id_lokasi, a.spion, a.tools, a.helm,
                a.buku_service, a.aki, a.status_unit, 
                b.nama_cabang, c.nama_lokasi
        
        ');
        $this->db->from('unit a');
        $this->db->join('cabang b', 'a.id_cabang = b.id_cabang', 'left');
        $this->db->join('lokasi c', 'a.id_lokasi = c.id_lokasi', 'left');
            $this->db->where("a.status_unit",$status);
            $this->db->like("a.id_cabang",$cabang);
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
            INSERT INTO unit (id_unit, no_mesin, no_rangka, id_cabang, id_lokasi, type, kode_item, tahun) 
            SELECT id_unit, no_mesin, no_rangka,id_cabang, id_lokasi, type, kode_item, tahun
            FROM temp_unit a 
            WHERE a.no_rangka NOT IN (
                SELECT no_rangka FROM unit)
                AND at.id_cabang='$cabang'
        ";
        $this->db->query($query);
        $query2 = "
            UPDATE unit a
            SET status_unit = 'Belum ditemukan'
            WHERE status_unit is null AND a.id_cabang = '$cabang'
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

    

}
}
?>