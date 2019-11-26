<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_TempUnit extends CI_Model {

    public function getTempUnit($id=null)
    {
        if ($id === null) {
            $this->db->select('temp_unit.*, nama_lokasi,nama_cabang');
            $this->db->from('temp_unit');
            $this->db->join('lokasi', 'temp_unit.id_lokasi = lokasi.id_lokasi', 'left');
            $this->db->join('cabang', 'temp_unit.id_cabang = cabang.id_cabang', 'left');
             
            $result = $this->db->get()->result();

            return $result;
        }else {
            $this->db->select('temp_unit.*, nama_lokasi,nama_cabang');
            $this->db->from('temp_unit');
            $this->db->join('lokasi', 'temp_unit.id_lokasi = lokasi.id_lokasi', 'left');
            $this->db->join('cabang', 'temp_unit.id_cabang = cabang.id_cabang', 'left');
            $this->db->where('id_unit', $id);
            
            
            
            $result = $this->db->get()->result();

            return $result;
        }
        
    }
    public function getToUnit($cabang =null)
    {
        if ($cabang === null) {
            $this->db->select('temp_unit.*, nama_lokasi,nama_cabang');
            $this->db->from('temp_unit');
            $this->db->join('lokasi', 'temp_unit.id_lokasi = lokasi.id_lokasi', 'left');
            $this->db->join('cabang', 'temp_unit.id_cabang = cabang.id_cabang', 'left');
             
            $result = $this->db->get()->result();

            return $result;
        }else {
            $this->db->select('temp_unit.*, nama_lokasi,nama_cabang');
            $this->db->from('temp_unit');
            $this->db->join('lokasi', 'temp_unit.id_lokasi = lokasi.id_lokasi', 'left');
            $this->db->join('cabang', 'temp_unit.id_cabang = cabang.id_cabang', 'left');
            $this->db->where('temp_unit.id_cabang', $cabang);
            
            $result = $this->db->get()->result();

            return $result;
        }
        
    }
}