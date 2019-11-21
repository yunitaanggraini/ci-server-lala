<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

    require(APPPATH . 'libraries/REST_Controller.php');
    use Restserver\Libraries\REST_Controller;
    class Audit extends REST_Controller {

function __construct() {
    parent::__construct();
    $this->load->model('audit/m_audit','maudit');
    $this->load->model('audit/m_part','mpart');
    $this->load->model('audit/m_unit','munit');
    
    }

    public function Audit_get(){
        $id= $this->get('id');
        
        if ($id===null) {
            $audit= $this->maudit->GetAudit();
            
        }else{
            $audit= $this->maudit->GetAudit($id);

        }
        if ($audit) {
            $this->response([
                'status' => true,
                'data' => $audit
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function Audit_delete()
    {
        $id= $this->delete('id');
        if ($id===null) {
            $this->response([
                'status' => false,
                'message' => 'need id'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }else{
            if ($this->maudit->delAudit($id)) {
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message'=> 'deleted.'
                ], REST_Controller::HTTP_NO_CONTENT);
            }else{
                $this->response([
                    'status' => false,
                    'message' => 'ID not found.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function Audit_post()
    {
        $data=[
            'idjadwal_audit' => $this->post('idjadwal_audit',true),
                'tanggal' => $this->post('tanggal', true),
                'waktu' => $this->post('waktu', true),
                'idjenis_audit' => $this->post('idjenis_audit', true),
                'id_cabang' => $this->post('id_cabang', true),
                'keterangan' => $this->post('keterangan', true),
        ];

        if ($this->maudit->AddAudit($data)) {
            $this->response([
                'status' => true,
                'data' => "Data Audit has been created"
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => "failed."
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    public function Audit_put()
    {
        $id =$this->put('idjadwal_audit');

        $data=[
            'tanggal' => $this->post('tanggal', true),
                'waktu' => $this->post('waktu', true),
                'idjenis_audit' => $this->post('idjenis_audit', true),
                'id_lokasi' => $this->post('id_lokasi', true),
                'id_cabang' => $this->post('id_cabang', true),
                'keterangan' => $this->post('keterangan', true),
        ];
        if ($id===null) {
            $this->response([
                'status' => false,
                'data' => "need id"
            ], REST_Controller::HTTP_BAD_REQUEST);
        }else {
            if ($this->maudit->editAudit($data, $id)) {
                $this->response([
                    'status' => true,
                    'data' => "Data Audit has been modified"
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'data' => "failed."
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function Part_get()
    {
        $id= $this->get('id');
        
        if ($id===null) {
            $part= $this->mpart->GetPart();
            
        }else{
            $part= $this->mpart->GetPart($id);

        }
        if ($part) {
            $this->response([
                'status' => true,
                'data' => $part
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function Unit_get()
    {
        $id= $this->get('id');
        
        if ($id===null) {
            $unit= $this->munit->GetUnit();
            
        }else{
            $unit= $this->munit->GetUnit($id);

        }
        if ($unit) {
            $this->response([
                'status' => true,
                'data' => $unit
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
    public function listaud_get()
    {
        $id = $this->get('id');
        if ($id===null) {
            $aud = $this->maudit->GetList();
        }else{
            $aud = $this->maudit->GetList($id);
        }

        if ($aud) {
            $this->response([
                'status' => true,
                'data' => $aud
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
    public function listaud_post()
    {
        $data =[
            'id_unit' => $this->post('id_unit'),
            'no_mesin' => $this->post('no_mesin'),
            'no_rangka' => $this->post('no_rangka'),
            'aki' => $this->post('aki'),
            'spion' => $this->post('spion'),
            'tools' => $this->post('tools'),
            'buku_service' => $this->post('buku_service'),
            'helm' => $this->post('helm'),
            'status_unit' => $this->post('status')
        ];
        if ($this->maudit->AddList($data)) {
            $this->response([
                'status' => true,
                'data' => "Data Audit has been created"
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => "failed."
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
        
    }

    public function List_get()
    {
        $id = $this->get('id');
        if ($id=== null) {
            $list= $this->maudit->GetAuList();
            
        }else{
            $list= $this->maudit->GetAuList($id);

        }
        
        if ($list) {
            $this->response([
                'status' => true,
                'data' => $list
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
}
/** End of file Audit.php **/
 ?>
