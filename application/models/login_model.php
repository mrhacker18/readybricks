<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login_model extends CI_Model
{
    public $table = 'users';

	
    public function get_all()
    {
		return $this->db->get($this->table)->result();		
    }
	function login($username, $password)
	{
	   $this->db->select('UserId, Email, FirstName, LastName, Role');
	   $this -> db -> from('users');
	   $this -> db -> where('Email', $username);
	   $this -> db -> where('Password', $password);
       $this -> db -> where('Status', TRUE);
	   $this -> db -> limit(1);
	 
	   $query = $this -> db -> get();
	   if($query -> num_rows() == 1)
	   {
	     return $query->row();
	   }
	   else
	   {
	     return false;
	   }
	}
	 public function get_role($roleId)
    {
        return $this->db->where('RoleId', $roleId)->get('roles')->row();
    }
}

?>