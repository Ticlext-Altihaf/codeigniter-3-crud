<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users_model extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}



	public function create_users()
	{
		$this->load->helper('url');
		$data = array(
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'perkerjaan' => $this->input->post('perkerjaan'),
		);
		return $this->db->insert('users', $data);
	}

	public function createBatch($users){
		$this->db->insert_batch('users', $users);
	}

	public function count(){
		return $this->db->count_all('users');
	}

	public function delete_all(){
		$this->db->empty_table('users');
	}

	public function read_users($id = FALSE)
	{
		if ($id === FALSE) {
			$query = $this->db->get('users');
			return $query->result_array();
		}

		$query = $this->db->get_where('users', array('id' => $id));
		return $query->row_array();
	}
	public function update_users($id)
	{
		$this->load->helper('url');
		$data = array(
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'perkerjaan' => $this->input->post('perkerjaan'),
		);
		$this->db->where('id', $id);
		return $this->db->update('users', $data);
	}
	public function delete_users($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('users');
	}


}
