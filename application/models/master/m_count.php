<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Count extends CI_Model {

    public function CountUsergroup()
    {
        $count = $this->db->get('user_group');
        
        if ($count->num_rows()>0) {
            return $count->num_rows();
        }else {
            return 0;
        }
    }

    public function CountSubInventory()
    {
        $count =$this->db->get('sub_inventory');

        if ($count->num_rows()>0) {
            return $count->num_rows();
        } else {
            return 0;
        }  
    }

    public function CountStatusInventory()
    {
        $count =$this->db->get('status_inventory');

        if ($count->num_rows()>0) {
            return $count->num_rows();
        } else {
            return 0;
        }
    }

    public function CountVendor()
    {
        $count =$this->db->get('vendor');

        if ($count->num_rows()>0) {
            return $count->num_rows();
        } else {
            return 0;
        }
    }

    public function CountJenisAudit()
    {
        $count =$this->db->get('jenis_audit');

        if ($count->num_rows()>0) {
            return $count->num_rows();
        } else {
            return 0;
        }
    }

}