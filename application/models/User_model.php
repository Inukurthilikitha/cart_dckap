<?php
class User_model extends CI_model{
 
public function login_user($params = array()){
    $this->db->select('*');
    $this->db->from('users');
    $this->db->where('Email',$params['email']);
    $this->db->where('Password',$params['password']);
    if($query=$this->db->get())
    {
        return $query->row_array();
    }
    else{
      return false;
    }
}
public function get_users(){
    $this->db->select('*');
    $this->db->from('users');
    if($query=$this->db->get())
    {
        return $query->result_array();
    }
    else{
      return false;
    }
}
public function user_details($params = array()){
  $this->db->select('*');
    $this->db->from('users');
      $this->db->where('UserId',$params['user_id']);
    if($query=$this->db->get())
    {
        return $query->result_array();
    }
    else{
      return false;
    }
}
 
}

?>
