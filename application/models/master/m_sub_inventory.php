<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class M_Sub_Inventory extends CI_Model {

    public function getSubInv($id = null)
    {
        if ($id===null) {
            $this->db->select('sub_inventory.*, jenis_inventory');
            $this->db->from('sub_inventory');
            $this->db->join('jenis_inventory', 'sub_inventory.idjenis_inventory = jenis_inventory.idjenis_inventory', 'left');
    
            $result = $this->db->get()->result();
            return $result;
        }else {
            $this->db->select('sub_inventory.*, jenis_inventory');
            $this->db->from('sub_inventory');
            $this->db->join('jenis_inventory', 'sub_inventory.idjenis_inventory = jenis_inventory.idjenis_inventory', 'left');
            $this->db->where('idsub_inventory', $id);
            
            $result = $this->db->get()->result();
            return $result;
            
        }
    }

    public function cariSubinv($typeinv=null, $jenisinv=null)
    {
        if ($typeinv!=null && $jenisinv !=null) {
            $this->db->select('sub_inventory.*, jenis_inventory');
            $this->db->from('sub_inventory');
            $this->db->join('jenis_inventory', 'sub_inventory.idjenis_inventory = jenis_inventory.idjenis_inventory', 'left');
            $this->db->like('sub_inventory', $typeinv);
            $this->db->like('jenis_inventory.idjenis_inventory', $jenisinv);
            $result = $this->db->get()->result();
            return $result;
        }elseif ($typeinv!=null && $jenisinv==null) {
            $this->db->select('sub_inventory.*, jenis_inventory');
            $this->db->from('sub_inventory');
            $this->db->join('jenis_inventory', 'sub_inventory.idjenis_inventory = jenis_inventory.idjenis_inventory', 'left');
            $this->db->like('sub_inventory', $typeinv);
            
            $result = $this->db->get()->result();
            return $result;
            
        }elseif ($typeinv==null && $jenisinv!=null) {
            $this->db->select('sub_inventory.*, jenis_inventory');
            $this->db->from('sub_inventory');
            $this->db->join('jenis_inventory', 'sub_inventory.idjenis_inventory = jenis_inventory.idjenis_inventory', 'left');
            $this->db->like('jenis_inventory.idjenis_inventory', $jenisinv);
            $result = $this->db->get()->result();
            return $result;
            
        }
        
    }

    public function getSubInvById($id)
    {
        $this->db->where('idsub_inventory', $id);
        
        $result = $this->db->get('Sub_Inventory')->result();
        return $result;
    }

    public function getJenisInv()
    {
        $result = $this->db->get('jenis_inventory')->result();
        return $result;     
    }

    public function addSubInv($data)
    {
        $result=$this->db->insert('Sub_Inventory', $data);  
        return $result;  
    }

    public function editSubInv($data,$id)
    {
            $this->db->where('idsub_inventory', $id);
            $this->db->update('Sub_Inventory', $data);
            return $this->db->affected_rows();
    }

    public function delSubInv($id)
    {
        $this->db->where('idsub_inventory', $id);
        $this->db->delete('Sub_Inventory');    
        return $this->db->affected_rows();
    }

    public function buatkodeSubInventory()
      {
        $this->db->get('sub_inventory');
        return $this->db->affected_rows();
      }

}

/* End of file Sub_Inventory.php */

?>