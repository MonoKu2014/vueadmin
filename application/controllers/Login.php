<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('loginModel', 'login');
	}

	public function index()
	{
		$this->load->view('login/login');
	}

	public function start_session()
	{
		$email 		= $this->input->post('email');
		$password 	= $this->input->post('password');

		$login_data = $this->login->get_login_data($email, $password);

		if(count($login_data) > 0){
            $newdata = array(
                'id'      		=> $login_data[0]->id_user,
                'name'  		=> $login_data[0]->name_user,
                'email'   		=> $login_data[0]->email_user,
                'logged_in' 	=> true
            );
            $this->session->set_userdata($newdata);
            $data = array(
            	'status' => 0,
            	'url' => base_url().'panel'
            );
		} else {
            $data = array(
            	'status' => 1,
            	'message' => 'Incorrect access data'
            );
		}

		echo json_encode($data);

	}


	public function close_session()
	{
        $array_items = array(
            'id'      		=> '',
            'name'  		=> '',
            'email'   		=> ''
        );

		$this->session->unset_userdata($array_items);
		$this->session->sess_destroy();
		redirect(base_url());
	}

}