<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users_model extends CI_Model
{

	/**
	 * CREATE TABLE `yusufsa_sij2_users` (
	 * `id` int(11) UNSIGNED NOT NULL,
	 * `nama` varchar(255) NOT NULL,
	 * `alamat` text NOT NULL,
	 * `perkerjaan` varchar(255) NOT NULL
	 * );
	 *
	 * --
	 * -- Dumping data for table `yusufsa_sij2_users`
	 * --
	 *
	 * INSERT INTO `yusufsa_sij2_users` (`id`, `nama`, `alamat`, `perkerjaan`) VALUES
	 * (1, 'AAAAAAAA', 'AAAAAAAA', 'AAAAAAAA'),
	 * (2, 'BBBBBBBBBBBB', 'BBBBBBBBBBBB', 'BBBBBBBBBBBB'),
	 * (3, 'CCCCCCCCCCCCC', 'CCCCCCCCCCCCC', 'CCCCCCCCCCCCC'),
	 * (4, 'DDDD', 'DDDDDDDD', 'DDDDDDDD');
	 * --
	 * -- Indexes for table `yusufsa_sij2_users`
	 * --
	 * ALTER TABLE `yusufsa_sij2_users`
	 * ADD PRIMARY KEY (`id`);
	 *
	 * --
	 * -- AUTO_INCREMENT for dumped tables
	 * --
	 *
	 * --
	 * -- AUTO_INCREMENT for table `yusufsa_sij2_users`
	 * --
	 * ALTER TABLE `yusufsa_sij2_users`
	 * MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
	 * COMMIT;
	 */

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
