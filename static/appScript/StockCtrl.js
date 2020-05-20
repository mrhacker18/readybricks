
function StockCtrl($scope, $http){	
	$scope.auth=getAuth();
	this.init($scope);	
	$scope.customfilter = '';
		
	//Grid,dropdown data loading
	loadGridData($scope.pagingOptions.pageSize,1);
 	loadData('get_Model_list',{}).success(function(data){$scope.ModelList=data;});
	
	//CRUD operation
	$scope.saveItem=function(){	
		var record={};
		$scope.errors = {};
		$scope.nameError =false;
		if($scope.category==null || $scope.category=="" ){
            $scope.nameError = true;
            $scope.errors.nameMsg = 'Please enter category name.';
            return false;
        }
		if($scope.category.name==null || $scope.category.name=="" ){
            $scope.nameError = true;
            $scope.errors.nameMsg = 'Please enter category name.';
            return false;
        }
		angular.extend(record,$scope.category);
				//record.name=undefined;

		loadData('save',record).success(function(data){

            $.bootstrapGrowl('<h4>Success!</h4> <p>'+data.msg+'</p>', {
                type: 'success',
                delay: 2500,
                allow_dismiss: true
            });
			//toastr.success(data.msg);
			if(data.success){
				loadGridData($scope.pagingOptions.pageSize, $scope.pagingOptions.currentPage);
			}
			$scope.fgShowHide=true;			
			$scope.item=null;
		});
	};			
	$scope.editItem=function(row){	
		$scope.item=row.entity;
		
		$scope.fgShowHide=false;				
	};
	$scope.FindStock=function(){	
		$scope.searchparams = {};
		if($scope.item !=null && $scope.item.ModelId !=null){
			$scope.searchparams.modelid = $scope.item.ModelId.ModelId;
		}
		if($("#StartDate").val() !='' || $("#EndDate").val() !=''){
			$scope.searchparams.start_date = $("#StartDate").val(); //$scope.filter.start_date;
			$scope.searchparams.end_date = $("#EndDate").val(); //$scope.filter.end_date;
		}
		loadGridData($scope.pagingOptions.pageSize,$scope.pagingOptions.currentPage,$scope.searchparams);
	};
	$scope.fixDate = function(date){
    return new Date(date);
	};


	$scope.deleteItem=function(row){
		if(confirm('Delete sure!')){
			var id = {'id':row};
			loadData('delete',id).success(function(data){
				loadGridData($scope.pagingOptions.pageSize,$scope.pagingOptions.currentPage);
		            $.bootstrapGrowl('<h4>Success!</h4> <p>Data removed successfully</p>', {
		                type: 'info',
		                delay: 2500,
		                allow_dismiss: true
		            });
			});
		}
	};
	$scope.changeItemStatus=function(row,status){
			var data = {'id':row,'status':status};
			loadData('changestatus',data).success(function(data){
				loadGridData($scope.pagingOptions.pageSize,$scope.pagingOptions.currentPage);
		            $.bootstrapGrowl('<h4>Success!</h4> <p>'+data.msg+'</p>', {
		                type: 'info',
		                delay: 2500,
		                allow_dismiss: true
		            });
			});
	};
	
	//pager events
	
	$scope.setPage = function(page){
console.log(page);
		$scope.pagingOptions.currentPage=page + 1;
	 	loadGridData($scope.pagingOptions.pageSize, $scope.pagingOptions.currentPage);
	}

	//search
	$scope.doSearch=function(){
		$scope.searchparams = "";
		if(isSearch()){
			$scope.searchparams = {};
			$scope.searchparams.modelid = "";
			if($scope.item !=null && $scope.item.ModelId !=null){
				$scope.searchparams.modelid = $scope.item.ModelId.ModelId;
			}
			$scope.searchparams.start_date = $("#StartDate").val(); //$scope.filter.start_date;
			$scope.searchparams.end_date = $("#EndDate").val(); //$scope.filter.end_date;
		}
		loadGridData($scope.pagingOptions.pageSize, 1,$scope.searchparams);
	};
	
	//Utility functions
	function isSearch(){
		if(!$scope.search) return false;
		for(var prop in $scope.search){
			if($scope.search.hasOwnProperty(prop) && $scope.search[prop]) return true;
		}
		return false;
	}
	function loadGridData(pageSize, currentPage,customfilter = ''){
		var customfilter = customfilter ? customfilter : $scope.customfilter;

		var action=isSearch()?'get_page_where':'get_page', params={size:pageSize, pageno:(currentPage-1)*pageSize,customfilter : customfilter};
		
//		angular.extend( params, $scope.search);
		params['search']=$scope.search;
		loadData(action,params).success(function(res){
			$scope.list=res.data;
		    $scope.totalpaging=Math.ceil(res.total/$scope.pagingOptions.pageSize);
    console.log($scope.totalpaging);
			console.log($scope.pagingOptions.currentPage);
			if($scope.pagingOptions.currentPage >1){
				$scope.currentindex = (($scope.pagingOptions.currentPage - 1) * 30) + 1;
			}else{
			$scope.currentindex = 1;

			}
			$scope.totalItems=res.total;
			$scope.TotalInStock="";
			$scope.TotalOutOfStock="";

			if(Object.keys(customfilter).length != 0){
				$scope.TotalInStock=res.InStock;
				$scope.TotalOutOfStock=res.OutStock;
			}

		});
	}
	function loadData(action,data){
		return $http({
			  method: 'POST',
			  url: BASE_URL+'Stock_ctrl/'+action,
			  data: data,
			  headers: {'Content-Type': 'application/x-www-form-urlencoded'}			  
			});		
	}
	function getDate(source){		
		if(typeof source ==='string'){;
			var dt=source.split(' ')[0];
			return new Date(dt);
		}
		return source;
	}
}
 StockCtrl.prototype.init=function($scope){
	$scope.search=null;
	$scope.item=null;
	$scope.list = null;
	$scope.fgShowHide=true;
	
	$scope.searchDialog=false;
	$scope.DepartmentList=null;	
	
	this.configureGrid($scope);	
	this.searchPopup($scope);

 };
StockCtrl.prototype.configureGrid=function($scope){
	$scope.totalItems = 0;
    $scope.pagingOptions = {
        pageSizes: [10, 20, 30, 50, 100, 500, 1000],
        pageSize: 30,
        currentPage: 1
    };	
	

};
StockCtrl.prototype.searchPopup=function($scope){
	$scope.showForm=function(){$scope.fgShowHide=false; $scope.category=null;};
	
	$scope.hideForm=function(){$scope.fgShowHide=true;};
	$scope.openSearchDialog=function(){		
		$scope.searchDialog=true;
	};
	$scope.closeSearchDialog=function(){		
		$scope.searchDialog=false;
	};	
	$scope.refreshSearch=function(){$scope.search=null;};
	
};