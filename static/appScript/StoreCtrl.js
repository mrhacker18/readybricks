
function StoreCtrl($scope, $http){	
	$scope.auth=getAuth();
	this.init($scope);	
	
	//Grid,dropdown data loading
	loadGridData($scope.pagingOptions.pageSize,1);
		// 	loadData('get_Roles_list',{}).success(function(data){$scope.RolesList=data;});
		// loadData('get_Navigations_list',{}).success(function(data){$scope.NavigationsList=data;});

	
	//CRUD operation
	$scope.saveItem=function(){	
		var record={};
		angular.extend(record,$scope.item);
				record.Roles_RoleName=undefined;
		record.Navigations_NavName=undefined;

		loadData('save',record).success(function(data){
	            $.bootstrapGrowl('<h4>Success!</h4> <p>'+data.msg+'</p>', {
	                type: 'info',
	                delay: 2500,
	                allow_dismiss: true
	            });
			if(data.success){
				loadGridData($scope.pagingOptions.pageSize, $scope.pagingOptions.currentPage);
			}			
			$scope.fgShowHide=true;
		});
	};			
	$scope.editItem=function(row){	
		$scope.item=row;
		$scope.fgShowHide=false;				
		$("#baseimagename").attr('src','');
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
	$scope.getfilename=function(file){

 		var reader = new FileReader();
		reader.readAsDataURL(file.files[0]);
		reader.onload = function (e) {
			var data = e.target.result.replace(/^data:image\/\w+;base64,/, "");
			$scope.item.baseimage =  e.target.result;//data;
			$("#baseimagename").attr('src',e.target.result);
		}

	}
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
	$scope.setPage = function(page){

		$scope.pagingOptions.currentPage=page + 1;
	 	loadGridData($scope.pagingOptions.pageSize, $scope.pagingOptions.currentPage);
	}
	//pager events
	// $scope.$watch('pagingOptions', function (newVal, oldVal) {
	// 	if (newVal !== oldVal && newVal.currentPage !== oldVal.currentPage) {		  
	// 	  loadGridData($scope.pagingOptions.pageSize, $scope.pagingOptions.currentPage);
	// 	}
	// 	else if (newVal !== oldVal && newVal.pageSize !== oldVal.pageSize) {		  
	// 	  loadGridData($scope.pagingOptions.pageSize, 1);
	// 	}
	// }, true);
	
	//search
	$scope.doSearch=function(){
		loadGridData($scope.pagingOptions.pageSize, 1);
	};
	
	//Utility functions
	function isSearch(){
		if(!$scope.search) return false;
		for(var prop in $scope.search){
			if($scope.search.hasOwnProperty(prop) && $scope.search[prop]) return true;
		}
		return false;
	}
	function loadGridData(pageSize, currentPage){
		var action=isSearch()?'get_page_where':'get_page', params={size:pageSize, pageno:(currentPage-1)*pageSize};
//		angular.extend( params, $scope.search);
		params['search']=$scope.search;
		loadData(action,params).success(function(res){
			$scope.list=res.data;
			$scope.totalpaging=Math.ceil(res.total/$scope.pagingOptions.pageSize);
			console.log($scope.totalpaging);
			$scope.totalItems=res.total
		});
	}
	function loadData(action,data){
		return $http({
			  method: 'POST',
			  url: BASE_URL+'Users_ctrl/'+action,
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
 UsersCtrl.prototype.init=function($scope){
	$scope.search=null;
	$scope.item=null;
	$scope.list = null;
	$scope.fgShowHide=true;
	$scope.searchDialog=false;
	$scope.DepartmentList=null;	

	this.configureGrid($scope);	
	this.searchPopup($scope);
 };
UsersCtrl.prototype.configureGrid=function($scope){
	$scope.totalItems = 0;
    $scope.pagingOptions = {
        pageSizes: [10, 20, 30, 50, 100, 500, 1000],
        pageSize: 5,
        currentPage: 1
    };	

};
UsersCtrl.prototype.searchPopup=function($scope){
	$scope.showForm=function(){$scope.fgShowHide=false; $scope.item=null;}; 
	$scope.hideForm=function(){$scope.fgShowHide=true;};
	$scope.openSearchDialog=function(){		
		$scope.searchDialog=true;
	};
	$scope.closeSearchDialog=function(){		
		$scope.searchDialog=false;
	};	
	$scope.refreshSearch=function(){$scope.search=null;};
	
};