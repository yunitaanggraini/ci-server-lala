<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class m_management_inventory extends CI_Model {

    public function getInv($id = null)
    {
        if ($id===null) {
            $this->db->select('
                                transaksi_inventory.*,nama_vendor, status_inventory,
                                jenis_inventory, sub_inventory 
                                ');
            $this->db->from('transaksi_inventory');
            $this->db->join('vendor', 'vendor.id_vendor = transaksi_inventory.id_vendor', 'left');
            $this->db->join('status_inventory', 'status_inventory.idstatus_inventory = transaksi_inventory.idstatus_inventory', 'left');
            $this->db->join('jenis_inventory', 'jenis_inventory.idjenis_inventory = transaksi_inventory.idjenis_inventory', 'left');
            $this->db->join('sub_inventory', 'sub_inventory.idsub_inventory = transaksi_inventory.idsub_inventory', 'left');
            
        }else {
            $this->db->select('
                                transaksi_inventory.*,nama_vendor, status_inventory,
                                jenis_inventory, sub_inventory 
                                ');
            $this->db->from('transaksi_inventory');
            $this->db->join('vendor', 'vendor.id_vendor = transaksi_inventory.id_vendor', 'left');
            $this->db->join('status_inventory', 'status_inventory.idstatus_inventory = transaksi_inventory.idstatus_inventory', 'left');
            $this->db->join('jenis_inventory', 'jenis_inventory.idjenis_inventory = transaksi_inventory.idjenis_inventory', 'left');
            $this->db->join('sub_inventory', 'sub_inventory.idsub_inventory = transaksi_inventory.idsub_inventory', 'left');
            $this->db->where('idtransaksi_inv', $id);
            
        }
        $this->db->get()->result();
        return $this->db->affected_rows();
    }

    public function addInv($data)
    {
        $this->db->insert('transaksi_inventory', $data);
        return $this->db->affected_rows();  
    }

    

}

/* End of file m_management_inventory.php */

?>