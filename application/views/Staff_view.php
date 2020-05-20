<script src="static/appScript/StaffCtrl.js"></script>
<script>function getAuth(){ <?php echo $fx ?>;}</script>
<?php if ($read): ?>
<div ng-controller="StaffCtrl">
<ul class="breadcrumb breadcrumb-top">
    <li><a href="<?php echo base_url(); ?>index.php/#/">Dashboard</a></li>
    <li>Staff</li>
</ul>

<div ng-show="fgShowHide">
	 <!-- Datatables Content -->
     <?php ?>
    <div class="block full">
    	<div class="block-title">
           <div class="block-options pull-right">
            <a href="javascript:void(0)" class="btn  btn-sm btn-primary toggle-bordered enable-tooltip" data-toggle="button" title="" data-original-title="Toggles .form-bordered class" aria-pressed="false" ng-show="auth.insert" ng-click="showForm()" >Add Staff</a>
            </div>
            <h2><strong>Manage</strong> Staff</h2>
        </div>
        <div class="table-responsive">
        <div class="col-md-3 padding0 col-md-offset-9">
                <label>
                <div class="input-group">
                    <input type="search"  class="form-control" placeholder="Search" ng-model="search" ng-change="doSearch()"><span class="input-group-addon"><i class="fa fa-search"></i></span>
                </div>
                </label>
        </div>

        <table class="table table-bordered bordered table-striped table-condensed datatable" >
        	<!-- <table id="example-datatable" class="table table-vcenter table-condensed table-bordered"> -->
                <thead>
                    <tr>
	                    <th class="text-center">Name</th>
	                    <th class="text-center">Address</th>
	                    <th class="text-center">Location</th>
	                    <th class="text-center">Number</th>
	                    <th class="text-center">Prof. Picture</th>
	                    <th class="text-center">Email</th>
	                    <th class="text-center">Username</th>
	                    
                        <th class="text-center">Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>


                	<tr ng-repeat="user in list">
                		<td>{{user.FirstName}} {{user.LastName}}</td>
                		<td>{{user.Address}}</td>
                		<td>{{user.Location}}</td>
                		<td>{{user.PhoneNumber}}</td>
                		<td><img src="uploads/{{user.Image}}" width="100px"></td>
                		<td>{{user.Email}}</td>
                		<td>{{user.UserName}}</td>
                        <td>
                        	<lable ng-show="user.Status == '1'" class="label label-primary">Active</lable>
                        	<lable ng-show="user.Status == '0'" class="label label-warning">Deactive</lable>
                        </td>
                        <td>
                        	<button type="button" class="btn  btn-xs btn-info" ng-click="editItem(user)">Edit</button>
                        	
                            <button type="button" class="btn btn-xs btn-primary" ng-show="user.Status == '0'" ng-click="changeItemStatus(user.UserId,1)">Active</button>
                        	<button type="button" class="btn  btn-xs btn-warning" ng-show="user.Status == '1'" ng-click="changeItemStatus(user.UserId,0)">Deactive</button>&nbsp;&nbsp;
                        	<button type="button" class="btn  btn-xs btn-danger" ng-click="deleteItem(user.UserId)">Delete</button> </td>
                	</tr>
                  	<tr ng-show="list.length ==0"><td colspan="10" class="text-center">User Not found</td></tr>
                     
                </tbody>
                </table>
	    </div>
	    <div class="row">
	    <div class="col-sm-5 hidden-xs">
	    	
        </div>
	    	<div class="col-sm-7 col-xs-12 clearfix">
	    		<div class="dataTables_paginate paging_bootstrap">
              
	    			<ul class="pagination pagination-sm remove-margin">
	    			      <li  class="prev" ng-class="{disabled: pagingOptions.currentPage == 1}">
                              <a href="javascript:void(0)" ng-click="setPage(0)"  ><i class="fa fa-chevron-left"></i> 
                            </a>               
                        </li>
                        <li ng-repeat="n in [].constructor(totalpaging) track by $index"
                        ng-class="{active: $index == pagingOptions.currentPage - 1}" data-paging-options="$index">
                        <a href="javascript:void(0)" ng-bind="$index + 1" ng-click="setPage($index)" data-paging-options="$index"></a>
                        </li>
    					<li class="next"  ng-class="{disabled: pagingOptions.currentPage == totalpaging || totalItems == 0}"><a href="javascript:void(0)" ng-click="setPage(pagingOptions.currentPage)"> <i class="fa fa-chevron-right"></i></a>
    					</li>
					</ul>
				</div>
			</div>
		</div>
	     
	</div>

</div>





<!-- <div ng-show="fgShowHide" class="btn-toolbar">
	<div class="btn-group">
	 <button type="button" ng-show="auth.insert" ng-click="showForm()" class="btn btn-success" ><i class="icon-plus icon-white"></i><b> Add Item</b></button>
	  <button type="button" ng-click="openSearchDialog()"  class="btn btn-inverse" ng-click="getMysqlScript()"><i class="icon-search icon-white"></i><b> Quick Search	</b> </button>
	</div>
</div> -->
<!-- <div ng-show="fgShowHide" class="gridStyle" ng-grid="gridOptions"></div>
 -->







<div ng-show="!fgShowHide" style="display:none">



<div class="block">
    <!-- Basic Form Elements Title -->
    <div class="block-title">
        <h2><strong>Edit</strong> Staff</h2>
    </div>
    <!-- END Form Elements Title -->
    <form action="#"  name="myForm" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" onsubmit="return false;">
		<div class="row">
    		<div class="col-md-6">
		        <div class="form-group" ng-class="firstnameError ? 'has-error':''">
		            <label class="col-md-3 control-label" for="example-text-input">First Name</label>
		            <div class="col-md-9">
		                <input type="text" name="FirstName" id="FirstName" ng-model="item.FirstName"  class="form-control" placeholder="FirstName">
                        <span ng-show="firstnameError" ng-bind="errors.firstnameMsg" class="help-block"></span>
		            </div>
		        </div>
        	</div>
    		<div class="col-md-6">
        		<div class="form-group" ng-class="lastnameError? 'has-error':''">
        		<label class="col-md-3 control-label" for="example-text-input">Last Name</label>
	            <div class="col-md-9">
	                <input type="text"  name="LastName" id="LastName" ng-model="item.LastName"  class="form-control" placeholder="Last Name">
	               <span ng-show="lastnameError" ng-bind="errors.lastnameMsg" class="help-block"></span>
	            </div>
    			</div>
    		</div>
    	</div>
    	<div class="row">
        <div class="col-md-6">
        <div class="form-group" ng-class="addressError ? 'has-error':''">
            <label class="col-md-3 control-label" for="example-text-input">Address</label>
            <div class="col-md-9">
                <textarea name="address" id="Address" ng-model="item.Address"  class="form-control" placeholder="Address"></textarea> 
                <span ng-show="addressError" ng-bind="errors.addressMsg" class="help-block"></span>
        </div>
        </div>
        </div>
        <div class="col-md-6">
        <div class="form-group" ng-class="phonenumberError ? 'has-error':''">
            <label class="col-md-3 control-label" for="example-text-input">Phone Number</label>
            <div class="col-md-9">
                <input type="text"  name="PhoneNumber" id="PhoneNumber" ng-model="item.PhoneNumber"  class="form-control" placeholder="Phone Number">
                <span ng-show="phonenumberError" ng-bind="errors.phonenumberMsg" class="help-block"></span>
            </div>
        </div>
        </div>
        </div>
        <div class="row">
        <div class="col-md-6">
        <div class="form-group" ng-class="myForm.image.$invalid ? 'has-error':''">
            <label class="col-md-3 control-label" for="example-text-input">Profile Picture</label>
            <div class="col-md-9">
                <input type="file"  name="image" id="image" ng-model="item.image" class="form-control" placeholder="Image" onchange="angular.element(this).scope().getfilename(this)">
             
                <img  id="baseimagename"  width="100px" height="80px">
                <!-- <span ng-show="myForm.Image.$error.required" class="help-block">Required</span> -->
            </div>
        </div>
        </div>
        <div class="col-md-6">
<!--         <div class="form-group" ng-class="locationError? 'has-error':''">
            <label class="col-md-3 control-label" for="example-text-input">Location</label>
            <div class="col-md-9">
                <input type="text"  name="Location" id="Location" ng-model="item.Location"  class="form-control" placeholder="Latitude,Longitude">
                <span ng-show="locationError" ng-bind="errors.locationMsg" class="help-block"></span>
            </div>
        </div>
 -->        <div class="form-group" ng-class="emailError? 'has-error':''">
            <label class="col-md-3 control-label" for="example-text-input">Email</label>
            <div class="col-md-9">
                <input type="text"  name="Email" id="Email" ng-model="item.Email"  class="form-control" placeholder="Email">
                <span ng-show="emailError" ng-bind="errors.emailMsg" class="help-block"></span>
            </div>
        </div>
        <div class="form-group" ng-class="usernameError? 'has-error':''">
            <label class="col-md-3 control-label" for="example-text-input">Username</label>
            <div class="col-md-9">
                <input type="text"  name="Username" id="Username" ng-model="item.Username"  class="form-control" placeholder="Username">
                <span ng-show="usernameError" ng-bind="errors.usernameMsg" class="help-block"></span>
            </div>
        </div>
        
        <div class="form-group" ng-class="passwordError ? 'has-error':''">
            <label class="col-md-3 control-label" for="example-text-input">Password</label>
            <div class="col-md-9">
                <input type="text"  name="Password" id="Password" ng-model="item.Password"  class="form-control" placeholder="Password">
                <span ng-show="passwordError" ng-bind="errors.passwordMsg" class="help-block"></span>
            </div>
        </div>
        </div>
        </div>

        <div class="form-group form-actions">
            <div class="col-md-4 col-md-offset-5">
                <button   ng-click="saveItem()"   class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Submit</button>
                <button class="btn btn-warning cancel" ng-click="hideForm()"><i class="icon-close icon-white"></i>Cancel</button>
            </div>
        </div>
    </form>
                                  
</div>
<!--
	<form name="myForm" class="form-horizontal well">
	   <fieldset>  
          <legend>Users</legend>  
		  <div class="control-group" ng-class="{error: myForm.UserName.$invalid}">
		<label class="control-label" for="UserName">UserName</label>
		<div class="controls">
		  <input class="input-xlarge" type="text" name="UserName" id="UserName" ng-model="item.UserName" required />
		  <span ng-show="myForm.UserName.$error.required" class="help-inline">Required</span>
		</div>
	  </div>
 <div class="control-group" ng-class="{error: myForm.Password.$invalid}">
		<label class="control-label" for="Password">Password</label>
		<div class="controls">
		  <input class="input-xlarge" type="password" name="Password" id="Password" ng-model="item.Password" required />
		  <span ng-show="myForm.Password.$error.required" class="help-inline">Required</span>
		</div>
	  </div>
 <div class="control-group" ng-class="{error: myForm.FirstName.$invalid}">
		<label class="control-label" for="FirstName">FirstName</label>
		<div class="controls">
		  <input class="input-xlarge" type="text" name="FirstName" id="FirstName" ng-model="item.FirstName" required />
		  <span ng-show="myForm.FirstName.$error.required" class="help-inline">Required</span>
		</div>
	  </div>
 <div class="control-group" ng-class="{error: myForm.LastName.$invalid}">
		<label class="control-label" for="LastName">LastName</label>
		<div class="controls">
		  <input class="input-xlarge" type="text" name="LastName" id="LastName" ng-model="item.LastName" required />
		  <span ng-show="myForm.LastName.$error.required" class="help-inline">Required</span>
		</div>
	  </div>
 <div class="control-group" ng-class="{error: myForm.Email.$invalid}">
		<label class="control-label" for="Email">Email</label>
		<div class="controls">
		  <input type="email" name="Email" id="Email" ng-model="item.Email" required />
		  <span ng-show="myForm.Email.$error.required" class="help-inline">Required</span>
		  <span ng-show="myForm.Email.$error.email" class="help-inline">Not a valid email</span>
		</div>
	  </div>
 <div class="control-group" ng-class="{error: myForm.Role.$invalid}">
		<label class="control-label" for="Role">Role</label>
		<div class="controls">
		  <select ng-options="s.RoleId as s.RoleName for s in RolesList"  name="Role" id="Role" ng-model="item.Role" required ></select>
		  <span ng-show="myForm.Role.$error.required" class="help-inline">Required</span>
		</div>
	  </div>
<div class="control-group" ><label class="control-label" for="NavigationId">NavigationId</label>
		<div class="controls">
		  <select ng-options="s.NavigationId as s.NavName for s in NavigationsList"  name="NavigationId" id="NavigationId" ng-model="item.NavigationId" ></select>		  
		</div></div>
<div class="control-group" ><label class="control-label" for="IsActive">IsActive</label>
		<div class="controls">
		  <input  type="checkbox" ng-true-value="1" ng-false-value="0" name="IsActive" id="IsActive" ng-model="item.IsActive" />		  
		</div></div>
	
		  <div class="form-actions">
			<button ng-click="saveItem()" ng-disabled="myForm.$invalid" class="btn btn-primary"><i class="icon-ok icon-white"></i> Save</button>
			 <button class="btn btn-warning cancel" ng-click="hideForm()"><i class="icon-close icon-white"></i>Cancel</button>		
		  </div>
	  </fieldset>
	</form>-->
</div>
<div modal="searchDialog"  options="opts">
        <div class="modal-header">
		 <a class="close" ng-click="closeSearchDialog()" data-dismiss="modal">&times;</a>
            <h3>Users</h3>
        </div>
        <div class="modal-body">
           <form name="myForm" class="form-horizontal">
  			 <div class="control-group" ><label class="control-label" for="UserName">UserName</label>
		<div class="controls">
		  <input class="input-xlarge" type="text" name="UserName" id="UserName" ng-model="search.UserName" />		  
		</div></div>
<div class="control-group" ><label class="control-label" for="FirstName">FirstName</label>
		<div class="controls">
		  <input class="input-xlarge" type="text" name="FirstName" id="FirstName" ng-model="search.FirstName" />		  
		</div></div>
<div class="control-group" ><label class="control-label" for="LastName">LastName</label>
		<div class="controls">
		  <input class="input-xlarge" type="text" name="LastName" id="LastName" ng-model="search.LastName" />		  
		</div></div>
<div class="control-group" >
			<label class="control-label" for="Email">Email</label>
		<div class="controls">
		  <input type="email" name="Email" id="Email" ng-model="item.Email" />
			
		</div></div>
<div class="control-group" ><label class="control-label" for="Role">Role</label>
		<div class="controls">
		  <select ng-options="s.RoleId as s.RoleName for s in RolesList"  name="Role" id="Role" ng-model="search.Role" ></select>		  
		</div></div>
<div class="control-group" ><label class="control-label" for="NavigationId">NavigationId</label>
		<div class="controls">
		  <select ng-options="s.NavigationId as s.NavName for s in NavigationsList"  name="NavigationId" id="NavigationId" ng-model="search.NavigationId" ></select>		  
		</div></div>
<div class="control-group" ><label class="control-label" for="IsActive">IsActive</label>
		<div class="controls">
		  <input  type="checkbox" ng-true-value="1" ng-false-value="0" name="IsActive" id="IsActive" ng-model="search.IsActive" />		  
		</div></div>
	   
			</form>
        </div>
        <div class="modal-footer">
            <button class="btn btn-warning cancel" ng-click="closeSearchDialog()"><i class="icon-close icon-white"></i>Cancel</button>
			<button class="btn btn-primary cancel" ng-click="refreshSearch()"><i class="icon-refresh icon-white"></i> Refresh</button>
			 <button class="btn btn-primary cancel" ng-click="doSearch()"><i class="icon-search icon-white"></i> Search</button>
        </div>
</div>
<?php else: ?>
<p> Not permitted</p>
<?php endif; ?>
