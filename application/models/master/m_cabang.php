<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Cabang extends CI_Model {

    public function getCabang($id = null)
    {
        if ($id === null) {
            $result = $this->db->get('cabang')->result();
            return $result;    
        }else{
            $result = $this->db->get_where('cabang',['id_Cabang' => $id])->result();
            return $result;              
        }
    }
    public function CariCabang($id = null)
    {
        if ($id === null) {
            return false;
          }else{
              $this->db->like('nama_cabang',$id);
            $result = $this->db->get('cabang')->result();
            return $result;              
        }
    }

    public function addCabang($data)
    {
        $result = $this->db->insert('cabang', $data);
        return $result;   
    }

    public function editCabang($data, $id)
    {
        $this->db->where('id_cabang', $id);
        $this->db->update('cabang', $data);
        return $this->db->affected_rows();
    }

    public function delCabang($id)
    {
       $this->db->where('id_cabang', $id);
       $this->db->delete('cabang');
       return $this->db->affected_rows();
    }


}

/* End of file Jenis_Inventory.php */
?>