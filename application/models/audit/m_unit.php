<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class M_Unit extends CI_Model {

    public function getUnit($id = null)
    {
        if ($id === null) {
            $result = $this->db->get('unit')->result();

        }else {
            $result = $this->db->get_where('unit',['id_unit' => $id])->result();
        }

        return $result;
    }

}

/* End of file M_Unit.php */
