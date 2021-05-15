<?php
class User_model extends CI_model{
 
 
 
public function register_user($user){
 
 
$this->db->insert('user', $user);
 
}
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
public function update_data($id,$params){
  $this->db->where('UserId',$id);
  return $this->db->update('users',$params);

}
public function insert_data($params){
  return $this->db->insert('users',$params);

}
public function delete_user($id){
  $this->db->where('UserId',$id);
  return $this->db->delete('users');
}
public function email_check($email){
 
  $this->db->select('*');
  $this->db->from('user');
  $this->db->where('user_email',$email);
  $query=$this->db->get();
 
  if($query->num_rows()>0){
    return false;
  }else{
    return true;
  }
 
}
 
 
}
 
 
?>
