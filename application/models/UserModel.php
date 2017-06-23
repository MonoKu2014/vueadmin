<?php

class userModel extends CI_Model {

	public function __construct(){
		parent::__construct();
	}

	public function get_users(){
		$this->db->order_by('name_user', 'asc');
		return $this->db->get('users')->result();
	}

	public function save_user($data)
	{
		return $this->db->insert('users', $data);
	}


	public function get_user_by_id($id){
		$this->db->where('id_user', $id);
		return $this->db->get('users')->result();
	}

	public function edit_user($data, $id)
	{
		$this->db->where('id_user', $id);
		return $this->db->update('users', $data);
	}

}
