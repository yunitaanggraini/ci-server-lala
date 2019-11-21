<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Menu extends CI_Model {

    public function getMenu($access=null)
    {
        if ($access === null) {
            $result = $this->db->get('menu')->result();

        }else {
            $this->db->select('menu.*, menu_akses.*');
            
            $this->db->from('menu');
            $this->db->join('menu_akses', 'menu_akses.id_menu = menu.id_menu', 'left');
            $this->db->where('menu_akses.id_usergroup', $access);
            
            $result =$this->db->get()->result();
            
        }

        return $result;
    }

    public function getSubMenu($id = null)
    {
        if ($id === null) {
            $result = $this->db->get('sub_menu')->result();

        }else {
            $result = $this->db->get_where('sub_menu',['id_menu' => $id])->result();
        }

        return $result;
    }
    public function getMenuAkses($id = null)
    {
        if ($id === null) {
            $result = $this->db->get('menu_akses')->result();

        }else {
            $result = $this->db->get_where('menu_akses',['idmenu_akses' => $id])->result();
        }

        return $result;
    }

}

/* End of file M_Menu.php */

?>