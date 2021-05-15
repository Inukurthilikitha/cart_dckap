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

public function register_user(){
  $user=array(
    'user_name'=>$this->input->post('user_name'),
    'user_email'=>$this->input->post('user_email'),
    'user_password'=>md5($this->input->post('user_password')),
    'user_age'=>$this->input->post('user_age'),
    'user_mobile'=>$this->input->post('user_mobile')
  );
  $email_check=$this->user_model->email_check($user['user_email']);

  if($email_check){
    $this->user_model->register_user($user);
    $this->session->set_flashdata('success_msg', 'Registered successfully.Now login to your account.');
    redirect('user/login_view');
  }
  else{
    $this->session->set_flashdata('error_msg', 'Error occured,Try again.');
    redirect('user');
  }

}
public function register_view(){
  $this->load->view("register.php");
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
    // $data['users']=$this->user_model->login_user($params);
  if($flag == 1)
  {
    $this->session->set_userdata('logged_user_data',$login_check);
    $this->session->set_userdata('login_flag',1);
    // $this->session->set_userdata('user_email',$data['users'][0]['Email']);
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
public function user_list(){
  if($this->session->userdata('login_flag') == 1){
   $data['user_list']=$this->user_model->get_users();
   $this->load->view('users_list.php', $data);
  }else{
    redirect('login.html', 'refresh');
  }
}
public function edit_user(){
  $params['user_id'] = $this->input->post('user_id');
  $data['user_details']=$this->user_model->user_details($params);
  echo json_encode(array(
      'data' =>  $data['user_details'][0],
  ));
  exit;
}
public function add_details(){ 
   $date = date('Y-m-d h:i:s');
  $params=array(
    'Name' => $this->input->post('name'),
    'Email'=> $this->input->post('email'),
    'Phone'=> $this->input->post('phone'),
    'CreatedDate' =>  $date,
  );
  $data['resp']=$this->user_model->insert_data($params);
  echo json_encode(array(
     
  ));
  exit;
}
public function update_details(){ 
  $id = $this->input->post('user_id');
  $date = date('Y-m-d h:i:s');
  $params=array(
    'Name' => $this->input->post('name'),
    'Email'=> $this->input->post('email'),
    'Phone'=> $this->input->post('phone'),
    'ModifiedDate' =>  $date,
  );
  $data['resp']=$this->user_model->update_data($id,$params);
  echo json_encode(array(
     
  ));
  exit;
}
public function delete_user(){
  $id = $this->input->post('user_id');
  $data['resp']=$this->user_model->delete_user($id);
  echo json_encode(array(   
  ));
  exit;
}
public function user_logout(){
  $this->session->sess_destroy();
  redirect('login.html', 'refresh');
}

}

?>