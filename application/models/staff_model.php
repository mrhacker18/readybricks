<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Staff_model extends CI_Model
{
    public $table = 'users';

	// public function get_Roles_list(){
	// 	return $this->db->select('RoleId, RoleName')->get('Roles')->result();
	// }public function get_Navigations_list(){
	// 	return $this->db->select('NavigationId, NavName')->get('Navigations')->result();
	// }
    public function get_all()
    {
		return $this->db->get($this->table)->result();		
    }
	public function get_page($size, $pageno){
		$this->db
			->limit($size, $pageno)
			->select('users.UserId,users.FirstName,users.LastName,users.Address,users.Location,users.PhoneNumber,users.Image,users.Email,users.UserName,users.Password,users.LoginType,users.Status')
			->where("Role = '2'");	
			
//->join('Roles', 'users.Role = Roles.RoleId', 'left outer')
//->join('Navigations', 'users.NavigationId = Navigations.NavigationId', 'left outer');	
		
		$data=$this->db->get($this->table)->result();
		$total=$this->count_all();
		return array("data"=>$data, "total"=>$total);
	}
	public function get_page_where($size, $pageno, $params){
		$this->db->limit($size, $pageno)
		->select('users.UserId,users.FirstName,users.LastName,users.Address,users.Location,users.PhoneNumber,users.Image,users.Email,users.UserName,users.Password,users.LoginType,users.Status')->where("Role = '2'");
		if(isset($params->search) && !empty($params->search)){
				$this->db->where("FirstName LIKE '%$params->search%' OR LastName LIKE '%$params->search%' OR Address LIKE '%$params->search%' OR PhoneNumber LIKE '%$params->search%' OR  Email LIKE '%$params->search%' OR UserName LIKE '%$params->search%' OR LoginType LIKE '%$params->search%' ");

		}	

		$data=$this->db->get($this->table)->result();
		$total=$this->count_where($params);
		return array("data"=>$data, "total"=>$total);
	}
	public function count_where($params)
	{	
		if(isset($params->search) && !empty($params->search)){
				$this->db->where("FirstName LIKE '%$params->search%' OR LastName LIKE '%$params->search%' OR Address LIKE '%$params->search%' OR PhoneNumber LIKE '%$params->search%' OR  Email LIKE '%$params->search%' OR UserName LIKE '%$params->search%' OR LoginType LIKE '%$params->search%' ");
			
		}	

		return $this->db->count_all_results($this->table);
	}
    public function count_all()
	{
		return $this->db			
			->count_all_results($this->table);
	}
    public function get($id)
    {
        return $this->db->where('UserId', $id)->get($this->table)->row();
    }
  
    public function add($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        return $this->db->where('UserId', $id)->update($this->table, $data);
    }

    public function delete($id)
    {
        $this->db->where('UserId', $id)->delete($this->table);
        return $this->db->affected_rows();
    }
    public function changestatus($id, $data)
    {
        return $this->db->where('UserId', $id)->update($this->table, $data);
    }
	
}

?>