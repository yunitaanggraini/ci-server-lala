<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Part extends CI_Model {

    public function getPart($id = null)
    {
        if ($id === null) {
            $result = $this->db->get('part')->result();

        }else {
            $result = $this->db->get_where('part',['id_part' => $id])->result();
        }

        return $result;
    }

}

/* End of file M_Part.php */
