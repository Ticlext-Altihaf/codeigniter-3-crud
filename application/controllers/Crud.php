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
		$data['count'] = $this->Users_model->count();
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

	public function create_automatic(){

		$datas = array();
		$i = $this->Users_model->count();
		$data_count = rand(1,10) + $i;
		for($i = $i; $i < $data_count; $i++){
			$datas[$i] = array(
				'nama' => 'nama-'.$i,
				'alamat' => 'alamat-'.$i,
				'perkerjaan' => 'perkerjaan-'.$i,
			);
		}
		$this->Users_model->createBatch($datas);
		redirect(base_url(''));
	}

	public function delete_all(){
		$this->Users_model->delete_all();
		redirect(base_url(''));
	}

	public function delete($id){
		$this->Users_model->delete_users($id);
		redirect(base_url(''));
	}
}
