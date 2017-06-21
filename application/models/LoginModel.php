<?php

class loginModel extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function get_login_data($email, $password){
		$this->db->where('password_user', $password);
		$this->db->where('email_user', $email);
		return $this->db->get('users')->result();
	}

}
