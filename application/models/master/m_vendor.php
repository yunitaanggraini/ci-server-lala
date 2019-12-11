<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Vendor extends CI_Model {

    public function getVendorPagination($id = null,$limit,$star)
    {
        if ($id === null) {
            $result = $this->db->get('vendor',$limit,$start)->result();
            return $result;  
        }else{
            $result = $this->db->get_where('vendor',['id_vendor' =>$id],$limit,$start)->result();
            return $result;
        }
    }

    public function getVendor($id = null)
    {
        if ($id === null) {
            $result = $this->db->get('vendor')->result();
            return $result;  
        }else{
            $result = $this->db->get_where('vendor',['id_vendor' =>$id])->result();
            return $result;
        }
    }

    public function addVendor($data)
    {
        $result = $this->db->insert('vendor', $data);
        return $result;   
    }

    public function cariVendor($id = null)
      {
        if ($id === null) {
            return false;
          }else{
            $this->db->like('nama_vendor',$id);
            $result=$this->db->get('vendor')->result();
            return $result;
          }
      }

    public function editVendor($data, $id)
    {
        $this->db->where('id_vendor', $id);
        $this->db->update('vendor', $data);
        return $this->db->affected_rows();

    }

    public function delVendor($idvendor)
    {
       $this->db->where('id_vendor', $idvendor);
       $this->db->delete('vendor');  
       return $this->db->affected_rows(); 
    }

}

/* End of file Jenis_Inventory.php */
?>