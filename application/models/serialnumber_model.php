<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SerialNumber_model extends CI_Model
{
    public $table = 'serialnumber';

    public function get_Model_list()
    {
		return $this->db->where('Status','1')->get('models')->result();		
    }

    public function get_all()
    {
		return $this->db->where('Status','1')->get($this->table)->result();		
    }
	public function get_page($size, $pageno,$customfilter){
		// $this->db
		// 	->limit($size, $pageno)
		// 	->select('serialnumber.SNoId,serialnumber.SerialNo,serialnumber.status,serialnumber.Date as sDate,orders.OrderId,orders.DateTime,models.Name')
		// 	->join('orders', 'FIND_IN_SET(orders.SerialNo,serialnumber.SerialNo)', 'left outer',false)
		// 	->join('models', 'models.ModelId = serialnumber.ModelId', 'inner')
		// 	->group_by('serialnumber.SNoId');
 				
			$cquery ="";
		if($customfilter !="" && $customfilter !=null){
			if(isset($customfilter->modelid) !=""){
				$cquery.= " AND s.ModelId = '".$customfilter->modelid."'";
//				$this->db->where("serialnumber.ModelId = '".$customfilter->modelid."'");
			}
			if(isset($customfilter->start_date)){
				$cdate = date('Y-m-d', strtotime($customfilter->start_date));
				$cquery.=" AND DATE(s.Date) >= '".$cdate."'";
//				$this->db->where("DATE(serialnumber.Date) >= '".$cdate."'");
			}
			if(isset($customfilter->end_date)){
				$cdate = date('Y-m-d', strtotime($customfilter->end_date));
				$cquery.=" AND DATE(s.Date) <= '".$cdate."'";
//				$this->db->where("DATE(serialnumber.Date) <= '".$cdate."'");
			}
		}


// 			$query= $this->db->query("SELECT `serialnumber`.`SNoId`, `serialnumber`.`SerialNo`, `serialnumber`.`status`, `serialnumber`.`Date` as sDate, `orders`.`OrderId`, `orders`.`DateTime`, `models`.`Name` FROM (`serialnumber`) LEFT OUTER JOIN `orders` ON FIND_IN_SET(serialnumber.SerialNo,orders.SerialNo) INNER JOIN `models` ON `models`.`ModelId` = `serialnumber`.`ModelId`  $cquery GROUP BY `serialnumber`.`SNoId` ORDER BY serialnumber.SerialNo DESC LIMIT $pageno,$size  ");
	 	
//		 $this->db->order_by('serialnumber.SerialNo',"desc");

	//	$data = $query->result();

			// $query =$this->db->query("select SNoId,serialnumber.ModelId,serialnumber.SerialNo,serialnumber.status,serialnumber.Date as sDate,orders.DateTime,orders.OrderId,orders.ModelId as ordermodel,models.Name  FROM serialnumber LEFT OUTER JOIN orders on FIND_IN_SET(serialnumber.SerialNo,orders.SerialNo) INNER join models on models.Modelid = serialnumber.ModelId  
	 	// 	$cquery GROUP BY `serialnumber`.`SNoId`,`serialnumber`.`ModelId` ORDER BY serialnumber.SerialNo DESC  LIMIT $pageno,$size

	 	// ");

		$query =$this->db->query("select SNoId,s.ModelId,s.SerialNo,s.status,s.Date as sDate,models.Name,OrderId,DateTime FROM serialnumber AS s LEFT OUTER JOIN orders as o ON find_in_set(s.SerialNo,o.SerialNo)  AND find_in_set(s.ModelId,o.ModelId) INNER join models on models.Modelid = s.ModelId $cquery GROUP BY s.SNoId  ORDER BY s.SerialNo DESC  LIMIT $pageno,$size

	 	");

		$data = $query->result();

		// $allrecords = [];

		// foreach($data as $record){
		// 		// echo $record->SerialNo;
		// 		// echo $record->ModelId;
		// 		$oquery= $this->db->query("select * from orders where FIND_IN_SET('".$record->SerialNo."',orders.SerialNo) AND FIND_IN_SET('".$record->ModelId."',orders.ModelId) ");
		// 		$oresult= $oquery->row();

		// 		$tmpdata['SNoId'] = $record->SNoId;
		// 		$tmpdata['ModelId'] = $record->ModelId;
		// 		$tmpdata['SerialNo'] = $record->SerialNo;
		// 		$tmpdata['status'] = $record->status;
		// 		$tmpdata['sDate'] = $record->sDate;
		// 		$tmpdata['Name'] = $record->Name;
		// 		$tmpdata['OrderId'] = NULL;
		// 		$tmpdata['DateTime'] = NULL;

		// 		if($oresult){
		// 			$tmpdata['OrderId'] = $oresult->OrderId;
		// 			$tmpdata['DateTime'] = $oresult->DateTime;
		// 		}
		// 		$allrecords[] = $tmpdata;
		// 		// print_r($oresult);
		// 		// echo "\n\n";

		// }




		$total=$this->count_all($customfilter);
		$totalInStock=$this->count_all_stock($customfilter);
		$totalOutStock=$this->count_Out_stock($customfilter);

		return array("data"=>$data, "total"=>$total,"InStock"=>$totalInStock,"OutStock"=>$totalOutStock);
	}
	 public function count_all_stock($customfilter)
    {

			$cquery ="";
		if($customfilter !=""){
			if(isset($customfilter->modelid)){
				$cquery.= " AND serialnumber.ModelId = '".$customfilter->modelid."'";
//				$this->db->where("serialnumber.ModelId = '".$customfilter->modelid."'");
			}
// 			if($customfilter->start_date){
// 				$cdate = date('Y-m-d', strtotime($customfilter->start_date));
// 				$cquery.=" AND DATE(serialnumber.Date) >= '".$cdate."'";
// //				$this->db->where("DATE(serialnumber.Date) >= '".$cdate."'");
// 			}
// 			if($customfilter->end_date){
// 				$cdate = date('Y-m-d', strtotime($customfilter->end_date));
// 				$cquery.=" AND DATE(serialnumber.Date) <= '".$cdate."'";
// //				$this->db->where("DATE(serialnumber.Date) <= '".$cdate."'");
// 			}
		}
		 $query= $this->db->query("SELECT `SNoId`, `ModelId`, `Prefix`, `SerialNo`, `Status`, `Date` FROM `serialnumber` WHERE  NOT EXISTS(select 1 from orders where FIND_IN_SET(serialnumber.SerialNo,orders.SerialNo) AND FIND_IN_SET(serialnumber.Modelid,orders.Modelid)) $cquery ");
	 	

		return $data = count($query->result());
    }
     public function count_Out_stock($customfilter)
    {
    	$cquery ="";
		if($customfilter !=""){
			if(isset($customfilter->modelid)){
				$cquery.= " AND serialnumber.ModelId = '".$customfilter->modelid."'";
//				$this->db->where("serialnumber.ModelId = '".$customfilter->modelid."'");
			}
			if(isset($customfilter->start_date)){
				$cdate = date('Y-m-d', strtotime($customfilter->start_date));
				$cquery.=" AND DATE(serialnumber.Date) >= '".$cdate."'";
//				$this->db->where("DATE(serialnumber.Date) >= '".$cdate."'");
			}
			if(isset($customfilter->end_date)){
				$cdate = date('Y-m-d', strtotime($customfilter->end_date));
				$cquery.=" AND DATE(serialnumber.Date) <= '".$cdate."'";
//				$this->db->where("DATE(serialnumber.Date) <= '".$cdate."'");
			}
		}

    	$query= $this->db->query("SELECT `SNoId`, `ModelId`, `Prefix`, `SerialNo`, `Status`, `Date` FROM `serialnumber` WHERE   EXISTS(select 1 from orders where FIND_IN_SET(serialnumber.SerialNo,orders.SerialNo) AND FIND_IN_SET(serialnumber.Modelid,orders.Modelid))  $cquery ");
    	return $data = count($query->result());
	
    }
	
	public function get_page_where($size, $pageno, $params){

		// $this->db->limit($size, $pageno)
		// 	->select('serialnumber.SNoId,serialnumber.SerialNo,serialnumber.status,serialnumber.Date as sDate,orders.OrderId,orders.DateTime,models.Name')
		// 	->join('orders', 'orders.SerialNo = serialnumber.SerialNo', 'left outer')
		// 	->join('models', 'models.ModelId = serialnumber.ModelId', 'inner')
		// 	->group_by('serialnumber.SNoId');
		$cquery ="";
		if(isset($params->search) && !empty($params->search)){
				$cquery.= " AND s.SerialNo LIKE '%$params->search%'";
				// $this->db->where("serialnumber.SerialNo LIKE '%$params->search%'");
//				$this->db->like("catName",$params->search);
			}	
		if(isset($params->customfilter) && !empty($params->customfilter)){
			if($params->customfilter->modelid !=""){
				$cquery.= " AND s.ModelId = '".$params->customfilter->modelid."'";
			}
			if($params->customfilter->start_date){
				$cdate = date('Y-m-d', strtotime($params->customfilter->start_date));
				$cquery.=" AND DATE(s.Date) >= '".$cdate."'";
			}
			if($params->customfilter->end_date){
				$cdate = date('Y-m-d', strtotime($params->customfilter->end_date));
				$cquery.=" AND DATE(s.Date) <= '".$cdate."'";
			}
		}


	 // $query= $this->db->query("select SNoId,serialnumber.ModelId,serialnumber.SerialNo,serialnumber.status,serialnumber.Date as sDate,orders.DateTime,orders.OrderId,orders.ModelId as ordermodel,models.Name  FROM serialnumber LEFT OUTER JOIN orders on FIND_IN_SET(serialnumber.SerialNo,orders.SerialNo) INNER join models on models.Modelid = serialnumber.ModelId  
	 // 		$cquery GROUP BY `serialnumber`.`SNoId`,`serialnumber`.`ModelId` ORDER BY serialnumber.SerialNo DESC  LIMIT $pageno,$size

	 // 	");
	// $query= $this->db->query("SELECT `serialnumber`.`SNoId`, `serialnumber`.`SerialNo`, `serialnumber`.`status`, `serialnumber`.`Date` as sDate, `orders`.`OrderId`, `orders`.`DateTime`, `models`.`Name` FROM (`serialnumber`) LEFT OUTER JOIN `orders` ON FIND_IN_SET(serialnumber.SerialNo,orders.SerialNo) INNER JOIN `models` ON `models`.`ModelId` = `serialnumber`.`ModelId`  $cquery GROUP BY `serialnumber`.`SNoId`,`serialnumber`.`ModelId` ORDER BY serialnumber.SerialNo DESC  LIMIT $pageno,$size ");
	 	


		// $this->db->order_by('serialnumber.SerialNo',"asc");

//		$data = $query->result();

$query =$this->db->query("select SNoId,s.ModelId,s.SerialNo,s.status,s.Date as sDate,models.Name,OrderId,DateTime FROM serialnumber AS s LEFT OUTER JOIN orders as o ON find_in_set(s.SerialNo,o.SerialNo) AND find_in_set(s.ModelId,o.ModelId) INNER join models on models.Modelid = s.ModelId $cquery GROUP BY s.SNoId ORDER BY s.SerialNo DESC  LIMIT $pageno,$size

	 	");

		$data = $query->result();

		//$data=$this->db->get($this->table)->result();
		$total=$this->count_where($params);
		$totalInStock=$this->count_where_all_stock($params);
		$totalOutStock=$this->count_where_Out_stock($params);
		return array("data"=>$data, "total"=>$total,"InStock"=>$totalInStock,"OutStock"=>$totalOutStock);
	}
	 public function get_serialno_model($modelid)
    {

 	 $query= $this->db->query("SELECT `SNoId`, `ModelId`, `Prefix`, `SerialNo`, `Status`, `Date` FROM `serialnumber` WHERE  NOT EXISTS(select 1 from orders where FIND_IN_SET(serialnumber.SerialNo,orders.SerialNo)) AND serialnumber.ModelId = '".$modelid."' ");

		return $data = $query->result();


		// return $this->db->select('SNoId,serialnumber.SerialNo')
		// ->join('orders', 'orders.SerialNo != serialnumber.SerialNo', 'inner')
		// ->where('serialnumber.Status','1')
		// ->where('serialnumber.ModelId',$modelid)
		// ->where('serialnumber.Status','1')
		// ->group_by('serialnumber.SNoId')
		// ->get($this->table)->result();		
    }
	
	public function count_where($params)
	{	
// 		$this->db
// ->join('Navigations', 'Roles.NavigationId = Navigations.NavigationId', 'left outer');




		$cquery ="";
		if(isset($params->search) && !empty($params->search)){
				$cquery.= " AND serialnumber.SerialNo LIKE '%$params->search%'";
				// $this->db->where("serialnumber.SerialNo LIKE '%$params->search%'");
//				$this->db->like("catName",$params->search);
			}	
		if(isset($params->customfilter) && !empty($params->customfilter)){
			if($params->customfilter->modelid !=""){
				$cquery.= " AND serialnumber.ModelId = '".$params->customfilter->modelid."'";
			}
			if($params->customfilter->start_date){
				$cdate = date('Y-m-d', strtotime($params->customfilter->start_date));
				$cquery.=" AND DATE(serialnumber.Date) >= '".$cdate."'";
			}
			if($params->customfilter->end_date){
				$cdate = date('Y-m-d', strtotime($params->customfilter->end_date));
				$cquery.=" AND DATE(serialnumber.Date) <= '".$cdate."'";
			}
		}

		$query= $this->db->query("select SNoId,serialnumber.ModelId,serialnumber.SerialNo,serialnumber.status,serialnumber.Date as sDate,orders.DateTime,orders.OrderId,orders.ModelId as ordermodel,models.Name  FROM serialnumber LEFT OUTER JOIN orders on FIND_IN_SET(serialnumber.SerialNo,orders.SerialNo) INNER join models on models.Modelid = serialnumber.ModelId  
	 		$cquery GROUP BY `serialnumber`.`SNoId`,`serialnumber`.`ModelId`");

		return count($query->result()); //$this->db->count_all_results($this->table);
	}

	public function count_where_all_stock($params)
    {

			$cquery ="";
		if(isset($params->search) && !empty($params->search)){
			
				// $cdate = date('Y-m-d', strtotime($customfilter->end_date));
//				$cquery.=" AND serialnumber.SerialNo LIKE '%$params->search%' ";
			
		}
		if($params->customfilter !=""){
			if($params->customfilter->modelid !=""){
				$cquery.= " AND serialnumber.ModelId = '".$params->customfilter->modelid."'";
//				$this->db->where("serialnumber.ModelId = '".$customfilter->modelid."'");
			}
// 			if($params->customfilter->start_date){
// 				$cdate = date('Y-m-d', strtotime($params->customfilter->start_date));
// 				$cquery.=" AND DATE(serialnumber.Date) >= '".$cdate."'";
// //				$this->db->where("DATE(serialnumber.Date) >= '".$cdate."'");
// 			}
// 			if($params->customfilter->end_date){
// 				$cdate = date('Y-m-d', strtotime($params->customfilter->end_date));
// 				$cquery.=" AND DATE(serialnumber.Date) <= '".$cdate."'";
// //				$this->db->where("DATE(serialnumber.Date) <= '".$cdate."'");
// 			}
		}
		 $query= $this->db->query("SELECT `SNoId`, `ModelId`, `Prefix`, `SerialNo`, `Status`, `Date` FROM `serialnumber` WHERE  NOT EXISTS(select 1 from orders where FIND_IN_SET(serialnumber.SerialNo,orders.SerialNo) AND FIND_IN_SET(serialnumber.Modelid,orders.Modelid)) $cquery ");
	 	

		return $data = count($query->result());
    }
     public function count_where_Out_stock($params)
    {
    	$cquery ="";
		if(isset($params->search) && !empty($params->search)){
			
				// $cdate = date('Y-m-d', strtotime($customfilter->end_date));
				$cquery.=" AND serialnumber.SerialNo LIKE '%$params->search%' ";
			
		}
		if($params->customfilter !=""){
			if($params->customfilter->modelid !=""){
				$cquery.= " AND serialnumber.ModelId = '".$params->customfilter->modelid."'";
//				$this->db->where("serialnumber.ModelId = '".$customfilter->modelid."'");
			}
			if($params->customfilter->start_date){
				$cdate = date('Y-m-d', strtotime($params->customfilter->start_date));
				$cquery.=" AND DATE(serialnumber.Date) >= '".$cdate."'";
//				$this->db->where("DATE(serialnumber.Date) >= '".$cdate."'");
			}
			if($params->customfilter->end_date){
				$cdate = date('Y-m-d', strtotime($params->customfilter->end_date));
				$cquery.=" AND DATE(serialnumber.Date) <= '".$cdate."'";
//				$this->db->where("DATE(serialnumber.Date) <= '".$cdate."'");
			}
		}

		$query= $this->db->query("SELECT `SNoId`, `ModelId`, `Prefix`, `SerialNo`, `Status`, `Date` FROM `serialnumber` WHERE   EXISTS(select 1 from orders where FIND_IN_SET(serialnumber.SerialNo,orders.SerialNo) AND FIND_IN_SET(serialnumber.Modelid,orders.Modelid)) $cquery ");
    	return $data = count($query->result());
    }
	

     public function check_serialnumber_order($modelid,$snumber)
    {
		$query= $this->db->query("SELECT `SNoId`, `ModelId`, `Prefix`, `SerialNo`, `Status`, `Date` FROM `serialnumber` WHERE   EXISTS(select 1 from orders where FIND_IN_SET(serialnumber.SerialNo,orders.SerialNo) AND FIND_IN_SET($modelid,orders.ModelId)) AND serialnumber.SerialNo = '".$snumber."' AND  serialnumber.ModelId ='".$modelid."'") ;
    	return $data = count($query->result());
    }
     public function check_serialnumber($modelid,$snumber)
    {
		$query= $this->db->query("SELECT `SNoId`, `ModelId`, `Prefix`, `SerialNo`, `Status`, `Date` FROM `serialnumber` WHERE serialnumber.SerialNo = '".$snumber."' AND  serialnumber.ModelId ='".$modelid."'") ;
    	return $data = count($query->result());
    }





    public function count_all($customfilter)
	{
		$cquery ="";
		if($customfilter !=""){
			if(isset($customfilter->modelid)){

				$cquery.= " AND serialnumber.ModelId = '".$customfilter->modelid."'";
			}
			if(isset($customfilter->start_date)){
				$cdate = date('Y-m-d', strtotime($customfilter->start_date));
				$cquery.=" AND DATE(serialnumber.Date) >= '".$cdate."'";
			}
			if(isset($customfilter->end_date)){
				$cdate = date('Y-m-d', strtotime($customfilter->end_date));
				$cquery.=" AND DATE(serialnumber.Date) <= '".$cdate."'";
			}
		}

		$query= $this->db->query("select SNoId,serialnumber.ModelId,serialnumber.SerialNo,serialnumber.status,serialnumber.Date as sDate,orders.DateTime,orders.OrderId,orders.ModelId as ordermodel,models.Name  FROM serialnumber LEFT OUTER JOIN orders on FIND_IN_SET(serialnumber.SerialNo,orders.SerialNo) INNER join models on models.Modelid = serialnumber.ModelId  
	 		$cquery GROUP BY `serialnumber`.`SNoId`,`serialnumber`.`ModelId`");

		return count($query->result());
	}
    public function get($id)
    {
        return $this->db->where('ModelId', $id)->get($this->table)->row();
    }
    public function checkSerialNoInOrder($id)
    {

		return $this->db->query("SELECT *  FROM `orders` WHERE FIND_IN_SET($id,orders.SerialNo)")->row();

    }
    public function checkSerialNoAndModelNo($id,$sId)
    {
        return $this->db->where('ModelId', $id)->where('SerialNo', $sId)->get($this->table)->row();
    }


  
    public function add($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        return $this->db->where('ModelId', $id)->update($this->table, $data);
    }

    public function delete($id)
    {
        $this->db->where('SNoId', $id)->delete($this->table);
        return $this->db->affected_rows();
    }
    public function changestatus($id, $data)
    {
        return $this->db->where('ModelId', $id)->update($this->table, $data);
    }
	
}

?>