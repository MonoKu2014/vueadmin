<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		validate_session();
	}

	public function index()
	{
		$this->load->view('includes/header');
		$this->load->view('users/index');
		$this->load->view('includes/footer');
	}

}