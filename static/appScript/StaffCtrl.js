
function StaffCtrl($scope, $http){	
	$scope.auth=getAuth();
	this.init($scope);	
	
	//Grid,dropdown data loading
	loadGridData($scope.pagingOptions.pageSize,1);
		// 	loadData('get_Roles_list',{}).success(function(data){$scope.RolesList=data;});
		// loadData('get_Navigations_list',{}).success(function(data){$scope.NavigationsList=data;});

	
	//CRUD operation
	$scope.saveItem=function(){	
		var record={};

		$scope.errors = {};
		$scope.firstnameError =false;
		$scope.lastnameError =false;
		$scope.addressError =false;
		$scope.phonenumberError =false;
		$scope.locationError =false;
		$scope.emailError =false;
		$scope.usernameError =false;
		$scope.passwordError =false;
		if($scope.item==null || $scope.item=="" ){
            $scope.firstnameError = true;
            $scope.errors.firstnameMsg = 'Please enter firstname.';
            return false;
        }
		if($scope.item.FirstName==null || $scope.item.FirstName=="" ){
            $scope.firstnameError = true;
            $scope.errors.firstnameMsg = 'Please enter firstname.';
            return false;
        }
		if($scope.item.LastName==null || $scope.item.LastName=="" ){
            $scope.lastnameError = true;
            $scope.errors.lastnameMsg = 'Please enter lastname.';
            return false;
        }
		if($scope.item.Address==null || $scope.item.Address=="" ){
            $scope.addressError = true;
            $scope.errors.addressMsg = 'Please enter address.';
            return false;
        }
		if($scope.item.PhoneNumber==null || $scope.item.PhoneNumber=="" ){
            $scope.phonenumberError = true;
            $scope.errors.phonenumberMsg = 'Please enter phone number.';
            return false;
        }
		// if($scope.item.Location==null || $scope.item.Location=="" ){
  //           $scope.locationError = true;
  //           $scope.errors.locationMsg = 'Please enter location.';
  //           return false;
  //       }
        if($scope.item.Email==null || $scope.item.Email=="" ){
            $scope.emailError = true;
            $scope.errors.emailMsg = 'Please enter email.';
            return false;
        }
        if($scope.item.Username==null || $scope.item.Username=="" ){
            $scope.usernameError = true;
            $scope.errors.usernameMsg = 'Please enter username.';
            return false;
        }
		if($scope.item.Password==null || $scope.item.Password=="" ){
            $scope.passwordError = true;
            $scope.errors.passwordMsg = 'Please enter password.';
            return false;
        }
		angular.extend(record,$scope.item);

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
			$("#baseimagename").attr('src','');
		});
	};			
	$scope.editItem=function(row){	
		$scope.item=row;
		$scope.item.Username=row.UserName;
		$scope.fgShowHide=false;			
		$("#baseimagename").attr('src','uploads/'+row.Image);
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
			  url: BASE_URL+'Staff_ctrl/'+action,
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
 StaffCtrl.prototype.init=function($scope){
	$scope.search=null;
	$scope.item=null;
	$scope.list = null;
	$scope.fgShowHide=true;
	$scope.searchDialog=false;
	$scope.DepartmentList=null;	

	this.configureGrid($scope);	
	this.searchPopup($scope);
 };
StaffCtrl.prototype.configureGrid=function($scope){
	$scope.totalItems = 0;
    $scope.pagingOptions = {
        pageSizes: [10, 20, 30, 50, 100, 500, 1000],
        pageSize: 30,
        currentPage: 1
    };	

};
StaffCtrl.prototype.searchPopup=function($scope){
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