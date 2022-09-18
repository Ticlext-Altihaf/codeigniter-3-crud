<?php
defined('BASEPATH') or exit('No direct script access allowed');

//return JSON or whatever

/**
 *  * @property CrudModel $crud_model
 */
class API extends CI_Controller
{

	/**
	 * @var mixed
	 */
	protected $version, $table, $id, $method, $body, $extra;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('CrudModel', 'crud_model');
		$this->load->helper('url_helper');
	}

	//helper

	public function index()
	{
		//get current URL path

		//api/$version/$this->table
		//api/v1/users
		//Batch Operations: GET, POST, PUT, DELETE
		//Individual Operations: POST

		//api/$version/$this->table/$id
		//api/v1/users/1
		//Individual Operations: GET, PUT, DELETE

		//GET /api/v1/users
		//return all users

		//GET /api/v1/users?limit=10&offset=0
		//return 10 users starting from 0

		//POST /api/v1/users
		//create a new user
		//{} -> Individual Operations
		//[{}, {}] -> Batch Operations

		//PUT /api/v1/users
		//update users with matching id on the request body
		//Format: [{id:1}, {id:2}]
		//Batch Operations

		//DELETE /api/v1/users
		//delete users with matching id on the request body
		//Format: [id1, id2]
		//Batch Operations

		//PUT /api/v1/users/1
		//update user with id 1
		//Format: {id:1}

		//DELETE /api/v1/users/1
		//delete user with id 1
		//Format: {id:1}

		//GET /api/v1/users/1
		//return user with id 1

		//Version are controlled by routes

		$this->version = $this->uri->segment(2);
		$this->table = $this->uri->segment(3);
		$this->id = $this->uri->segment(4);
		$this->extra = $this->uri->segment(5);
		$this->method = $this->input->method();

		//get data to json
		$this->body = $this->input->raw_input_stream;
		$this->body = json_decode($this->body, true);

		//special case
		if ($this->table == "test") {
			$uri = $this->uri->uri_string();
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array(
					'uri' => $uri,
					'uri_segments' => $this->uri->segment_array(),
					'params' => $this->input->get(),
					'body' => $this->body,
					'version' => $this->version,
					'table' => $this->table,
					'id' => $this->id,
					'extras' => $this->extra,
					'method' => $this->method,
					'next_url' => site_url("api/$this->version/$this->table?offset="),
				)));
			return;
		}

		//special case
		//api/v1/tables
		if ($this->table == "tables") {
			try {
				if(!!$this->extra){
					$this->table = $this->id;
					if($this->extra == "generateRandom"){
						$result = $this->create_automatic();
						$this->output
							->set_content_type('application/json')
							->set_output(json_encode($result));

					}else{
						//404
						$this->output
							->set_content_type('application/json')
							->set_status_header(404)
							->set_output(json_encode(array(
								'message' => "Method not found"
							)));
					}
					return;
				}else if ($this->method == "post" && !!$this->id && $this->isAssoc($this->body)) {
					//create new table
					//POST /api/v1/tables/name?primary_key=primary_key_field_name
					//Data: https://codeigniter.com/userguide3/database/forge.html#creating-a-table
					$success = $this->crud_model->create_table($this->id, $this->body, $this->input->get('primary_key'));
					$this->output
						->set_content_type('application/json')
						->set_status_header($success ? 200 : 400)
						->set_output(json_encode(array(
							'success' => $success
						)));

				} else if ($this->method === "delete" && !!$this->id) {
					//delete table
					//DELETE /api/v1/tables/table_name
					$success = $this->crud_model->drop_table($this->id);
					$this->output
						->set_content_type('application/json')
						->set_status_header($success ? 200 : 400)
						->set_output(json_encode(array(
							'success' => $success,
						)));
				}else if($this->method === "get"){
					//GET /api/v1/tables
					//get all tables

					//GET /api/v1/tables/table_name
					//get metadata of table

					if(!!$this->id){
						//check if table exists
						$exists = $this->crud_model->table_exists($this->id);
						if(!$exists){
							throw new Exception("Table '$this->id' does not exist", 404);
						}
						$data = $this->crud_model->fields_data($this->id);
					}else {
						$data = $this->crud_model->get_tables();
					}
					$this->output
						->set_content_type('application/json')
						->set_status_header(200)
						->set_output(json_encode($data));
				}else{
					$this->output
						->set_content_type('application/json')
						->set_status_header(400)
						->set_output(json_encode(array(
							'error' => "Invalid Request",
						)));
				}
			} catch (Exception $e) {
				$this->output
					->set_content_type('application/json')
					->set_status_header($e->getCode())
					->set_output(json_encode(array(
						'error' => $e->getMessage(),
					)));
			}
			return;
		}
		//check if table exists
		if (!$this->crud_model->table_exists($this->table)) {
			//check if post request

			//return 404
			$this->output->set_content_type('application/json')->set_status_header(404)->set_output(json_encode(array(
				'message' => 'table.not.found'
			)));
			return;
		}


		//begin forwarding request to appropriate method
		$data = array(
			"message" => "no.method",
			"status" => 404
		);
		try {
			if ($this->method == 'get') {

					//GET /api/v1/users/1
					//return user with id 1

					//GET /api/v1/users
					//return all users

					$data = $this->read();

			} else if ($this->method == 'post') {
				//POST /api/v1/users/1
				//update user with id 1
				//Format: {id:1}

				//POST /api/v1/users
				//create a new user
				//{} -> Individual Operations
				//[{}, {}] -> Batch Operations
				$data = $this->create();

			} else if ($this->method == 'put') {
				//PUT /api/v1/users/1
				//update user with id 1
				//Format: {id:1}


				//PUT /api/v1/users
				//update users with matching id on the request body
				//Format: [{id:1}, {id:2}]
				//Batch Operations
				$data = $this->update();

			} else if ($this->method == 'delete') {
				//DELETE /api/v1/users
				//Batch Operations Format: [id1, id2]

				$data = $this->delete();
			}
		} catch (Exception $e) {
			$data = array(
				"message" => $e->getMessage(),
				"status" => $e->getCode(),
			);
		}
		//if status isn't set, set it to 200
		if (!isset($data['status'])) {
			$data['status'] = 200;
		}
		$this->output->set_content_type('application/json')->set_status_header($data['status'])->set_output(json_encode($data));
		/*

		*/
	}

	function isAssoc(array $arr)
	{
		if (array() === $arr) return false;
		return array_keys($arr) !== range(0, count($arr) - 1);
	}

	public function read($offset=NULL, $limit=NULL)
	{
		if(!$offset) $offset = $this->input->get('offset');
		if(!$limit) $limit = $this->input->get('limit');
		if(!$offset) $offset = 0;
		if(!$limit) $limit = 15;

		$data = array();
		$data['data'] = $this->crud_model->read($this->table, $this->id, $offset, $limit);
		$count = $this->crud_model->count($this->table);
		$data['pagination'] = array(
			'offset' => $offset,
			'limit' => $limit,
			'total' => $count,
			'pages' => ceil($count / $limit)
		);
		$current_page = ceil($offset / $limit) + 1;
		$data['pagination']['current_page'] = $current_page;
		if($data['pagination']['pages'] > 0){
			//is there next page ?
			if($current_page < $data['pagination']['pages']){
				$data['pagination']['next'] = array(
					'page' => $current_page + 1,
					'offset' => $offset + $limit,
					'path' => "/api/$this->version/$this->table?offset=" . ($offset + $limit) . "&limit=$limit"
				);

				$data['pagination']['next']['url'] = base_url($data['pagination']['next']['path']);
			}
			//is there previous page ?
			if($current_page > 1){
				$data['pagination']['previous'] = array(
					'page' => $current_page - 1,
					'offset' => $offset - $limit,
					'path' => "/api/$this->version/$this->table?offset=" . ($offset - $limit) . "&limit=$limit"
				);
				$data['pagination']['previous']['url'] = base_url($data['pagination']['previous']['path']);
			}

			$data['pagination']['first'] = array(
				'page' => 1,
				'offset' => 0,
				'path' => "/api/$this->version/$this->table?offset=0&limit=$limit"
			);
			$data['pagination']['first']['url'] = base_url($data['pagination']['first']['path']);
			$data['pagination']['last'] = array(
				'page' => $data['pagination']['pages'],
				'offset' => ($data['pagination']['pages'] - 1) * $limit,
				'path' => "/api/$this->version/$this->table?offset=" . (($data['pagination']['pages'] - 1) * $limit) . "&limit=$limit"
			);
			$data['pagination']['last']['url'] = base_url($data['pagination']['last']['path']);
		}
		return $data;
	}

	public function create()
	{
		$data = array();
		if ($this->isAssoc($this->body)) {
			//Individual Operations
			$data['success'] = $this->crud_model->create($this->table, $this->body, $this->id);
		} else {
			//Batch Operations
			$data['success'] = $this->crud_model->createBatch($this->table, $this->body);
		}
		return $data;
	}

	/**
	 * @throws Exception
	 */
	public function update()
	{
		if (!$this->id) {
			//Batch Operations
			$success = $this->crud_model->updateBatch($this->table, $this->body);
			return array(
				'success' => $success > 0,
				'count' => $success,
			);
		}

		$success = $this->crud_model->update($this->table, $this->body, $this->id);

		return array(
			'success' => $success,
			'id' => $this->id,
		);
	}

	public function delete()
	{
		$success = false;
		if (!$this->id) {
			//Batch Operation
			$success = $this->delete_all();
		} else {
			$success = $this->crud_model->delete($this->table, $this->id);
		}
		return array(
			'success' => $success,
			'status' => $success ? 200 : 400,
		);
	}

	public function delete_all()
	{
		return $this->crud_model->delete_all($this->table);
	}

	public function create_automatic()
	{
		$datas = array();
		$i = $this->crud_model->count($this->table);
		$data_count = rand(2, 90) + $i;
		$fields = $this->crud_model->fields_data($this->table);
		for ($i = $i+1; $i < $data_count; $i++) {
			$data = array();
			foreach ($fields as $field) {
				$data[$field->name] = $this->generate_data($field, $i);
			}
			$datas[] = $data;
		}

		$success = $this->crud_model->createBatch($this->table, $datas);
		return array(
			'success' => $success > 0,
			'count' => $success,
		);

	}

	private function generate_data($field, $i)
	{
		$integer = array('bit', 'tinyint', 'smallint', 'mediumint', 'int', 'bigint', 'bool', 'boolean');
		$float = array('float', 'double', 'decimal');
		$varchar = array('varchar', 'char', 'text', 'tinytext', 'mediumtext', 'longtext');
		$datetime = array('date', 'datetime', 'timestamp', 'time', 'year');
		$binary = array('binary', 'varbinary', 'tinyblob', 'blob', 'mediumblob', 'longblob', 'enum', 'set');

		if(in_array($field->type, $integer)){
			return $i;
		} else if(in_array($field->type, $float)){
			return $i + 0.1;
		} else if(in_array($field->type, $varchar)){
			return $field->name . $i;
		} else if(in_array($field->type, $datetime)){
			return date('Y-m-d H:i:s');
		} else {
			return $field->name . $i;
		}
	}
}
