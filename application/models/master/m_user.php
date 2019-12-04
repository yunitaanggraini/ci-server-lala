<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

    public function getUser($id=null)
    {
        if ($id === null) {
            $this->db->select('user.*, user_group, nama_perusahaan, nama_cabang, nama_lokasi ');
            $this->db->from('user');
            $this->db->join('perusahaan', 'user.id_perusahaan = perusahaan.id_perusahaan', 'left');
            $this->db->join('lokasi', 'user.id_lokasi = lokasi.id_lokasi', 'left');
            $this->db->join('cabang', 'user.id_cabang = cabang.id_cabang', 'left');
            $this->db->join('user_group', 'user.id_usergroup = user_group.id_usergroup', 'left');
            
            
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
    public function cariUser($username=null, $nama=null)
    {
        if ($username!=null && $nama !=null) {
            $this->db->select('user.*, user_group, nama_perusahaan, nama_cabang, nama_lokasi ');
            $this->db->from('user');
            $this->db->join('perusahaan', 'user.id_perusahaan = perusahaan.id_perusahaan', 'left');
            $this->db->join('lokasi', 'user.id_lokasi = lokasi.id_lokasi', 'left');
            $this->db->join('cabang', 'user.id_cabang = cabang.id_cabang', 'left');
            $this->db->join('user_group', 'user.id_usergroup = user_group.id_usergroup', 'left');
            $this->db->like('username', $username);
            $this->db->like('nama', $nama);
            
            $result = $this->db->get()->result();

            return $result;
        }elseif ($username!=null && $nama==null) {
            $this->db->select('user.*, user_group, nama_perusahaan, nama_cabang, nama_lokasi ');
            $this->db->from('user');
            $this->db->join('perusahaan', 'user.id_perusahaan = perusahaan.id_perusahaan', 'left');
            $this->db->join('lokasi', 'user.id_lokasi = lokasi.id_lokasi', 'left');
            $this->db->join('cabang', 'user.id_cabang = cabang.id_cabang', 'left');
            $this->db->join('user_group', 'user.id_usergroup = user_group.id_usergroup', 'left');
            $this->db->like('username', $username);
            
            $result = $this->db->get()->result();
            return $result;
            
        }elseif ($username==null && $nama!=null) {
            $this->db->select('user.*, user_group, nama_perusahaan, nama_cabang, nama_lokasi ');
            $this->db->from('user');
            $this->db->join('perusahaan', 'user.id_perusahaan = perusahaan.id_perusahaan', 'left');
            $this->db->join('lokasi', 'user.id_lokasi = lokasi.id_lokasi', 'left');
            $this->db->join('cabang', 'user.id_cabang = cabang.id_cabang', 'left');
            $this->db->join('user_group', 'user.id_usergroup = user_group.id_usergroup', 'left');
            $this->db->like('nama', $nama);
            
            $result = $this->db->get()->result();
            return $result;
            
        }
        
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
