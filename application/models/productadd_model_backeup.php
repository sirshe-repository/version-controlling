<?php

public function product_add(){
	This->load->helper('url');
	$data = array(
				'product_name' 		=>	$this->input->post('name'),
				'product_price' 	=>	$this->input->post('product_price'),
				'product_brand 	'	=>	$this->input->post('description')
				'img'				=>	$data
				);
	return $this->db->insert('product1',$data);
}

?>