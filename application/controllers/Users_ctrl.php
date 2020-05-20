<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('./application/libraries/base_ctrl.php');
class Users_ctrl extends base_ctrl {
	function __construct() {
		parent::__construct();		
	    $this->load->model('Users_model','model');
	}
	public function index()
	{
		if($this->is_authentic($this->auth->RoleId, $this->user->UserId, 'Users')){
			$data['fx']='return '.json_encode(array("insert"=>$this->auth->IsInsert==="1","update"=>$this->auth->IsUpdate==="1","delete"=>$this->auth->IsDelete==="1"));
			$data['read']=$this->auth->IsRead;
			$this->load->view('Users_view', $data);
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
		// $config['upload_path']          = './uploads/';
  //       $config['allowed_types']        = 'gif|jpg|png|pdf|doc';
  //       $config['max_size']             = 100;
  //       $config['max_width']            = 1024;
  //       $config['max_height']           = 768;

//         $this->load->library('upload', $config);
//   if ( ! $this->upload->do_upload('image'))
//     {
//  	$error = array('error' => $this->upload->display_errors());
//  	print_r($error);
//     }


// $data = array('upload_data' => $this->upload->data());
// print_r($data);

		if(!isset($data->UserId))
		{
			if($this->auth->IsInsert){
				$checkphone= $this->model->getmobile($data->PhoneNumber);
				if($checkphone){
					$msg="Phone Number Already Exists";
					$success=FALSE;
					print json_encode(array('success'=>$success, 'msg'=>$msg));
					exit;
				}
   				$data->Status = 1;

				$id=$this->model->add($data);
				$msg='Data inserted successfully';
				$success=TRUE;
			}
					
		}
		else{
			if($this->auth->IsUpdate){

			// if($data->baseimage !=null){
		 // 		$new_data=explode(",",$data->baseimage);
		 //        $exten=explode('/',$new_data[0]);
	  //           $exten1=explode(';',$exten[1]);
	  //           $decoded=base64_decode($new_data[1]);
	  //           $img_name='img_'.uniqid().'.'.$exten1[0];
	  //           file_put_contents(APPPATH.'../uploads/'.$img_name,$decoded);
	  //           $data->image=$img_name;
		 //        unset($data->baseimage);
	  //       }
//print_r($data)
				$id=$this->model->update($data->UserId, $data);
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
	public function changestatus()
	{
		$data=$this->post();
		$newdata['Status']=$data->status;
		$this->model->changestatus($data->id,$newdata);
		$success=TRUE;
		$msg='Status Changed successfully';				
		print json_encode(array('success'=>$success, 'msg'=>$msg));

	}
	public function get_Roles_list(){
		print  json_encode($this->model->get_Roles_list());
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
}

?>