<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('./application/libraries/base_ctrl.php');
class Maintenance_ctrl extends base_ctrl {
	function __construct() {
		parent::__construct();		
	    $this->load->model('Order_model','model');
	}
	public function index()
	{

		if($this->is_authentic($this->auth->RoleId, $this->user->UserId, 'Users')){
			$data['fx']='return '.json_encode(array("insert"=>$this->auth->IsInsert==="1","update"=>$this->auth->IsUpdate==="1","delete"=>$this->auth->IsDelete==="1"));
			$data['read']=$this->auth->IsRead;
			$this->load->view('Maintenance_view', $data);
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
		$id=0;
		if(!isset($data->MenuId))
		{
			if(isset($data->baseimage) !=null){
		 		$new_data=explode(",",$data->baseimage);
		        $exten=explode('/',$new_data[0]);
	            $exten1=explode(';',$exten[1]);
	            $decoded=base64_decode($new_data[1]);
	            $img_name='img_'.uniqid().'.'.$exten1[0];
	            file_put_contents(APPPATH.'../uploads/menu/'.$img_name,$decoded);
	            $data->Image=$img_name;
	            $data->Status= 1;
		        unset($data->baseimage);
		        unset($data->image);
	    	}

			if($this->auth->IsInsert){
				$id=$this->model->add($data);
				$msg='Data inserted successfully';
				$success=TRUE;
			}
					
		}
		else{
			if($this->auth->IsUpdate){

			if(isset($data->baseimage) !=null){
		 		$new_data=explode(",",$data->baseimage);
		        $exten=explode('/',$new_data[0]);
	            $exten1=explode(';',$exten[1]);
	            $decoded=base64_decode($new_data[1]);
	            $img_name='img_'.uniqid().'.'.$exten1[0];
	            file_put_contents(APPPATH.'../uploads/menu/'.$img_name,$decoded);
	            $data->Image=$img_name;
		        unset($data->baseimage);
	        }
		        unset($data->catName);
//print_r($data)
				$id=$this->model->update($data->MenuId, $data);
				$success=TRUE;
				$msg='Data updated successfully';				
			}		
		}
		print json_encode(array('success'=>$success, 'msg'=>$msg, 'id'=>$id));
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
		print json_encode($this->model->get_page_maintenance($data->size, $data->pageno));
	}
	public function get_page_where()
	{	
		$data=$this->post();
		print json_encode($this->model->get_page_where_maintenance($data->size, $data->pageno, $data));
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