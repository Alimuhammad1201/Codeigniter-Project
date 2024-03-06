<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Product_specification_model extends CI_Model {

	public function create($options)
	{
		$this->db->insert('afa110_product_specification', $options);
		return $this->db->insert_id();
	}
	public function get_by($specificationId)
	{
		$this->db->where('id', $specificationId);
		$query = $this->db->get('afa110_product_specification');
		return $query->row();
	}
	public function update($specificationId, $option)
	{
		$this->db->where('id', $specificationId);
		$this->db->update('afa110_product_specification', $option);
		return $this->db->affected_rows();
	}

	public function spec_all($productID)
	{
		$this->db->where('product_id', $productID);
		$query = $this->db->get('afa110_product_specification');
		
		if ($query->num_rows() > 0 )
			return $query->row();
	}
}

/* End of file Product_specification_model.php */
/* Location: ./application/models/Product_specification_model.php */