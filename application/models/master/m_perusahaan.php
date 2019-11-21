<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Perusahaan extends CI_Model {

    public function getPerusahaan($id= null)
    {
        if ($id===null) {
            $result = $this->db->get('perusahaan')->result();
            return $result;              
        }else {
            $result = $this->db->get_where('perusahaan',['id_perusahaan' => $id])->result();
            return $result;               
        }
    }

    public function cariPerusahaan($id = null)
      {
        if ($id === null) {
            return false;
          }else{
        $this->db->like('nama_perusahaan',$id);
          $result=$this->db->get('perusahaan')->result();
        return $result;
          }
      }
      
    public function addPerusahaan($data)
    {
        $this->db->insert('perusahaan',$data); 
          return $this->db->affected_rows();   
    }

    public function editPerusahaan($data,$id)
    {

        $this->db->where('id_perusahaan', $id);
        $this->db->update('perusahaan', $data);
        return $this->db->affected_rows();
    }

    public function delPerusahaan($id)
    {
       $this->db->where('id_perusahaan', $id);
       $this->db->delete('perusahaan');  
       return $this->db->affected_rows();
    }

}

/* End of file M_Perusahaan.php */

 ?> 