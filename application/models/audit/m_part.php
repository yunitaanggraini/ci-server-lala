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
            $this->db->where('part_number', $id);
            
            
            
            $result = $this->db->get()->result();

            return $result;
        }
        
    }

    public function getpartValid($id=null, $offset=null,$tgl_awal=null, $tgl_akhir=null)
    {
        if ($id === null) {
            $this->db->select('part.*,nama_cabang, nama_lokasi');
            $this->db->from('part');
            $this->db->join('cabang', 'part.id_cabang = cabang.id_cabang', 'left');
            $this->db->join('lokasi', 'part.id_lokasi = lokasi.id_lokasi', 'left');
            $this->db->limit(15);
            $this->db->offset($offset);
             
            $result = $this->db->get()->result();

            return $result;
        }elseif($id!=null && $tgl_awal==null) {
            $this->db->select('part.*,nama_cabang, nama_lokasi');
            $this->db->from('part');
            $this->db->join('cabang', 'part.id_cabang = cabang.id_cabang', 'left');
            $this->db->join('lokasi', 'part.id_lokasi = lokasi.id_lokasi', 'left');
            $this->db->limit(15);
            $this->db->offset($offset);
            $this->db->where('part.id_cabang',$id);
            
            $result = $this->db->get()->result();

            return $result;
        }elseif($id!=null && $tgl_awal!=null&&$offset==null){
            $this->db->select('part.*,nama_cabang, nama_lokasi');
            $this->db->from('part');
            $this->db->join('cabang', 'part.id_cabang = cabang.id_cabang', 'left');
            $this->db->join('lokasi', 'part.id_lokasi = lokasi.id_lokasi', 'left');
            $this->db->where('part.id_cabang',$id);
            $this->db->where("part.tanggal_audit BETWEEN '$tgl_awal' AND '$tgl_akhir'");
            
            $result = $this->db->get()->result();

            return $result;
        }elseif($id!=null && $tgl_awal!=null) {
            $this->db->select('part.*,nama_cabang, nama_lokasi');
            $this->db->from('part');
            $this->db->join('cabang', 'part.id_cabang = cabang.id_cabang', 'left');
            $this->db->join('lokasi', 'part.id_lokasi = lokasi.id_lokasi', 'left');
            $this->db->limit(15);
            $this->db->offset($offset);
            $this->db->where('part.id_cabang',$id);
            $this->db->where("part.tanggal_audit BETWEEN '$tgl_awal' AND '$tgl_akhir'");
            
            $result = $this->db->get()->result();

            return $result;
        }
        
    }

}

/* End of file M_part.php */
