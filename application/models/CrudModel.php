<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CrudModel extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	//FORGE
	public function drop_table($table)
	{
		$this->load->dbforge();
		return$this->dbforge->drop_table($table);
	}

	public function create_table($table, $fields, $primary)
	{
		$this->load->dbforge();
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key($primary, TRUE);
		return$this->dbforge->create_table($table);
	}

	//METADATA
	public function get_tables(){
		$tables = array();
		foreach($this->db->list_tables() as $table){
			$tables[] = array(
				'name' => $table,
				'fields' => $this->fields_data($table),
				'count' => $this->count($table),
			);
		}
		return $tables;
	}

	public function fields_data($table){
		return $this->db->field_data($table);
	}

	public function fields_name($table){
		$fields = $this->db->field_data($table);
		$data = array();
		foreach ($fields as $field)
		{
			$data[] = $field->name;
		}
		return $data;
	}
	public function field_get_primary_key($table){
		$fields = $this->db->field_data($table);
		foreach ($fields as $field)
		{
			if($field->primary_key == 1){
				return $field->name;
			}
		}
		return false;
	}

	public function count($table){
		return $this->db->count_all($table);
	}

	public function table_exists($table)
	{
		return $this->db->table_exists($table);
	}

	//END OF METADATA
	public function create($table, $data, $id = NULL)
	{
		if($id){
			$data[$this->field_get_primary_key($table)] = $id;
		}
		return $this->db->insert($table, $data);
	}

	public function createBatch($table, $data){
		return $this->db->insert_batch($table, $data);
	}



	//offset and limit are ignored if $id is set
	public function read($table, $id = NULL, $offset = NULL, $limit = NULL)
	{
		if (!$id) {
			$query = $this->db->get($table, $limit, $offset);
			return $query->result_array();
		}

		$query = $this->db->get_where($table, array($this->field_get_primary_key($table) => $id));
		return $query->row_array();
	}


	public function update($table, $data, $id)
	{
		$fields = $this->fields_name($table);
		$this->db->where($this->field_get_primary_key($table), $id);
		return $this->db->update($table, $data);
	}


	// data format [{id:1},{id:2}]
	/**
	 * @throws Exception
	 */
	public function updateBatch($table, $data){
		$primary_key = $this->field_get_primary_key($table);
		//check if all data have primary key
		foreach ($data as $key => $value) {
			if(!isset($value[$primary_key])){
				throw new Exception("Data must have primary key", 400);
			}
		}
		return $this->db->update_batch($table, $data, $primary_key);

	}

	public function delete($table, $id)
	{
		$this->db->where($this->field_get_primary_key($table), $id);
		return $this->db->delete($table);
	}
	/**
	 * Empty Table
	 *
	 * @param	string	the table to empty
	 * @return	bool	TRUE on success, FALSE on failure
	 */
	public function delete_all($table){
		return $this->db->empty_table($table);
	}



}
