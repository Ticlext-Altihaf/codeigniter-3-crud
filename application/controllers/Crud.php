<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include 'API.php';
class Crud extends API {

	public function __construct()
	{
		parent::__construct();
	}

	public function records($table=null){
		if(!$table){
			redirect(site_url('/'));
			return;
		}
		$this->table = $table;
		$this->crud_model->table_exists($table) OR show_404();
		$result = $this->read();
		$result['table'] = $table;
		$result['fields'] = $this->crud_model->fields_name($table);
		return $this->load->view('records', $result);
	}

	public function crud(){
		$tables = $this->crud_model->get_tables();
		return $this->load->view('crud', array('tables'=>$tables));
	}


}
