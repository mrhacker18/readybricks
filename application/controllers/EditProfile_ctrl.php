<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('./application/libraries/base_ctrl.php');
class EditProfile_ctrl extends base_ctrl {
	function __construct() {
		parent::__construct();		
	    $this->load->model('Users_model','model');
	}
	public function index()
	{
			$data['fx']='return '.json_encode(array("insert"=>$this->auth->IsInsert==="1","update"=>$this->auth->IsUpdate==="1","delete"=>$this->auth->IsDelete==="1",'cview'=>'editprofile','editdata'=>$this->model->get($this->user->UserId)));
			$data['read']=$this->auth->IsInsert;
			$this->load->view('EditProfile', $data);
		// }
		// else
		// {
		// 	$this->load->view('forbidden');
		// }
	}

	public function view()
	{
		if($this->is_authentic($this->auth->RoleId, $this->user->UserId, 'customerview')){
			$data['fx']='return '.json_encode(array("insert"=>$this->auth->IsInsert==="1","update"=>$this->auth->IsUpdate==="1","delete"=>$this->auth->IsDelete==="1",'cview'=>'customerview'));
			$data['read']=$this->auth->IsRead;
			$this->load->view('Customer_view', $data);
		}
		else
		{
			$this->load->view('forbidden');
		}
	}
	public function edit($id)
	{
		if($this->is_authentic($this->auth->RoleId, $this->user->UserId, 'customeredit')){
			$data['fx']='return '.json_encode(array("insert"=>$this->auth->IsInsert==="1","update"=>$this->auth->IsUpdate==="1","delete"=>$this->auth->IsDelete==="1",'cview'=>'customeredit','editdata'=>$this->model->get($id)));
			$data['read']=$this->auth->IsRead;
  			$this->load->view('Customer_edit', $data);
		}
		else
		{
			$this->load->view('forbidden');
		}
	}
	public function detailview($id)
	{
		if($this->is_authentic($this->auth->RoleId, $this->user->UserId, 'customerdetailview')){
			$data['fx']='return '.json_encode(array("insert"=>$this->auth->IsInsert==="1","update"=>$this->auth->IsUpdate==="1","delete"=>$this->auth->IsDelete==="1",'cview'=>'customerdetailview','editdata'=>$this->model->get($id)));
			$data['read']=$this->auth->IsRead;
  			$this->load->view('Customer_detail_view', $data);
		}
		else
		{
			$this->load->view('forbidden');
		}
	}

	public function save()
	{
		$data=$this->post();
		$success=FALSE;
		$msg= 'You are not permitted.';
		$editdata = '';
		$id=0;
		if(!isset($data->UserId))
		{
	        unset($data->CPassword);
	        $data->Role=6;
	        $data->Status=1;
			if($this->auth->IsInsert){

				$chkemail =$this->model->getEmail($data->Email);

				if($chkemail){
     				$msg='Email Address Already Exists';
					$success=FALSE;
				}else{
					$id=$this->model->add($data);
					$msg='Data inserted successfully';
					$success=TRUE;

				}
			}
					
		}
		else{
			if($this->auth->IsUpdate){
	        unset($data->CPassword);
	        unset($data->MobileNo);
	        unset($data->PhoneNumber);
	        unset($data->Image);
	        unset($data->Role);
	        unset($data->Status);
	        unset($data->TelNo);

				$id=$this->model->update($data->UserId, $data);
				$success=TRUE;
				$msg='Data updated successfully';				
				$editdata=$this->model->get($data->UserId);
			}		
		}
		print json_encode(array('success'=>$success, 'msg'=>$msg, 'id'=>$id,'editdata'=>$editdata));
	}

	public function delete()
	{
		if($this->auth->IsDelete){
			$data=$this->post();
			print json_encode( array("success"=>TRUE,"msg"=>$this->model->delete($data->id)));
		}
		else{
			print json_encode( array("success"=>FALSE,"msg"=>"You are not permitted"));
		}
	}
	public function get_Category_list(){
		print  json_encode($this->model->get_Category_list());
	}
public function get_Navigations_list(){
		print  json_encode($this->model->get_Navigations_list());
	}
	
	public function get()
	{	
		$data=$this->post();
		print json_encode($this->model->get($data->UserId));
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
	public function changestatus()
	{
		$data=$this->post();
		$newdata['Status']=$data->status;
		$this->model->changestatus($data->id,$newdata);
		$success=TRUE;
		$msg='Status Changed successfully';				
		print json_encode(array('success'=>$success, 'msg'=>$msg));

	}
}

?>