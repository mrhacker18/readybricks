<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Store_model extends CI_Model
{
    public $table = 'store';

    public function get_all()
    {
	  	 $this->db->from($this->table);
		 $this->db->order_by('StoreId',"desc");
		 $query = $this->db->get(); 
		return $query->result();	
    }
	public function get_page($size, $pageno){
		$this->db
			->limit($size, $pageno)
			->select('StoreId,Name,Address,Location,PhoneNumber,Image,Email,Username,Password,Monday,Tuesday,Wednesday,Thursday,Friday,,Saturday,Sunday,Status');
			
//->join('Roles', 'Users.Role = Roles.RoleId', 'left outer')
//->join('Navigations', 'Users.NavigationId = Navigations.NavigationId', 'left outer');
			
		$data=$this->db->get($this->table)->result();
		$total=$this->count_all();
		return array("data"=>$data, "total"=>$total);
	}
	public function get_page_where($size, $pageno, $params){
		$this->db->limit($size, $pageno)
		->select('StoreId,Name,Address,Location,PhoneNumber,Image,Email,Username,Password,Monday,Tuesday,Wednesday,Thursday,Friday,,Saturday,Sunday,Status');
		if(isset($params->search) && !empty($params->search)){
				$this->db->where("Name LIKE '%$params->search%' OR Address LIKE '%$params->search%' OR PhoneNumber LIKE '%$params->search%' OR  Email LIKE '%$params->search%' OR Username LIKE '%$params->search%' ");

		}	

		$data=$this->db->get($this->table)->result();
		$total=$this->count_where($params);
		return array("data"=>$data, "total"=>$total);
	}
	public function count_where($params)
	{	
		if(isset($params->search) && !empty($params->search)){
				$this->db->where("Name LIKE '%$params->search%' OR Address LIKE '%$params->search%' OR PhoneNumber LIKE '%$params->search%' OR  Email LIKE '%$params->search%' OR Username LIKE '%$params->search%' ");
			
		}	

		return $this->db->count_all_results($this->table);
	}
    public function count_all()
	{
		return $this->db			
			->count_all_results($this->table);
	}
	public function getstore($starlat,$startlng){
	return		$this->db->query("Select *,SQRT(
    POW(69.1 * (Latitude - $starlat), 2) +
    POW(69.1 * ($startlng - Longitude) * COS(Latitude / 57.3), 2)) AS distance FROM store ORDER BY distance ")->result_array();

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
	
}

?>