<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cart_model extends CI_Model{
	public function cart_add($id){
	
		$this->db->select('*');
		$this->db->from('product1');
		$this->db->where('product_id', $id);
		$query = $this->db->get();
		return $query->row();
	}		
		
}

?>