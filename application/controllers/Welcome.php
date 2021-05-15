<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
	parent::__construct();
	//Load Library and model.
	$this->load->library('cart');
	$this->load->model('cart_model');
	}

	public function index()
	{
		if($this->session->userdata('login_flag') == 1){
			$data['product_list'] = $this->cart_model->get_all();
			$this->load->view('welcome_message',$data);
		}else{
		   redirect('login.html', 'refresh');
		}
	}

	public function add()
	{
		$insert_data = array(
			'id' => $this->input->post('id'),
			'name' => $this->input->post('name'),
			'price' => $this->input->post('price'),
			'image' => $this->input->post('image'),
			'qty' => 1
		);
		$this->cart->insert($insert_data);
		echo $fefe = count($this->cart->contents());
	}
	public function remove() {
		$rowid = $this->input->post('rowid');
		if ($rowid==="all"){
			$this->cart->destroy();
		}else{
		$data = array(
			'rowid' => $rowid,
			'qty' => 0
		);
		$this->cart->update($data);
		}
		echo $fefe = count($this->cart->contents());
	}
	public function update_cart(){
		$rowid = $_POST['rowid'];
		$price = $_POST['price'];
		$amount = $price * $_POST['qty'];
		$qty = $_POST['qty'];

		$data = array(
			'rowid' => $rowid,
			'price' => $price,
			'amount' => $amount,
			'qty' => $qty
			);
		$this->cart->update($data);
		echo $data['amount'];
	}

	public function billing_view(){
		$this->load->view('billing_view');
	}

	public function save_order()
	{
		if($this->input->post('usertype') != 'exists'){
			$customer = array(
				'name' => $this->input->post('username'),
				'email' => $this->input->post('useremail'),
				'address' => $this->input->post('useraddress'),
				'phone' => $this->input->post('userphone')
			);
			$cust_id = $this->cart_model->insert_customer($customer);
		}
		else{
			$cust_id = $this->input->post('userid');
		}
		$order = array(
			'date' => date('Y-m-d'),
			'customerid' => $cust_id
		);
		$ord_id = $this->cart_model->insert_order($order);
		if ($cart = $this->cart->contents()):
			foreach ($cart as $item):
				$order_detail = array(
					'orderid' => $ord_id,
					'productid' => $item['id'],
					'quantity' => $item['qty'],
					'price' => $item['price']
				);
				// Insert product imformation with order detail, store in cart also store in database.
				$cust_id = $this->cart_model->insert_order_detail($order_detail);
			endforeach;
		endif;
		$this->cart->destroy();
		// After storing all imformation in database load "billing_success".
		$this->load->view('billing_success');
	}
	public function opencart()
    {
        $data['cart']  = $this->cart->contents();
        $this->load->view("cart_modal", $data);
    }
    public function get_user_data(){
    	$user_data = $_SESSION['logged_user_data'];
    	echo json_encode($user_data);exit;
    }
}