<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crud extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Users_model');
		$this->load->helper('url_helper');
	}

	public function read(){
		$data = array();
		$data['users'] = $this->Users_model->read_users();
		$this->load->view('v_tampil', $data);
	}

	public function update($id){
		$data = $this->Users_model->read_users($id);
		if(empty($data)){
			show_404();
		}
		if($this->input->post('nama')){
			$this->Users_model->update_users($id);
			redirect(base_url(''));
		}
		$this->load->view('v_edit', $data);
	}

	public function create(){
		$data = array();
		if($this->input->post('nama')){
			$this->Users_model->create_users();
			redirect(base_url(''));
		}
		$this->load->view('v_tambah', $data);
	}

	public function delete($id){
		$this->Users_model->delete_users($id);
		redirect(base_url(''));
	}
}
