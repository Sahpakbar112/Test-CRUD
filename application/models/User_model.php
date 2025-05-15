<?php
//User_model.php
class User_model extends CI_Model {
  public function get_users() {
    $this->db->select('u.*, r.name as role_name')
             ->from('users u')
             ->join('roles r', 'u.role_id = r.id')
             ->where('u.deleted_at IS NULL');
    return $this->db->get()->result();
}

  public function get_roles() {
    return $this->db->get('roles')->result();
  }
  public function getById($id)
  {
      return $this->db->get_where('users', ['id' => $id, 'deleted_at' => null])->row();
  }
  public function save($data) {
    $this->db->insert('users', $data);
}
  
  public function insert($data) {
    $this->db->insert('users', $data);
  }
  public function insert_user($data) {
    return $this->db->insert('users', $data);
}

  public function update($id, $data)
  {
      $this->db->where('id', $id);
      $this->db->update('users', $data);
  }
  
  //delete permanen
  // public function delete($id)
  // {
  //     $this->db->where('id', $id);
  //     return $this->db->delete('users');
  // }
  

 // Soft delete user
 public function soft_delete($id)
 {
     return $this->db->update('users', [
         'deleted_at' => date('Y-m-d H:i:s')
     ], ['id' => $id]);
 }
 
  public function get_detail($id) {
    return $this->db->select('u.*, r.name as role_name')
                    ->from('users u')
                    ->join('roles r', 'u.role_id = r.id')
                    ->where('u.id', $id)
                    ->where('u.deleted_at IS NULL')
                    ->get()->row();
}

public function get_by_id($id)
{
    $this->db->select('users.*, roles.name as role_name');
    $this->db->from('users');
    $this->db->join('roles', 'roles.id = users.role_id', 'left');
    $this->db->where('users.id', $id);
    return $this->db->get()->row();
}

public function get_all()
{
    $this->db->select('users.*, roles.name as role_name');
    $this->db->from('users');
    $this->db->join('roles', 'roles.id = users.role_id', 'left');
   // $this->db->where('users.deleted_at IS NULL');
    $this->db->where('deleted_at IS NULL');

    return $this->db->get()->result();
}

  
}