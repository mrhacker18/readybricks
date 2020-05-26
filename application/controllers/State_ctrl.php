<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('./application/libraries/base_ctrl.php');
class State_ctrl extends base_ctrl {
	function __construct() {
		parent::__construct();		
		$this->load->model('State_model','model');
		$this->load->model('country_model','country');
	}
	public function index()
	{
//		print_r($this->auth);
		// if($this->is_authentic($this->auth->RoleId, $this->user->UserId, 'Category')){
			$data['fx']='return '.json_encode(array("insert"=>$this->auth->IsInsert==="1","update"=>$this->auth->IsUpdate==="1","delete"=>$this->auth->IsDelete==="1"));
			$data['read']=$this->auth->IsRead;
			$this->load->view('State_view', $data);
		// }
		// else
		// {
		// 	$this->load->view('forbidden');
		// }
	}

	public function save()
	{
		$data=$this->post();
		$success=FALSE;
		$msg= 'You are not permitted.';
		$id=0;
		$tmpdata['SName']=$data->Name;
		$tmpdata['SStatus']='1';
		$tmpdata['SCountryId']=$data->Country;
		if(!isset($data->StateId))
		{
			if($this->auth->IsInsert){
				if($this->model->getName($data->Name,$data->Country)){
					$msg='Data Alreay exist';
					$success=FALSE;
				}else{
				$id=$this->model->add($tmpdata);
				$msg='Data inserted successfully';
				$success=TRUE;
				}
			}
					
		}
		else{
			if($this->auth->IsUpdate){
				if($this->model->getName($data->Name,$data->Country,$data->StateId)){
					$msg='Data Alreay exist';
					$success=FALSE;
				}else{
				$id=$this->model->update($data->StateId, $tmpdata);
				$success=TRUE;
				$msg='Data updated successfully';				
				}
			}		
		}
		print json_encode(array('success'=>$success, 'msg'=>$msg, 'id'=>$id));
	}

	public function delete()
	{
		if($this->auth->IsDelete){
			$data=$this->post();

			print json_encode( array("success"=>TRUE,"msg"=>$this->model->delete($data->id->StateId)));
		}
		else{
			print json_encode( array("success"=>FALSE,"msg"=>"You are not permitted"));
		}
	}
	public function changestatus()
	{
		$data=$this->post();
		$newdata['catStatus']=$data->status;
		$this->model->changestatus($data->id,$newdata);
		$success=TRUE;
		$msg='Status Changed successfully';				
		print json_encode(array('success'=>$success, 'msg'=>$msg));

	}
	public function get_Country_list(){
		print  json_encode($this->country->get_all());
	}
	public function get_State_list(){
		$data=$this->post();
		print  json_encode($this->state->get_all_by_countryId($data->id));
	}
	public function get_Navigations_list(){
		print  json_encode($this->model->get_Navigations_list());
	}
	
	public function get()
	{	
		$data=$this->post();
		print json_encode($this->model->get($data->RoleId));
	}
	public function get_all()
	{		
		print json_encode($this->model->get_all());
	}
	public function get_page()
	{	
		$data=$this->post();
		print json_encode($this->model->get_page($data->size, $data->pageno));
	}
	public function get_page_where()
	{	
		$data=$this->post();
		print json_encode($this->model->get_page_where($data->size, $data->pageno, $data));
	}	
}

?>