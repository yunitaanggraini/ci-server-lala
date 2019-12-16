<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_Count extends CI_Model {
    public function CountUser()
    {
        $count = $this->db->get('user');
        
        if ($count->num_rows()>0) {
            return $count->num_rows();
        }else {
            return 0;
        }
    }

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

    public function CountJadwalAudit()
    {
        $count =$this->db->get('jadwal_audit');

        if ($count->num_rows()>0) {
            return $count->num_rows();
        } else {
            return 0;
        }
    }

    public function CountDataUnit($status=null,$cabang=null)
    {
        if ($status===null) {
            $count =$this->db->get_where('unit',['id_cabang' => $cabang]);

            if ($count->num_rows()>0) {
                return $count->num_rows();
            } else {
                return 0;
            }
        }else{
            $this->db->where('status_unit', $status);
            $this->db->where('id_cabang', $cabang);
            
            $count =$this->db->get('unit');
    
            if ($count->num_rows()>0) {
                return $count->num_rows();
            } else {
                return 0;
            }
        }
    }
    public function CountTempUnit($cabang=null)
    {
        if ($cabang ===null) {
            $count =$this->db->get('temp_unit');
        }else{
            $count =$this->db->get_where('temp_unit',['id_cabang' => $cabang]);
        }


            if ($count->num_rows()>0) {
                return $count->num_rows();
            } else {
                return 0;
            }
        
    }
    public function CountLokasi()
    {
            $count =$this->db->get('lokasi');

            if ($count->num_rows()>0) {
                return $count->num_rows();
            } else {
                return 0;
            }
        
    }


    public function CountTemptUnit()
    {
            $count =$this->db->get('temp_unit');

            if ($count->num_rows()>0) {
                return $count->num_rows();
            } else {
                return 0;
            }
        
    }



}