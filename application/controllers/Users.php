<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		validate_session();
		$this->load->model('userModel', 'user');
	}

	public function index()
	{
		$this->load->view('includes/header');
		$this->load->view('users/index');
		$this->load->view('includes/footer');
	}


	public function lists()
	{
		$users = $this->user->get_users();
		echo json_encode($users);
	}

	public function save_user()
	{
		$data = array(
			'email_user' 	=> $this->input->post('email'),
			'name_user' 	=> $this->input->post('name'),
			'password_user' => $this->input->post('password'),
			'status_user' 	=> $this->input->post('status')
		);

		$insert = $this->user->save_user($data);
            
		if($insert === true){
            $return = array('status' => 0);	
		} else {
			$return = array('status' => 1);
		}

		echo json_encode($return);
	}

	public function get_user($id_user)
	{
		echo json_encode($this->user->get_user_by_id($id_user));
	}


	public function edit_user()
	{
		$data = array(
			'email_user' 	=> $this->input->post('email'),
			'name_user' 	=> $this->input->post('name'),
			'password_user' => $this->input->post('password'),
			'status_user' 	=> $this->input->post('status')
		);

		$id = $this->input->post('id_user');

		$update = $this->user->edit_user($data, $id);
            
		if($update === true){
            $return = array('status' => 0);	
		} else {
			$return = array('status' => 1);
		}

		echo json_encode($return);
	}

}