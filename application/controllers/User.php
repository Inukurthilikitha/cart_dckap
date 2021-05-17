<?php

class User extends CI_Controller {

public function __construct(){

  parent::__construct();
	$this->load->helper('url');
		$this->load->model('user_model');
  $this->load->library('session');

}

public function index()
{
  $this->load->view("login.php");
}

public function login_user(){ 
  $params=array(
    'email'=>$this->input->post('email'),
    'password'=>$this->input->post('password')
  ); 
  $login_check=$this->user_model->login_user($params);

  if(is_array($login_check)){
    $flag = 1;
  }else{
    $flag = 0;
  }
  if($flag == 1)
  {
    $this->session->set_userdata('logged_user_data',$login_check);
    $this->session->set_userdata('login_flag',1);
    $success = 1;
  }
  else{
    $this->session->set_flashdata('error_msg', 'Error occured,Try again.');
    $success = 0;
  }
  echo json_encode(array(
    'res' => $success,
  ));
  exit;
}
public function user_logout(){
  $this->session->sess_destroy();
  redirect('login.html', 'refresh');
}

}

?>