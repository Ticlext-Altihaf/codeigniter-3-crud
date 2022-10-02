<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include "CrudModel.php";
class MahasiswaModel extends CrudModel
{

	protected $table = "mahasiswa";

	public function __construct()
	{
		parent::__construct();
	}


	public function forge_table(){
		//check if table exists
		if($this->db->table_exists($this->tabel)){
			$this->drop_table($this->tabel);
		}
		//check if model MataKuliah exists
		include "MataKuliahModel.php";
		$mata_kuliah_model = new MataKuliahModel();
		$mata_kuliah_model->forge_table();

		$this->load->dbforge();
		$fields = array(
			'nim' => array(
				'type' => 'VARCHAR',
				'constraint' => '10'
			),
			'nama' => array(
				'type' => 'VARCHAR',
				'constraint' => '50',
			),
			'jurusan' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
			),
			'alamat' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
			),
			'fakultas' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
			),
			'fk_mata_kuliah' => array(
				'type' => 'VARCHAR',
				'constraint' => '10',
			),
		);
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('nim', TRUE);
		//add foreign key
		$this->dbforge->add_field('CONSTRAINT fk_mata_kuliah FOREIGN KEY (fk_mata_kuliah) REFERENCES mata_kuliah(kode_mk)');
		$this->dbforge->create_table($this->table);
	}
}
