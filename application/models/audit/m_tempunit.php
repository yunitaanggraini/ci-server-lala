<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_TempUnit extends CI_Model {

    public $db2;
    public function __construct()
    {
        parent::__construct();
        $this->db2 = $this->load->database('master',TRUE);
    }
    public function getDataUnit()
    {
        $kd_dealer = 'T13';
        // $query = "
                    // SELECT a.no_mesin, a.no_rangka, a.kd_item, a.sub_kategori, a.kd_dealer, a.kd_gudang, b.THN_PERAKITAN, c.NAMA_GUDANG , C.ALAMAT as ALAMAT_GUDANG, d.ksu
                    // FROM TRANS_STOCKMOTOR a
                    // LEFT JOIN TRANS_SJMASUK b ON b.NO_MESIN = a.NO_MESIN
                    // LEFT JOIN MASTER_GUDANG c ON c.KD_GUDANG = a.KD_GUDANG
                    // LEFT JOIN trans_terimasjmotor d on d.no_mesin = a.no_mesin
                    // WHERE a.STOCK_AKHIR=1 AND a.KD_DEALER ='$kd_dealer'
        // ";
        $query ="
                SELECT a.no_mesin, a.no_rangka, a.kd_item, a.sub_kategori, a.kd_dealer, a.kd_gudang, b.THN_PERAKITAN, c.NAMA_GUDANG , C.ALAMAT as ALAMAT_GUDANG, d.ksu
                FROM TRANS_STOCKMOTOR a
                LEFT JOIN TRANS_SJMASUK b ON b.NO_MESIN = a.NO_MESIN
                LEFT JOIN (SELECT KD_DEALER, KD_GUDANG, NAMA_GUDANG, ALAMAT FROM MASTER_GUDANG WHERE JENIS_GUDANG LIKE '%Unit%' 
                AND ROW_STATUS >=0 AND KD_DEALER='$kd_dealer' AND defaults=1) c ON c.KD_GUDANG= a.KD_GUDANG
                LEFT JOIN trans_terimasjmotor d on d.no_mesin = a.no_mesin and d.ROW_STATUS >=0 
                WHERE a.STOCK_AKHIR >=1 and a.KD_DEALER = '$kd_dealer' and a.ROW_STATUS >=0 
                ORDER BY a.no_mesin

        ";
        // $this->db2->limit(1);
        $result = $this->db2->query($query)->result_array();
        var_dump($result);
        return $result;
    }
    public function addTempUnit($data)
    {
        $this->db->insert('temp_unit', $data);
        return $this->db->affected_rows(); 
    }
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
    public function getCariUnit($id =null, $cabang = null)
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
            $this->db->where("nama_lokasi LIKE '%$id%' OR nama_cabang LIKE '%$id%' OR no_mesin LIKE '%$id%' OR no_rangka LIKE '%$id%' AND temp_unit.id_cabang='$cabang'");
            
            $result = $this->db->get()->result();

            return $result;
        }
    }
}