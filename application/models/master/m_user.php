<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

    public function getUser($id=null, $offset=null)
    {
        if ($id === null) {
            $this->db->select('user.*, user_group, nama_perusahaan, nama_cabang, nama_lokasi ');
            $this->db->from('user');
            $this->db->join('perusahaan', 'user.id_perusahaan = perusahaan.id_perusahaan', 'left');
            $this->db->join('lokasi', 'user.id_lokasi = lokasi.id_lokasi', 'left');
            $this->db->join('cabang', 'user.id_cabang = cabang.id_cabang', 'left');
            $this->db->join('user_group', 'user.id_usergroup = user_group.id_usergroup', 'left');
            $this->db->limit(15);
            $this->db->offset($offset);
            
            
            
            $result = $this->db->get()->result();

            return $result;
        }else {
            $this->db->select('user.*, user_group, nama_perusahaan, nama_cabang, nama_lokasi ');
            $this->db->from('user');
            $this->db->join('perusahaan', 'user.id_perusahaan = perusahaan.id_perusahaan', 'left');
            $this->db->join('lokasi', 'user.id_lokasi = lokasi.id_lokasi', 'left');
            $this->db->join('cabang', 'user.id_cabang = cabang.id_cabang', 'left');
            $this->db->join('user_group', 'user.id_usergroup = user_group.id_usergroup', 'left');
            $this->db->where('nik', $id);
            
            $result = $this->db->get()->result();

            return $result;
        }
        
    }
    public function getUserPass($id,$pass)
    {
            $this->db->select('user.*, user_group, nama_perusahaan, nama_cabang, nama_lokasi ');
            $this->db->from('user');
            $this->db->join('perusahaan', 'user.id_perusahaan = perusahaan.id_perusahaan', 'left');
            $this->db->join('lokasi', 'user.id_lokasi = lokasi.id_lokasi', 'left');
            $this->db->join('cabang', 'user.id_cabang = cabang.id_cabang', 'left');
            $this->db->join('user_group', 'user.id_usergroup = user_group.id_usergroup', 'left');
            $this->db->where('nik', $id);
            $this->db->where('password', $pass);
            
            $result = $this->db->get()->result();

            return $result;
        
    }
    public function cariUser($id=null, $offset=null)
    {
        $query="
            SELECT a.*, b.nama_perusahaan, c.nama_cabang, d.nama_lokasi, e.user_group FROM [user] a
            LEFT JOIN perusahaan b ON a.id_perusahaan=b.id_perusahaan
            LEFT JOIN cabang c ON a.id_cabang=c.id_cabang
            LEFT JOIN lokasi d ON a.id_lokasi = d.id_lokasi
            LEFT JOIN user_group e ON a.id_usergroup=e.id_usergroup
            WHERE a.nik LIKE '%$id%'
            OR a.username LIKE '%$id%'
            OR a.nama LIKE '%$id%'
            OR a.status LIKE '%$id%'
            OR b.nama_perusahaan LIKE '%$id%'
            OR c.nama_cabang LIKE '%$id%'
            OR d.nama_lokasi LIKE '%$id%'
            OR e.user_group LIKE '%$id%'
            
        ";
        if ($offset!=null) {
            $query .="
            ORDER BY a.nik ASC
            OFFSET $offset ROWS 
            FETCH NEXT 15 ROWS ONLY;
            ";

        }
        
            $result = $this->db->query($query);
            return $result;
        
    }


    public function addUser($data)
    {
        $result = $this->db->insert('user',$data); 
        return $result;
    }

    public function editUser($data,$nik)
    {
        $this->db->where('nik', $nik);
        $this->db->update('user', $data);  
        return $this->db->affected_rows();
    }
    public function editUserPass($nik,$data)
    {
        $this->db->where('nik', $nik);
        $this->db->update('user', $data);  
        return $this->db->affected_rows();
    }

    public function delUser($nik)
    {
        $this->db->where('nik', $nik);
        $this->db->delete('user');
        return $this->db->affected_rows();
        
    }

}

/* End of file M_user.php */
