<?php


defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH . 'libraries/REST_Controller.php');
    use Restserver\Libraries\REST_Controller;
    class Config extends REST_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('config/m_config','mconfig');
    }
    

    public function Config_post()
    {
        $ip =$this->post('ip',true);
        $iv_key = 'honda12345';
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256',$ip);
        $iv = substr(hash('sha256', $iv_key), 0, 16);
        $output = openssl_encrypt($ip, $encrypt_method, $key, 0, $iv);
        $ipaddress = base64_encode($output);

        $uname =$this->post('username',true);
        $iv_key = 'honda12345';
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256',$uname);
        $iv = substr(hash('sha256', $iv_key), 0, 16);
        $output = openssl_encrypt($uname, $encrypt_method, $key, 0, $iv);
        $username = base64_encode($output);

        $pass =$this->post('password',true);
        $iv_key = 'honda12345';
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256',$pass);
        $iv = substr(hash('sha256', $iv_key), 0, 16);
        $output = openssl_encrypt($pass, $encrypt_method, $key, 0, $iv);
        $password = base64_encode($output);

        $db =$this->post('password',true);
        $iv_key = 'honda12345';
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256',$db);
        $iv = substr(hash('sha256', $iv_key), 0, 16);
        $output = openssl_encrypt($db, $encrypt_method, $key, 0, $iv);
        $database = base64_encode($output);
        $data=[
                
                'ip' => $ipaddress,
                'username' => $username,
                'password' => $password,
                'db' => $database
        ];
    
            if ($this->mconfig->AddUserConfig($data)>0) {
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

}

/* End of file Controllername.php */
