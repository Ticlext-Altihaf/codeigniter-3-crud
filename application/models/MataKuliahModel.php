<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include "CrudModel.php";
class MataKuliahModel extends CrudModel
{
	public function __construct()
	{
		parent::__construct();

	}
	protected $table = "mata_kuliah";
	public function forge_table(){
		//check if table exists
		if($this->db->table_exists($this->table)){
			$this->drop_table($this->table);
		}
		$this->load->dbforge();
		$fields = array(
			'kode_mk' => array(
				'type' => 'VARCHAR',
				'constraint' => '10'
			),
			'nama_mk' => array(
				'type' => 'VARCHAR',
				'constraint' => '50',
			),
			'sks' => array(
				'type' => 'INT',
				'constraint' => '2',
			),
			'deskripsi' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('kode_mk', TRUE);
		$this->dbforge->create_table($this->table);
	}


}
