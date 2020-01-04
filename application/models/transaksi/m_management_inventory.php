<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class m_management_inventory extends CI_Model {

    public function getInv($id = null)
    {
        if ($id===null) {
            $this->db->select('
                                a.idtransaksi_inv, a.idstatus_inventory, a.idjenis_inventory, a.idsub_inventory,
                                a.nilai_awal, a.ddp, a.nilai_asset , a.nilai_total_keseluruhan, a.tahun_pembuatan,
                                a.id_vendor, a.id_lokasi, a.tanggal_barang_diterima, a.jenis_pembayaran, a.keterangan, a.stok, a.foto, a.ppn, a.merk, a.aksesoris_tambahan, a.no_mesin, a.no_rangka, a.asal_hadiah, a.ket_ppn, a.serial_number, a.uang_muka, a.cicilan_perbulan, a.tenor, a.nilai_total, b.nama_vendor, c.status_inventory, d.jenis_inventory, a.nama_pengguna, e.sub_inventory, f.nama_lokasi
                                ');
            $this->db->from('transaksi_inventory a');
            $this->db->join('vendor b', 'a.id_vendor = b.id_vendor', 'left');
            $this->db->join('status_inventory c', 'a.idstatus_inventory = c.idstatus_inventory', 'left');
            $this->db->join('jenis_inventory d', 'a.idjenis_inventory = d.idjenis_inventory', 'left');
            $this->db->join('sub_inventory e', 'a.idsub_inventory = e.idsub_inventory', 'left');
            $this->db->join('lokasi f', 'a.id_lokasi = f.id_lokasi', 'left');
            
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
        $result = $this->db->get()->result();
        return $result;
        // return true;
    }

    public function addInv($data)
    {
        $this->db->insert('transaksi_inventory', $data);
        return $this->db->affected_rows();  
    }

    

}

/* End of file m_management_inventory.php */

?>