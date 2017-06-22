<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panel extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('includes/header');
		$this->load->view('panel/index');
		$this->load->view('includes/footer');
	}

}