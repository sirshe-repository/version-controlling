<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Productadd_model extends CI_Model{
	public function product_add($product_name,$product_price,$product_brand,$data_item){
		$data = array(
					'product_name' 		=>	$product_name,
					'product_price' 	=>	$product_price,
					'product_brand 	'	=>	$product_brand,
					'img'				=>	$data_item
					);
		return $this->db->insert('product1',$data);	
		
		
	}
	public function fetch_product(){
		$this->db->select('*');
		$this->db->from('product1');
		$query = $this->db->get();
		return $result = $query->result();
	}
	
}

?>