<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

    require(APPPATH . 'libraries/REST_Controller.php');
    use Restserver\Libraries\REST_Controller;
    class Audit extends REST_Controller {
private $_tgl;
public $ip_address;
public $username;
public $password;
public $database;
function __construct() {
    parent::__construct();
    $this->load->model('audit/m_audit','maudit');
    $this->load->model('audit/m_part','mpart');
    $this->load->model('audit/m_unit','munit');
    $this->load->model('audit/m_tempunit','mtempunit');
    $this->load->model('audit/m_temppart','mtemppart');
    $this->load->model('master/m_cabang','mcabang');
    $this->load->model('master/m_jenis_audit','mjenisaudit');
    $this->load->model('master/m_count','mcount');
    $this->load->model('laporan/m_laporan_audit','mlapdat');
    
    $this->_tgl = date('Y-m-d');
    $this->load->model('config/m_config','mconfig');
        // $data = $this->mconfig->getUserConfig();
        // foreach ($data as $d ) {
        //     $ip = $d->ip;
        //     $ip2 = 'IPADDRESS';
        //     $iv_key = 'honda12345';
        //     $encrypt_method = "AES-256-CBC";
        //     $key = hash('sha256',$ip2);
        //     $iv = substr(hash('sha256', $iv_key), 0, 16);
        //     $ip = base64_decode($ip);
        //     $ip = openssl_decrypt($ip, $encrypt_method, $key, 0, $iv);

        //     $uname = $d->username;
        //     $uname2 = 'USERNAME';
        //     $iv_key = 'honda12345';
        //     $encrypt_method = "AES-256-CBC";
        //     $key = hash('sha256',$uname2);
        //     $iv = substr(hash('sha256', $iv_key), 0, 16);
        //     $uname = base64_decode($uname);
        //     $this->username = openssl_decrypt($uname, $encrypt_method, $key, 0, $iv);

        //     $pass = $d->password;
        //     $pass2 = 'PASSWORD';
        //     $iv_key = 'honda12345';
        //     $encrypt_method = "AES-256-CBC";
        //     $key = hash('sha256',$pass2);
        //     $iv = substr(hash('sha256', $iv_key), 0, 16);
        //     $pass = base64_decode($pass);
        //     $this->password = openssl_decrypt($pass, $encrypt_method, $key, 0, $iv);

        //     $db = $d->db;
        //     $db2 = 'DATABASE';
        //     $iv_key = 'honda12345';
        //     $encrypt_method = "AES-256-CBC";
        //     $key = hash('sha256',$db2);
        //     $iv = substr(hash('sha256', $iv_key), 0, 16);
        //     $db = base64_decode($db);
        //     $this->database = openssl_decrypt($db, $encrypt_method, $key, 0, $iv);
        // }
        // $config_app = db_master($ip,$this->username,$this->password, $this->database);
        $this->load->model('audit/m_tempunit','mtempunit');
        // $this->mtempunit->app_db = $this->load->database($config_app,TRUE);
    }

    public function Audit_get(){
        $id= $this->get('id');
        $offset = $this->get('offset');
        
        if ($id===null) {
            $audit= $this->maudit->GetAudit(null,$offset);
            
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
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function Audit_delete()
    {
        $id= $this->delete('id');
        if ($id===null) {
            $this->response([
                'status' => false,
                'data' => 'need id'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }else{
            if ($this->maudit->delAudit($id)) {
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'data'=> 'deleted.'
                ], REST_Controller::HTTP_NO_CONTENT);
            }else{
                $this->response([
                    'status' => false,
                    'data' => 'ID not found.'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function Audit_post()
    {
        $data=[
                'idjadwal_audit' => $this->post('idjadwal_audit',true),
                'auditor' => $this->post('auditor',true),
                'tanggal' => $this->post('tanggal', true),
                'waktu' => $this->post('waktu', true),
                'idjenis_audit' => $this->post('idjenis_audit', true),
                'id_cabang' => $this->post('id_cabang', true),
                'keterangan' => 'waiting',
                'input_by' => $this->post('user',true),
                'tanggal_input' => $this->_tgl
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
            'tanggal' => $this->put('tanggal', true),
                'waktu' => $this->put('waktu', true),
                'idjenis_audit' => $this->put('idjenis_audit', true),
                'id_lokasi' => $this->put('id_lokasi', true),
                'id_cabang' => $this->put('id_cabang', true),
                'keterangan' => 'waiting',
                'tanggal_edit' => $this->_tgl
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
    public function Auditket_put()
    {
        $id =$this->put('idjadwal_audit');

        $data=[
                'keterangan' => $this->put('keterangan',true)
        ];
        if ($id===null) {
            $this->response([
                'status' => false,
                'data' => "need id"
            ], REST_Controller::HTTP_BAD_REQUEST);
        }else {
            if ($this->maudit->editAuditket($data, $id)) {
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
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function Unit_get()
    {
        $id= $this->get('id');
        $offset = $this->get('offset');
        
        if ($id===null) {
            $unit= $this->munit->GetUnit(null,$offset);
            
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
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
    public function listaud_get()
    {
        $id = $this->get('id');
        $cabang = $this->get('id_cabang');
        if ($id===null) {
            $aud = $this->maudit->GetList();
        }else{
            $aud = $this->maudit->GetList($id,$cabang);
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
            'umur_unit' => $this->post('umur_unit'),
            'tahun' => $this->put('tahun'),
            'id_lokasi' => $this->post('id_lokasi'),
            'id_cabang' => $this->post('id_cabang'),
            'type' => $this->post('type'),
            'kode_item' => $this->post('kode_item'),
            'aki' => $this->post('aki'),
            'spion' => $this->post('spion'),
            'tools' => $this->post('tools'),
            'buku_service' => $this->post('buku_service'),
            'helm' => $this->post('helm'),
            'status_unit' => $this->post('status'),
            'keterangan' => $this->post('keterangan'),
            'is_ready' => $this->post('is_ready'),
            'audit_by' => $this->post('user',true),
            'foto' => $this->post('foto'),
            'tanggal_audit' => $this->_tgl
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
    public function listaud_put()
    {
        $id= $this->put('id');
        $data =[
            'no_mesin' => $this->put('no_mesin'),
            'no_rangka' => $this->put('no_rangka'),
            'umur_unit' => $this->put('umur_unit'),
            'tahun' => $this->put('tahun'),
            'type' => $this->put('type'),
            'kode_item' => $this->put('kode_item'),
            'id_lokasi' => $this->put('id_lokasi'),
            'id_cabang' => $this->put('id_cabang'),
            'aki' => $this->put('aki'),
            'spion' => $this->put('spion'),
            'tools' => $this->put('tools'),
            'buku_service' => $this->put('buku_service'),
            'helm' => $this->put('helm'),
            'status_unit' => $this->put('status'),
            'keterangan' => $this->put('keterangan'),
            'edit_by' => $this->put('user'),
            'tanggal_edit' => $this->_tgl
        ];
        if ($id===null) {
            $this->response([
                'status' => false,
                'data' => "need id"
            ], REST_Controller::HTTP_OK);
        }else{
            if ($this->maudit->EditList($id,$data)) {
                $this->response([
                    'status' => true,
                    'data' => "Data Audit has been modified"
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'data' => "failed."
                ], REST_Controller::HTTP_OK);
            }
        }
        
    }

    public function List_get()
    {
        $id = $this->get('id');
        $cabang = $this->get('id_cabang');
        if ($id=== null) {
            $list= $this->maudit->GetAuList(null,$cabang);
            
        }else{
            $list= $this->maudit->GetAuList($id,$cabang);
        }
        
        if ($list) {
            $this->response([
                'status' => true,
                'data' => $list
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
    public function ListStatus_get()
    {
        $status = $this->get('status_unit');
        $cabang = $this->get('id_cabang');
        $list= $this->maudit->GetListStatus($status,$cabang);
        
        if ($list) {
            $this->response([
                'status' => true,
                'data' => $list
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
    public function SearchStatus_get()
    {
        $id = $this->get('id');
        $status = $this->get('status_unit');
        $cabang = $this->get('id_cabang');
        $list= $this->maudit->GetSearchStatus($id,$status,$cabang);
        
        if ($list) {
            $this->response([
                'status' => true,
                'data' => $list
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }


    public function TempUnit_get()
    {
        $id= $this->get('id');
        $offset = $this->get('offset');
        
        if ($id===null) {
            $tempunit= $this->mtempunit->GetTempUnit(null,$offset);
            
        }else{
            $tempunit= $this->mtempunit->GetTempUnit($id);
        }
        if ($tempunit) {
            $this->response([
                'status' => true,
                'data' => $tempunit
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
    public function ToUnit_get()
    {
        $cabang= $this->get('id_cabang');
        $offset= $this->get('offset');
        if ($cabang===null) {
            $tempunit= null;
            
        }else{
            $tempunit= $this->mtempunit->GetToUnit($cabang,$offset);
        }
        if ($tempunit!=null) {
            $this->response([
                'status' => true,
                'data' => $tempunit
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
    public function CariUnit_get()
    {
        $id= $this->get('id');
        $cabang= $this->get('id_cabang');
        if ($id===null) {
            $tempunit= null;
            
        }else{
            $tempunit= $this->mtempunit->GetCariUnit($id,$cabang);
        }
        if ($tempunit!=null) {
            $this->response([
                'status' => true,
                'data' => $tempunit
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
    public function CariUnitNrfs_get()
    {
        $id= $this->get('id');
        $cabang= $this->get('id_cabang');
        if ($id===null) {
            $unit= null;
            
        }else{
            $unit= $this->munit->GetCariUnitNrfs($id,$cabang);
        }
        if ($unit!=null) {
            $this->response([
                'status' => true,
                'data' => $unit
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function TempPart_get()
    {
        $id= $this->get('id');
        
        if ($id===null) {
            $temppart= $this->mtemppart->GetTempPart();
            
        }else{
            $temppart= $this->mtemppart->GetTempPart($id);
        }
        if ($temppart) {
            $this->response([
                'status' => true,
                'data' => $temppart
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function auditbefore_get()
    {
        $id = $this->get('id');
        $cabang = $this->get('id_cabang');
        if ($id=== null) {
            $list= $this->maudit->GetauditBefore($id,$cabang);
            
        }else{
            $list= $this->maudit->GetauditBefore($id,$cabang);

        }
        
        if ($list) {
            $this->response([
                'status' => true,
                'data' => $list
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function auditend_get()
    {
        $cabang = $this->get('id_cabang');
        $list= $this->maudit->AuditEnd($cabang);
        
        if ($list) {
            $this->response([
                'status' => true,
                'data' => $list
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }


    //---------//
    public function cabang_get()
    {
        $id= $this->get('id');
        
        if ($id===null) {
            $cabang= $this->mcabang->GetCabang();
            
        }else{
            $cabang= $this->mcabang->GetCabang($id);

        }
        if ($cabang) {
            $this->response([
                'status' => true,
                'data' => $cabang
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function lokasi_get()
    {
        $id= $this->get('id');
        
        if ($id===null) {
            $lokasi= $this->mlokasi->GetLokasi();
            
        }else{
            $lokasi= $this->mlokasi->GetLokasi($id);

        }
        if ($lokasi) {
            $this->response([
                'status' => true,
                'data' => $lokasi
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function Jenisaudit_get()
    {
        $id= $this->get('id');
        
        if ($id===null) {
            $jenisaudit= $this->mjenisaudit->GetJenisaudit();
            
        }else{
            $jenisaudit= $this->mjenisaudit->GetJenisaudit($id);

        }
        if ($jenisaudit) {
            $this->response([
                'status' => true,
                'data' => $jenisaudit
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    //-----CARI-----///
    public function cariJadwalAudit_get(){
        $auditor= $this->get('auditor');
        $tanggal_audit= $this->get('tanggal_audit');
        $jenis_audit= $this->get('jenis_audit');
        if ($auditor!= null && $tanggal_audit!=null && $jenis_audit!=null) {
            $jadwal_audit = $this->maudit->carijadwalaudit($auditor,$tanggal_audit,$jenis_audit);
        }elseif($auditor!=null&& $tanggal_audit==null&& $jenis_audit==null){
            $jadwal_audit = $this->maudit->cariauditor($auditor);
        }elseif ($auditor==null && $tanggal_audit!=null && $jenis_audit==null) {
            $jadwal_audit = $this->maudit->caritanggalaudit($tanggal_audit);
        }elseif ($auditor==null && $tanggal_audit==null && $jenis_audit!=null) {
            $jadwal_audit = $this->maudit->carijenisaudit($jenis_audit);
        }
        if ($jadwal_audit) {
            $this->response([
                'status' => true,
                'data' => $jadwal_audit
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
    // cari MOBILE
    public function cariaudit_get()
    {
        $id= $this->get('id');
        if ($id === null) {
            $cari = $this->maudit->cariaudit();
        }else{
            $cari = $this->maudit->cariaudit($id);

        }
        if ($cari) {
            $this->response([
                'status' => true,
                'data' => $cari
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function Jadwalauditcount_get()
    {
        $jadwalaudit= $this->mcount->Countjadwalaudit();

        if ($jadwalaudit) {
            $this->response([
                'status' => true,
                'data' => $jadwalaudit
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function unitready_post()
    {
        $id = $this->post('part_number');
        $data=[
            'part_number' => $this->post('part_number'),
            'no_mesin' => $this->post('no_mesin'),
            'no_rangka' => $this->post('no_rangka'),
            'id_cabang' => $this->post('id_cabang'),
            'id_lokasi' => $this->post('id_lokasi'),
            'keterangan' => $this->post('keterangan'),
            'kondisi' => $this->post('kondisi'),
            'penanggung_jawab' => $this->post('penanggung_jawab'),
        ];
        if ($id===null) {
            $postunit = null;
        }else{
            $postunit = $this->munit->addUnitReady($data);
        }

        if ($postunit) {
            $this->response([
                'status' => true,
                'data' => $postunit
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => "Failed to post"
            ], REST_Controller::HTTP_OK);
        }
    }
    public function dataunit_get()
    {
        $data = $this->mconfig->getUserConfig();
        foreach ($data as $d ) {
            $ip = $d->ip;
            $ip2 = 'IPADDRESS';
            $iv_key = 'honda12345';
            $encrypt_method = "AES-256-CBC";
            $key = hash('sha256',$ip2);
            $iv = substr(hash('sha256', $iv_key), 0, 16);
            $ip = base64_decode($ip);
            $ip = openssl_decrypt($ip, $encrypt_method, $key, 0, $iv);

            $uname = $d->username;
            $uname2 = 'USERNAME';
            $iv_key = 'honda12345';
            $encrypt_method = "AES-256-CBC";
            $key = hash('sha256',$uname2);
            $iv = substr(hash('sha256', $iv_key), 0, 16);
            $uname = base64_decode($uname);
            $this->username = openssl_decrypt($uname, $encrypt_method, $key, 0, $iv);

            $pass = $d->password;
            $pass2 = 'PASSWORD';
            $iv_key = 'honda12345';
            $encrypt_method = "AES-256-CBC";
            $key = hash('sha256',$pass2);
            $iv = substr(hash('sha256', $iv_key), 0, 16);
            $pass = base64_decode($pass);
            $this->password = openssl_decrypt($pass, $encrypt_method, $key, 0, $iv);

            $db = $d->db;
            $db2 = 'DATABASE';
            $iv_key = 'honda12345';
            $encrypt_method = "AES-256-CBC";
            $key = hash('sha256',$db2);
            $iv = substr(hash('sha256', $iv_key), 0, 16);
            $db = base64_decode($db);
            $this->database = openssl_decrypt($db, $encrypt_method, $key, 0, $iv);
        }
        $config_app = db_master($ip,$this->username,$this->password, $this->database);
        $this->mtempunit->app_db = $this->load->database($config_app,TRUE);
        $cekConfig = $this->mtempunit->app_db->initialize();
        if (!$cekConfig) {
            $this->response([
                'status' => false,
                'data' => "Database not connected!"
            ], REST_Controller::HTTP_OK);
        }else{
            $cabang = $this->get('id_cabang');
            $list =$this->mtempunit->getTempUnit(null,$cabang);
           if ($list!=false) {
            $this->response([
                'status' => false,
                'data' => "Already Donwloaded"
            ], REST_Controller::HTTP_OK);
           }else{
               $postunit = $this->mtempunit->getDataUnit($cabang);
               $i=$this->mcount->CountTempUnit();
               foreach ($postunit as $res) {
                    //    var_dump($post['no_rangka']);
                   $i++;
                   $data =[
                       'id_unit' => $i,
                       'no_mesin' => $res['no_mesin'],
                       'no_rangka' => $res['no_rangka'],
                       'id_cabang' => $res['kd_dealer'],
                       'id_lokasi' => $res['kd_gudang'],
                       'kode_item' => $res['kd_item'],
                       'type' => $res['sub_kategori'],
                       'tahun' => $res['THN_PERAKITAN']
                   ];
                   $download = $this->mtempunit->addTempUnit($data);
               }
               if ($download) {
                   $this->response([
                       'status' => true,
                       'data' => "Data Downloaded"
                   ], REST_Controller::HTTP_OK);
               }else{
                   $this->response([
                       'status' => false,
                       'data' => "Failed to post"
                   ], REST_Controller::HTTP_OK);
               }
           }
        }

    }

    public function CountDataUnit_get()
    {
        $status = $this->get('status');
        $cabang = $this->get('id_cabang');
        if ($status===null) {
            $statusUnit = $this->mcount->countDataUnit(null, $cabang);
        }else{
            $statusUnit = $this->mcount->countDataUnit($status,$cabang);
        }

        if ($statusUnit) {
            $this->response([
                'status' => true,
                'data' => $statusUnit
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => "Failed to post"
            ], REST_Controller::HTTP_OK);
        }
    }
    public function readyUnit_get()
    {
        $id = $this->get('id');
        $cabang = $this->get('id_cabang');
        if ($id===null) {
            $readyUnit = $this->munit->getUnitReady(null,$cabang);
        }else{
            $readyUnit = $this->munit->getUnitReady($id, $cabang);
        }

        if ($readyUnit) {
            $this->response([
                'status' => true,
                'data' => $readyUnit
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => "data not found"
            ], REST_Controller::HTTP_OK);
        }
    }
    public function countTempUnit_get()
    {
        $cabang = $this->get('id_cabang');
        if ($cabang ===null) {
            $count = $this->mcount->countTempUnit();
        }else{
            $count = $this->mcount->countTempUnit($cabang);
        }

        if ($count) {
            $this->response([
                'status' => true,
                'data' => $count
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'data' => "data not found"
            ], REST_Controller::HTTP_OK);
        }
    }

    public function countjadwalaudit_get()
    {
        $id= $this->get('id');
        
        if ($id===null) {
            $user= $this->mcount->countjadwalaudit();
        }
        if ($user) {
            $this->response([
                'status' => true,
                'data' => $user
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
    public function cetakUnit_get()
    {
        $cabang= $this->get('id_cabang');
        $tanggal_akhir= $this->get('tanggal_akhir');
        $tanggal_awal= $this->get('tanggal_awal');
        $status = $this->get('status');
        
            $cetak= $this->mlapdat->cetakUnit($cabang, $tanggal_awal, $tanggal_akhir,$status);
        if ($cetak) {
            $this->response([
                'status' => true,
                'data' => $cetak
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }
    public function LapUnit_get()
    {
        $cabang= $this->get('id_cabang');
        $tanggal_akhir= $this->get('tanggal_akhir');
        $tanggal_awal= $this->get('tanggal_awal');
        $status= $this->get('status');
            $cetak= $this->mlapdat->cetakLapUnit($cabang, $tanggal_awal, $tanggal_akhir,$status);
        if ($cetak) {
            $this->response([
                'status' => true,
                'data' => $cetak
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }


    public function countunit_get()
    {
        $a= $this->get('id_cabang');
        $b= $this->get('tgl_awal');
        $c=$this->get('tgl_akhir');
        $d= $this->get('status');
            $count= $this->mcount->countunit($a,$b,$c,$d);
        if ($count) {
            $this->response([
                'status' => true,
                'data' => $count
            ], REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'status' => false,
                'message' => 'Data not found.'
            ], REST_Controller::HTTP_OK);
            
        }
    }

    public function previewUnit_get()
    {
        $cabang= $this->get('id_cabang');
        $tanggal_akhir= $this->get('tanggal_akhir');
        $tanggal_awal= $this->get('tanggal_awal');
        $status = $this->get('status');
        $offset = $this->get('offset');
        
        $tampil= $this->munit->previewUnit($cabang, $tanggal_awal, $tanggal_akhir,$status,$offset);
        if ($tampil) {
            $this->response([
                'status' => true,
                'data' => $tampil
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
