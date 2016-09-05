<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Registration_model extends CI_Model{
	public function reg_model($user_name,$user_password,$user_email){
		$data = array(
					'user_name'	=> $user_name,
					'user_password' => $user_password,
					'user_email'	=> $user_email
					);
		return $this->db->insert('user_details',$data);
	}

	public function fetch_registration_data($login_username,$login_password){
		$array = array('user_name' => $login_username, 'user_password' => $login_password);
		$this->db->select('*');
		$this->db->from('user_details');
		$this->db->where($array);
		$query = $this->db->get();
		if($query->num_rows() === 1){
			return $query->result();			
		}else{
			return false;
		}
	}
}
?>
