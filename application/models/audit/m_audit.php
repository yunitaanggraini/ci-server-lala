<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Audit extends CI_Model {

    public function getAudit($id=null,$offset=null)
    {
        if ($id===null) {
            $this->db->select('jadwal_audit.*, jenis_audit, nama_cabang');
            $this->db->from('jadwal_audit');
            $this->db->join('jenis_audit', 'jadwal_audit.idjenis_audit = jenis_audit.idjenis_audit', 'left');
            $this->db->join('cabang', 'jadwal_audit.id_cabang = cabang.id_cabang', 'left');
            $this->db->limit(15);
            $this->db->offset($offset);
            $this->db->order_by('keterangan', 'asc');
            
            
            $result = $this->db->get()->result();
            return $result;              
        }else {
            $this->db->select('jadwal_audit.*, jenis_audit, nama_cabang');
            $this->db->from('jadwal_audit');
            $this->db->join('jenis_audit', 'jadwal_audit.idjenis_audit = jenis_audit.idjenis_audit', 'left');
            $this->db->join('cabang', 'jadwal_audit.id_cabang = cabang.id_cabang', 'left');
            $this->db->limit(15);
            $this->db->offset($offset);
            $this->db->order_by('keterangan', 'asc');
            $this->db->where('idjadwal_audit', $id);
            
            
            $result = $this->db->get()->result();
            return $result;
        }
    }
    public function cariAudit($id)
    {
        $cari ="
                SELECT a.idjadwal_audit, a.auditor, a.tanggal, a.waktu, a.id_cabang, b.nama_cabang,
                a.idjenis_audit, c.jenis_audit, a.keterangan
                FROM jadwal_audit a
                LEFT JOIN cabang b ON a.id_cabang=b.id_cabang
                LEFT JOIN jenis_audit c ON a.idjenis_audit=c.idjenis_audit
                WHERE a.idjadwal_audit LIKE '%$id%'
                OR a.auditor LIKE '%$id%'
                OR a.tanggal LIKE '%$id%'
                OR a.waktu LIKE '%$id%'
                OR a.id_cabang LIKE '%$id%'
                OR b.nama_cabang LIKE '%$id%'
                OR a.idjenis_audit LIKE '%$id%'
                OR c.jenis_audit LIKE '%$id%'
                OR a.keterangan LIKE '%$id%'
        ";
            
            $result = $this->db->query($cari)->result();
            return $result;
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
            $this->db->where('a.id_cabang', $cabang);
            $this->db->where("(a.no_mesin = '$id' OR a.no_rangka = '$id')" );
            
            $result = $this->db->get()->result();
            return $result;
        }   
    }
    public function GetListPart($id = null, $cabang = null)
    {
        if ($id===null) {
            $this->db->select('a.*, b.nama_cabang, c.nama_lokasi');
            $this->db->from('temp_part a');
            $this->db->join('cabang b', 'a.id_cabang = b.id_cabang', 'left');
            $this->db->join('lokasi c', 'a.id_lokasi = c.id_lokasi', 'left');
            
            $result = $this->db->get()->result();
            return $result;   
        }else {
            $this->db->select('a.*, b.nama_cabang, c.nama_lokasi');
            $this->db->from('temp_part a');
            $this->db->join('cabang b', 'a.id_cabang = b.id_cabang', 'left');
            $this->db->join('lokasi c', 'a.id_lokasi = c.id_lokasi', 'left');
            $this->db->where('a.id_cabang', $cabang);
            $this->db->where("(a.part_number = '$id')" );
            
            $result = $this->db->get()->result();
            return $result;
        }   
    }

    public function AddList($data)
    {
        $this->db->insert('unit', $data);
        return $this->db->affected_rows(); 
    }
    public function AddListpart($data)
    {
        $this->db->insert('part', $data);
        return $this->db->affected_rows(); 
    }
    public function EditList($id,$data)
    {
            $this->db->where("no_mesin = '$id' OR no_rangka = '$id'" );
            $this->db->update('unit', $data);
        return $this->db->affected_rows(); 
    }
    public function EditListPart($id,$data)
    {
            $this->db->where("part_number = '$id'" );
            $this->db->update('part', $data);
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
                b.nama_cabang, c.nama_lokasi, a.keterangan
        
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
                b.nama_cabang, c.nama_lokasi,a.keterangan
        
        ');
            $this->db->from('unit a');
            $this->db->join('cabang b', 'a.id_cabang = b.id_cabang', 'left');
            $this->db->join('lokasi c', 'a.id_lokasi = c.id_lokasi', 'left');
            $this->db->where('a.id_cabang', $cabang);
            $this->db->where(" (a.no_mesin = '$id' OR a.no_rangka = '$id')" );

            $result = $this->db->get()->result();
            return $result;
        }
    }
    public function GetAuListPart($id = null,$cabang= null)
    {
        if ($id === null) {
            $this->db->select('
                a.*, 
                b.nama_cabang, c.nama_lokasi
        
        ');
            $this->db->from('part a');
            $this->db->join('cabang b', 'a.id_cabang = b.id_cabang', 'left');
            $this->db->join('lokasi c', 'a.id_lokasi = c.id_lokasi', 'left');
            $this->db->where('a.id_cabang', $cabang);
            
            return $this->db->get()->result();
        }else{
            $this->db->select('
                a.*, 
                b.nama_cabang, c.nama_lokasi
        
        ');
            $this->db->from('part a');
            $this->db->join('cabang b', 'a.id_cabang = b.id_cabang', 'left');
            $this->db->join('lokasi c', 'a.id_lokasi = c.id_lokasi', 'left');
            $this->db->where('a.id_cabang', $cabang);
            $this->db->where("(a.part_number= '$id')" );

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
                b.nama_cabang, c.nama_lokasi, a.keterangan
        
        ');
        $this->db->from('unit a');
        $this->db->join('cabang b', 'a.id_cabang = b.id_cabang', 'left');
        $this->db->join('lokasi c', 'a.id_lokasi = c.id_lokasi', 'left');
            $this->db->where("a.status_unit",$status);
            $this->db->like("a.id_cabang",$cabang);
            $result = $this->db->get()->result();
            return $result;
    }
    public function GetSearchStatus($id=null,$status = null,$cabang = null)
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
        $this->db->where("(a.no_mesin LIKE '%$id%' OR a.no_rangka LIKE '%$id%' OR a.type LIKE '%$id%' OR a.tahun LIKE '%$id%' OR a.kode_item LIKE '%$id%')");
        
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
            $where = "temp_unit.no_rangka NOT IN (SELECT no_rangka FROM unit) AND (temp_unit.id_cabang='$cabang' AND (temp_unit.no_mesin='$id' OR temp_unit.no_rangka='$id'))";
            $this->db->where($where);
            return $this->db->get('temp_unit')->result();
        }
    }
    public function AuditEnd($cabang)
    { 
        $query = "
            INSERT INTO unit (no_mesin, no_rangka, id_cabang, id_lokasi, type, kode_item, tahun, tanggal_audit) 
            SELECT no_mesin, no_rangka,id_cabang, id_lokasi, type, kode_item, tahun,  CONVERT(date,GETDATE()) as tanggal_audit
            FROM temp_unit a 
            WHERE a.no_rangka NOT IN (
                SELECT no_rangka FROM unit)
                AND a.id_cabang='$cabang'
        ";
        $this->db->query($query);
        $query2 = "
            UPDATE unit
            SET status_unit = 'Belum ditemukan'
            WHERE status_unit is null AND id_cabang = '$cabang'
        ";
        $this->db->query($query2);
        return  $this->db->affected_rows();
    }



//     public function cariJadwalAudit($auditor=null, $tanggal_audit=null, $jenis_audit=null)
//     {
//         if ($auditor!=null && $tanggal_audit!=null && $jenis_audit!=null) {
//             $this->db->select('jadwal_audit.*, jenis_audit, nama_cabang');
//             $this->db->from('jadwal_audit');
//             $this->db->join('jenis_audit', 'jadwal_audit.idjenis_audit = jenis_audit.idjenis_audit', 'left');
//             $this->db->join('cabang', 'jadwal_audit.id_cabang = cabang.id_cabang', 'left');
//             $this->db->like('auditor', $auditor);
//             $this->db->like('tanggal_audit', $tanggal_audit);
//             $this->db->like('jenis_audit', $jenis_audit);
            
//             $result = $this->db->get()->result();

//             return $result;
//         }elseif ($auditor!=null && $tanggal_audit=null && $jenis_audit=null) {
//             $this->db->select('jadwal_audit.*, jenis_audit, nama_cabang');
//             $this->db->from('jadwal_audit');
//             $this->db->join('jenis_audit', 'jadwal_audit.idjenis_audit = jenis_audit.idjenis_audit', 'left');
//             $this->db->join('cabang', 'jadwal_audit.id_cabang = cabang.id_cabang', 'left');
//             $this->db->like('auditor', $auditor);
            
//             $result = $this->db->get()->result();
//             return $result;
            
//         }elseif ($auditor=null && $tanggal_audit!=null && $jenis_audit=null) {
//             $this->db->select('jadwal_audit.*, jenis_audit, nama_cabang');
//             $this->db->from('jadwal_audit');
//             $this->db->join('jenis_audit', 'jadwal_audit.idjenis_audit = jenis_audit.idjenis_audit', 'left');
//             $this->db->join('cabang', 'jadwal_audit.id_cabang = cabang.id_cabang', 'left');
//             $this->db->like('tanggal_audit', $tanggal_audit);
            
//             $result = $this->db->get()->result();
//             return $result;
            
//         }elseif ($auditor=null && $tanggal_audit=null && $jenis_audit!=null) {
//             $this->db->select('jadwal_audit.*, jenis_audit, nama_cabang');
//             $this->db->from('jadwal_audit');
//             $this->db->join('jenis_audit', 'jadwal_audit.idjenis_audit = jenis_audit.idjenis_audit', 'left');
//             $this->db->join('cabang', 'jadwal_audit.id_cabang = cabang.id_cabang', 'left');
//             $this->db->like('jenis_audit', $jenis_audit);
            
//             $result = $this->db->get()->result();
//             return $result;
        
//     }
// }

        public function cariscanunit($id = null)
        {
        if ($id === null) {
            return false;
        }else{
            $this->db->like('scanunit',$id);
            $result=$this->db->get('temp_unit')->result();
            return $result;
        }
        }

    


}
?>