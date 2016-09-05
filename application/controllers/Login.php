<?php
//controller file
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->helper('url','form');
		$this->load->library('form_validation');
		$this->load->model('productadd_model');
		$this->load->library('cart');
		$this->load->model('Cart_model');
		$this->load->model('Registration_model');
    }
	public function index()
	{
		$data['menu']='admin/menu';
		$data['main_content']='admin/productadd';
		
		$url = 'http://localhost/yii2/yii2-app-advanced/frontend/web/index.php?r=site/print';
            $headers = array();
            $headers[] = 'Accept: application/json';
            $headers[] = 'Content-Type: application/json';
            //open connection
            $ch = curl_init();
            //set the url, number of POST vars, POST data
            curl_setopt($ch,CURLOPT_URL, $url);
            //curl_setopt($ch,CURLOPT_POST, count($fields));
            //curl_setopt($ch,CURLOPT_POSTFIELDS, json_encode($fields));
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            //step3
            $result=curl_exec($ch);
            //step4
            curl_close($ch);
            $result=json_decode($result);
            print_r($result);
		$this->load->view('admin/main',$data);	
	}
	public function add_product(){
		//print_r($_FILES);
		if($this->input->post()){
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('price','Price','required|numeric');
		$this->form_validation->set_rules('description','Description','required');
		}
		if($this->form_validation->run() === FALSE){
			$data['menu']='admin/menu';
			$data['main_content']='admin/productadd';
			$this->load->view('admin/main',$data);
		} else{
			$product_name = $this->input->post('name');
			$product_price = $this->input->post('price');
			$product_brand = $this->input->post('description');
			$config['upload_path'] =  APPPATH.'../assets/uploads/';
		    $config['allowed_types'] = 'gif|jpg|png';
		    $config['max_size'] = '2048000';
			$this->load->library('upload', $config);
 			if (!$this->upload->do_upload('image_file'))
		    {	
				$error = array('upload_data' => $this->upload->display_errors());
				$this->load->view('admin/main', $error);

		    } else{
		    	
		    	$data = array('upload_data' => $this->upload->data());
		        $data_item = $data['upload_data']['file_name'];
		        $this->productadd_model->product_add($product_name,$product_price,$product_brand,$data_item);
		      	$this->load->view('admin/success');
		    }
		}
	}
	public function view_product(){
		$data['result'] = $this->productadd_model->fetch_product();
		$this->load->view('admin/product_show',$data);
	}
	public function add_to_cart($id){
		$result = $var['cart'] = $this->Cart_model->cart_add($id);
		$name = $result->product_name;
		$price = $result->product_price;
		$data = array(
               'id'      => $id,
               'qty'     => 1,
               'price'   => $price,
               'name'    => $name
            );
		$this->cart->insert($data);
		redirect('Login/view_product'); 
	}
	public function cart_details(){
		$this->load->view('admin/cart_details');
	}
	function removeCartItem($rowid) { 
        $data = array(
            'rowid'   => $rowid,
            'qty'     => 0
        );
        $result = $this->cart->update($data);
       	$this->load->view('admin/cart_details');
	}
	function cart_update(){
		$quantity = $_POST['quantity'];
		$rowid = $_POST['rowid'];
		$data = array(
			'rowid' => $rowid,
			'qty' => $quantity,
		);
		$this->cart->update($data);
	}
	function login_user(){
		$this->form_validation->set_rules('log_name','User Name','trim|required');
		$this->form_validation->set_rules('log_password','Password','trim|required');
		if($this->form_validation->run() == FALSE){
			$this->load->view('admin/login_view');
		}else{
			if(!empty($this->input->post())){
				$login_username = $this->input->post('log_name');
				$login_password = $this->input->post('log_password');
				$result = $credentials['data'] = $this->Registration_model->fetch_registration_data($login_username,$login_password);
				//print_r($result);die;
				$newdata = array(
                   'user_id'  => $result[0]->user_id,
                   'user_name'     => $result[0]->user_name,
               );
				$this->session->set_userdata($newdata);
				redirect('Login/index');
			}else{
				$this->load->view('admin/login_view');
			}
		}
	}
	function registration_user(){
		$this->form_validation->set_rules('reg_name','User Name','trim|required');
		$this->form_validation->set_rules('reg_password','Password','trim|required');
		$this->form_validation->set_rules('reg_eaddress','E-Mail','trim|required');
		//$this->form_validation->set_rules('reg_telephone','Telephone No','required');
		if($this->form_validation->run() == FALSE){
			$this->load->view('admin/login_view');
		}else{
			$user_name = $this->input->post('reg_name');
			$user_password = $this->input->post('reg_password');
			$user_email = $this->input->post('reg_eaddress');
			//$user_telephone = $this->input->post('reg_telephone');
			$this->Registration_model->reg_model($user_name,$user_password,$user_email);
			$message = "Registration Successful";
			$this->load->view('admin/login_view',$message);
		}

	}
	function logout(){
		if(!empty($_SESSION)){
			$this->session->sess_destroy();
			redirect('Login/index');	
		}
		
	}
	function order(){
		$cart = $this->cart->contents();
		foreach($cart as $cart_items){
			print_r($cart_items);
		
		}
			//echo $product=$cart_items['name'];
		//echo "<pre>"; print_r($_SESSION); exit;
		/*$items_in_cart = ($this->session->userdata());
			//print_r($items_in_cart);die;
		foreach($items_in_cart as $cart_item){
			print_r($cart_item);die;	
		}
		
		/*if($_SESSION['user_id'] != ""){
			$user_id = $_SESSION['user_id'];

		}*/
	}
}
