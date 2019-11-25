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
    public function getSubJenisInv($id = null)
    {
            $this->db->select('sub_inventory.*, jenis_inventory');
            $this->db->from('sub_inventory');
            $this->db->join('jenis_inventory', 'sub_inventory.idjenis_inventory = jenis_inventory.idjenis_inventory', 'left');
            $this->db->where('sub_inventory.idjenis_inventory', $id);
            
            $result = $this->db->get()->result();
            return $result;
    }

    public function cariSubinv($subinv=null, $jenisinv=null)
    {
        if ($subinv!=null && $jenisinv !=null) {
            $this->db->select('sub_inventory.*, jenis_inventory');
            $this->db->from('sub_inventory');
            $this->db->join('jenis_inventory', 'sub_inventory.idjenis_inventory = jenis_inventory.idjenis_inventory', 'left');
            $this->db->like('sub_inventory', $subinv);
            $this->db->like('jenis_inventory.idjenis_inventory', $jenisinv);
            $result = $this->db->get()->result();
            return $result;
        }elseif ($subinv!=null && $jenisinv==null) {
            $this->db->select('sub_inventory.*, jenis_inventory');
            $this->db->from('sub_inventory');
            $this->db->join('jenis_inventory', 'sub_inventory.idjenis_inventory = jenis_inventory.idjenis_inventory', 'left');
            $this->db->like('sub_inventory', $subinv);
            
            $result = $this->db->get()->result();
            return $result;
            
        }elseif ($subinv==null && $jenisinv!=null) {
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
        
        $result = $this->db->get('sub_inventory')->result();
        return $result;
    }

    public function getJenisInv()
    {
        $result = $this->db->get('jenis_inventory')->result();
        return $result;     
    }

    public function addSubInv($data)
    {
        $result=$this->db->insert('sub_inventory', $data);  
        return $result;  
    }

    public function editSubInv($data,$id)
    {
            $this->db->where('idsub_inventory', $id);
            $this->db->update('sub_inventory', $data);
            return $this->db->affected_rows();
    }

    public function delSubInv($id)
    {
        $this->db->where('idsub_inventory', $id);
        $this->db->delete('sub_inventory');    
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