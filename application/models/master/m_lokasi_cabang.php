<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Lokasi_Cabang extends CI_Model {

    public function getLokasiCabang($id = null)
    {
        if ($id === null) {
            $result = $this->db->get('lokasi_cabang')->result();
            return $result;    
        }else{
            $result = $this->db->get_where('lokasi_cabang',['id_cabang' => $id])->result();
            return $result;              
        }
    }

}

/* End of file M_Lokasi_Cabang.php */

?>