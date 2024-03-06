<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Product_gallery_model extends CI_Model {

	public function create($options)
	{
		$this->db->insert('afa110_product_gallery', $options);
		return $this->db->insert_id();
	}	

	public function get_gallery_by($productID)
	{
		$this->db->where('product_id', $productID);
		$this->db->limit(4);
		$query = $this->db->get('afa110_product_gallery');
		return $query->result();
	}

}

/* End of file Product_gallery_model.php */
/* Location: ./application/models/Product_gallery_model.php */