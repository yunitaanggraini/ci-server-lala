<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Config extends CI_Model {

    public function addUserConfig($data)
    {
        $result = $this->db->insert('config',$data); 
        return $result;
    }

}

/* End of file M_Config.php */
