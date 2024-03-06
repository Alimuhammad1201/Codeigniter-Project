<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

	public function create($options)
	{
		$this->db->insert('afa110_product', $options);
		return $this->db->insert_id();
	}

	public function get_all($limit = NULL, $offset = NULL)
	{
		$query = $this->db->get('afa110_product', $limit, $offset);
		return $query->result();
	}
	public function get_by($productId)
	{
		$this->db->where('id', $productId);
		$query = $this->db->get('afa110_product');
		return $query->row();
	}
	public function count_all()
	{
		$query = $this->db->get('afa110_product');
		return $query->num_rows();
	}
	public function update($productId, $options)
	{
		$this->db->where('id', $productId);
		$this->db->update('afa110_product', $options);
		return $this->db->affected_rows();
	}

	public function destroy($productId)
	{
		$this->db->where('id', $productId);
		$this->db->delete('afa110_product');
		return $this->db->affected_rows();
	}

	/**** FRONTEND DEVELOPMENT ****/

	public function show_by($slug)
	{
		$this->db->where('slug', $slug);
		$this->db->select('*');    
		$this->db->from('afa110_product');
		$this->db->join('afa110_product_gallery', 'afa110_product.id = afa110_product_gallery.product_id');
		$this->db->join('afa110_product_specification', 'afa110_product.id = afa110_product_specification.product_id');
		$query = $this->db->get();
		return $query->row();
	}

	public function show_all()
	{
		$this->db->where('status', 'ACTIVE');
		$query = $this->db->get('afa110_product');
		return $query->result();
	}
	public function show_product_by($brand_id)
	{
		$this->db->where('brand_id', $brand_id);
		$query = $this->db->get('afa110_product');
		return $query->result();

	}


	public function latest_products()
	{
		$this->db->where('status', 'ACTIVE');
		$this->db->order_by('id', 'desc');
		$this->db->limit(5);
		$query = $this->db->get('afa110_product');
		return $query->result();
	}

	public function most_viewed()
	{
		$this->db->where('status', 'ACTIVE');
		$this->db->order_by('views', 'desc');
		$this->db->limit(5);
		$query = $this->db->get('afa110_product');
		
	}

	public function update_views($productId)
	{
		$this->db->set('views', 'views+1', FALSE);
		$this->db->where('id', $productId);
		$this->db->update('afa110_product');
		return $this->db->affected_rows();
	}

}

/* End of file Product_model.php */
/* Location: ./application/models/Product_model.php */