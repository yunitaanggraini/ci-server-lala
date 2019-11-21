<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    require(APPPATH . 'libraries/REST_Controller.php');
    use Restserver\Libraries\REST_Controller;
    class Login extends REST_Controller {

function __construct() {
    parent::__construct();
    $this->load->model('master/M_login','mlogin');
    
    }

    public function index_get(){
        $id = $this->get('username');
        $password = $this->get('password');
        $pass =$this->get('password');
        $iv_key = 'honda12345';
        $encrypt_method = "AES-256-CBC";
        $key = hash('sha256',$pass);
        $iv = substr(hash('sha256', $iv_key), 0, 16);
        $output = openssl_encrypt($pass, $encrypt_method, $key, 0, $iv);
        $password = base64_encode($output);
        if ($id) {
            $login = $this->mlogin->getUserbyid($id);
        }else{
            $this->response([
                'status' => false,
                'data' => 'need id'
            ], REST_Controller::HTTP_OK);
        }

        if ($login) {
            foreach($login as $l){
                $pass= $l->password;
            }
            if ($pass == $password) {
                $this->response([
                    'status' => true,
                    'data' => $login
                ], REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'data' => 'Wrong Password. ',
                ], REST_Controller::HTTP_OK);
            }
        }else {
            $this->response([
                'status' => false,
                'data' => 'Username not found.'
            ], REST_Controller::HTTP_OK);
        }
    }
}
/** End of file Login.php **/