<?php 
   
    defined('BASEPATH') OR exit('No direct script access allowed');
    
        require(APPPATH . 'libraries/REST_Controller.php');
        use Restserver\Libraries\REST_Controller;
        class Transaksi extends REST_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('transaksi/m_management_inventory', 'minv');
        
        }
    
        public function Inv_get()
    {
        $id = $this->get('id');

        if($id===null){
            $listinv = $this->minv->getInv();
        }else{
            $listinv = $this->minv->getInv($id);
        }

        if ($listinv) {
            $this->response([
                'status' => true,
                'data' => $listinv
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => "data not found"
            ], REST_Controller::HTTP_OK); 
        }


    }


    // public function cariInv_get(){
    //     $username= $this->get('username');
    //     $nama= $this->get('nama');
    //     if ($username!=null && $nama !=null) {
    //         $user= $this->muser->cariUser($username,$nama);
            
    //     }elseif($username!=null && $nama ==null){
    //         $user= $this->muser->cariUser($username);
            
    //     }elseif ($username==null && $nama !=null) {
    //         $user= $this->muser->cariUser(null,$nama);
            
    //     }
    //     if ($user) {
    //         $this->response([
    //             'status' => true,
    //             'data' => $user
    //         ], REST_Controller::HTTP_OK);
    //     }else{
    //         $this->response([
    //             'status' => false,
    //             'message' => 'Data not found.'
    //         ], REST_Controller::HTTP_OK);
            
    //     }
    // }

    public function Inv_delete()
    {
        $id= $this->delete('id');

        if ($id===null) {
            $this->response([
                'status' => false,
                'message' => 'need id'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }else{
            if ($this->minv->delInv($id)) {
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message'=> 'deleted.'
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'message' => 'ID not found.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function Inv_post()
    {   
        //belum fix
        $data=[
                'idtransaksi_inv' => $this->post('idtransaksi_inv',true),
                'idstatus_inventory' => $this->post('idstatus_inventory',true),
                'idjenis_inventory' => $this->post('idjenis_inventory',true),
                'idsub_inventory' => $this->post('idsub_inventory',true),
                'nilai_awal' => $this->post('nilai_awal',true),
                'ddp' => $this->post('ddp',true),
                'nilai_total_keseluruhan' => $this->post('nilai_total_keseluruhan',true),
                'id_vendor' => $this->post('id_vendor',true),
                'nik' => $this->post('nik',true),
                'tanggal_barang_diterima' => $this->post('tanggal_barang_diterima',true),
                'jenis_pembayaran' => $this->post('jenis_pembayaran',true),
                'keterangan' => $this->post('keterangan',true),
                'stok' => $this->post('stok',true),
                'foto' => $this->post('foto',true),
                'ppn' => $this->post('ppn',true),
                'merk' => $this->post('merk',true),
                'aksesoris_tambahan' => $this->post('aksesoris_tambahan',true),
                'barcode' => $this->post('barcode',true),
                'qrcode' => $this->post('qrcode',true),
                
        ];
    
            if ($this->minv->AddInv($data)>0) {
                $this->response([
                    'status' => true,
                    'data' => "User has been created"
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'data' => "failed."
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        
    }

    public function Inv_put()
    {
        $data=[
            'idtransaksi_inv' => $this->post('idtransaksi_inv',true),
            'idstatus_inventory' => $this->post('idstatus_inventory',true),
            'idjenis_inventory' => $this->post('idjenis_inventory',true),
            'idsub_inventory' => $this->post('idsub_inventory',true),
            'nilai_awal' => $this->post('nilai_awal',true),
            'ddp' => $this->post('ddp',true),
            'nilai_total_keseluruhan' => $this->post('nilai_total_keseluruhan',true),
            'id_vendor' => $this->post('id_vendor',true),
            'nik' => $this->post('nik',true),
            'tanggal_barang_diterima' => $this->post('tanggal_barang_diterima',true),
            'jenis_pembayaran' => $this->post('jenis_pembayaran',true),
            'keterangan' => $this->post('keterangan',true),
            'stok' => $this->post('stok',true),
            'foto' => $this->post('foto',true),
            'ppn' => $this->post('ppn',true),
            'merk' => $this->post('merk',true),
            'aksesoris_tambahan' => $this->post('aksesoris_tambahan',true),
            'barcode' => $this->post('barcode',true),
            'qrcode' => $this->post('qrcode',true),
            
    ];
        if ($id===null) {
            $this->response([
                'status' => false,
                'data' => "need id"
            ], REST_Controller::HTTP_BAD_REQUEST);
        }else {
            if ($this->minv->editInv($data,$id)) {
                $this->response([
                    'status' => true,
                    'data' => "User has been modified"
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'data' => "failed."
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    }
    /** End of file Transaksi.php **/
?>