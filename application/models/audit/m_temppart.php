<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_TempPart extends CI_Model {
    public $app_db;
    public function __construct()
    {
        parent::__construct();
    }
    public function getTempPart($id=null)
    {
        if ($id === null) {
            $this->db->select('temp_part.*,nama_cabang, nama_lokasi');
            $this->db->from('temp_part');
            $this->db->join('cabang', 'temp_part.id_cabang = cabang.id_cabang', 'left');
            $this->db->join('lokasi', 'temp_part.id_lokasi = lokasi.id_lokasi', 'left');
             
            $result = $this->db->get()->result();

            return $result;
        }else {
            $this->db->select('temp_part.*,nama_cabang, nama_lokasi');
            $this->db->from('temp_part');
            $this->db->join('cabang', 'temp_part.id_cabang = cabang.id_cabang', 'left');
            $this->db->join('lokasi', 'temp_part.id_lokasi = lokasi.id_lokasi', 'left');
            $this->db->where('id_part', $id);
            
            
            
            $result = $this->db->get()->result();

            return $result;
        }
        
    }

    public function getToPart($cabang =null,$offset=null)
    {
        $this->db->select('a.*,c.nama_cabang, b.nama_lokasi');
        $this->db->from('temp_part a');
        $this->db->join('lokasi b', 'a.id_lokasi = b.id_lokasi', 'left');
        $this->db->join('cabang c', 'a.id_cabang = c.id_cabang', 'left');
            if ($cabang!=null) {
            $this->db->where('a.id_cabang', $cabang);
            }
            if ($offset!=null) {
               $this->db->limit(15);
             $this->db->offset($offset); 
            }
            $result = $this->db->get()->result();
           return $result;
        }

    public function getDataPart($cabang)
    {
        $kd_dealer = $cabang;
        $query ="
        SELECT * FROM TRANS_PARTSTOCK_VIEW WHERE KD_DEALER='T13' AND (KD_RAKBIN != '' OR KD_RAKBIN!=NULL)
        ";
        // $this->db2->limit(1);
        $result = $this->app_db->query($query)->result_array();
        return $result;
    }

    public function addTempPart($data)
    {
        $this->db->insert('temp_part', $data);
        return $this->db->affected_rows(); 
    }

}