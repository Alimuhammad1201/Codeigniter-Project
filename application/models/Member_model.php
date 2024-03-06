<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Member_model extends CI_Model {

	public function validate_credentials($where)
	{
		$this->db->where($where);
		$query = $this->db->get('afa110_member');

		if ($query->num_rows() > 0 ) 
			return $query->row();
		
		return false;
	}

	public function update($options, $where)
	{
		$this->db->where($where);
		$this->db->update('afa110_member', $options);
		return $this->db->affected_rows();
	}

}