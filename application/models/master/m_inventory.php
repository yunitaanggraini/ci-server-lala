<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Inventory extends CI_Model {
    public function getInv($id = null)
    {
        if ($id === null) {
            $result = $this->db->get('transaksi_inventory')->result();
            return $result;    
        }else{
            $result = $this->db->get_where('transakasi_inventory',['idtransaksi_inv' => $id])->result();
            return $result;              
        }
    }
    public function Cariinventory($id = null)
    {
        if ($id === null) {
            return false;
          }else{
              $this->db->like('nama_inventory',$id);
            $result = $this->db->get('transaksi_inventory')->result();
            return $result;              
        }
    }

    public function addinventory($data)
    {
        $result = $this->db->insert('transaksi_inventory', $data);
        return $result;   
    }

    public function editinventory($data, $id)
    {
        $this->db->where('idtransaksi_inv', $id);
        $this->db->update('transaksi_inventory', $data);
        return $this->db->affected_rows();
    }

    public function delinventory($id)
    {
       $this->db->where('idtransaksi_inv', $id);
       $this->db->delete('transaksi_inventory');
       return $this->db->affected_rows();
    }

    

}

/* End of file M_Inventory.php */


?>