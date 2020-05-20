<script src="static/appScript/RolesCtrl.js"></script>
<script>function getAuth(){ <?php echo $fx ?>;}</script>
<?php if ($read): ?>
<div ng-controller="RolesCtrl">
<div class="element-wrapper" ng-show="fgShowHide">
                <h6 class="element-header">
                  Manage Roles
                </h6>
                <div class="element-box">
                  <div class="form-desc">
	 					<button type="button" ng-show="auth.insert" ng-click="showForm()" class="btn btn-success" ><i class="icon-plus icon-white"></i><b> Add </b></button>

                  </div>
                  <div class="table-responsive">
						<div class="row">
							<div class="col-sm-12 col-md-6">
								<div class="dataTables_length" id="dataTable1_length"><label>Show 
									<select name="dataTable1_length" aria-controls="dataTable1" class="form-control form-control-sm rounded bright" style="width:75px">
										<option value="10">10</option>
										<option value="25">25</option>
										<option value="50">50</option>
										<option value="100">100</option>
									</select> entries </label>
								</div>
							</div>
							<div class="col-sm-12 col-md-6">
								<div id="dataTable1_filter" class="dataTables_filter float-right">
									<label>Search:
										<input type="search" class="form-control form-control-sm rounded bright" placeholder="" aria-controls="dataTable1">
									</label>
								</div>
							</div>
						</div>
                		<table  width="100%" class="table table-lightborder">
                    	<thead>
                    		<tr>
                    			<th>Name</th>
                    			<th>Permission</th>
                    			<th>Status</th>
                    			<th>Action</th>
                    		</tr>
                    	</thead>
                    	<tfoot>
                    		<tr>
                    			<th>Name</th>
                    			<th>Permission</th>
                    			<th>Status</th>
                    			<th>Action</th>
                    		</tr>
                    	</tfoot>
                    	<tbody>
                    		<tr>
                    			<td>Admin</td>
                    			<td>10</td>
                    			<td><lable class="btn btn-success btn-rounded">Active</lable></td>
                    			<td>
                    				<button class="mb-2 btn btn-outline-info " ng-click="editItem(item)" type="button">  <i class="os-icon os-icon-ui-49" style="margin-top: -3px;"></i></button>
                    				<button class=" mb-2 btn btn-outline-danger " ng-click="editItem(item)" type="button"> <i class="os-icon os-icon-ui-15" style="margin-top: -3px;"></i></button>
				              	</td>
                    		</tr>

                    		</tbody></table>



                  </div>
							<div class="row">
								<div class="col-sm-12 col-md-5">
<!-- 									<div class="dataTables_info" id="dataTable1_info" role="status" aria-live="polite">Showing 1 to 5 of 5 entries</div>
--></div>
 									<div class="col-sm-12 col-md-7">
										<div class="dataTables_paginate paging_simple_numbers float-right" id="dataTable1_paginate">
											<ul class="pagination">
												<li class="paginate_button page-item previous disabled" id="dataTable1_previous">
														<a href="#" aria-controls="dataTable1" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
												</li>
												<li class="paginate_button page-item active">
													<a href="#" aria-controls="dataTable1" data-dt-idx="1" tabindex="0" class="page-link">1</a>
												</li>
												<li class="paginate_button page-item next disabled" id="dataTable1_next">
													<a href="#" aria-controls="dataTable1" data-dt-idx="2" tabindex="0" class="page-link">Next</a>
												</li>
											</ul>
										</div>
									</div>
								</div>

                </div>

              </div>






<div ng-show="!fgShowHide" style="display:none">
    <div class="element-wrapper">
                <h6 class="element-header">
                  Add Roles
                </h6>
      <div class="element-box">
                  <div class="form-desc">
	 					<button type="button"  ng-click="hideForm()" class="btn btn-success" ><i class="icon-plus icon-white"></i><b> Back </b></button>

                  </div>
        <form name="myForm">
          <div class="form-group  " ng-class="{'has-error has-danger': myForm.Name.$invalid}">
            <label for=""> Name</label>
            <input class="form-control" placeholder="Enter Name" type="name" name="Name" id="Name" ng-model="item.Name" required>
    		  <span ng-show="myForm.Name.$error.required" class="help-block form-text text-muted form-control-feedback">This field required</span>

          </div>
          <div class="form-group">
            <label for=""> Permission</label>
            <div class="row">
            <div class="col-sm-4">
            	<h5>Menu</h5>
            </div>
            <div class="col-sm-2 text-center">
            	<h5>IsInsert</h5>
            </div>
            <div class="col-sm-2 text-center">
            	<h5>IsUpdate</h5>
            </div>
            <div class="col-sm-2 text-center">
            	<h5>IsInsert</h5>
            </div>
        	</div>
        	<div class="row" ng-repeat="Navigations in NavigationsList">
        		<div class="col-sm-4">
					  <input  type="checkbox" ng-true-value="1" ng-false-value="0" name="NavName[]" id="NavName_{{Navigations.NavigationId}}" ng-model="item.NavName" />		  
        			{{Navigations.NavName}}
        		</div>
	            <div class="col-sm-2 text-center">
					  <input  type="checkbox" ng-true-value="1" ng-false-value="0" name="IsInsert[]" id="IsInsert_{{Navigations.NavigationId}}" ng-model="item.IsInsert" />		  
	            </div>
	            <div class="col-sm-2 text-center">
					  <input  type="checkbox" ng-true-value="1" ng-false-value="0" name="IsUpdate[]" id="IsUpdate_{{Navigations.NavigationId}}" ng-model="item.IsUpdate" />		  
	            </div>
	            <div class="col-sm-2 text-center">
					  <input  type="checkbox" ng-true-value="1" ng-false-value="0" name="IsDelete[]" id="IsDelete_{{Navigations.NavigationId}}" ng-model="item.IsDelete" />		  
	            </div>
	        </div>

          </div>
          <div class="form-buttons-w">
            <button class="btn btn-primary" ng-click="saveItem()" ng-disabled="myForm.$invalid" type="submit"> Submit</button>
          </div>
      </form>
                  </div>
                </div>
              </div>
            </div>
<!-- <div ng-show="fgShowHide" class="btn-toolbar">
	<div class="btn-group">
	 <button type="button" ng-show="auth.insert" ng-click="showForm()" class="btn btn-success" ><i class="icon-plus icon-white"></i><b> Add Item</b></button>
	  <button type="button" ng-click="openSearchDialog()"  class="btn btn-inverse" ng-click="getMysqlScript()"><i class="icon-search icon-white"></i><b> Quick Search	</b> </button>
	</div>
</div>
 --><div ng-show="!fgShowHide" style="display:none">
<!--	<form name="myForm" class="form-horizontal well">
	   <fieldset>  
          <legend>Roles</legend>  
		  <div class="control-group" ng-class="{error: myForm.RoleName.$invalid}">
		<label class="control-label" for="RoleName">RoleName</label>
		<div class="controls">
		  <input class="input-xlarge" type="text" name="RoleName" id="RoleName" ng-model="item.RoleName" required />
		  <span ng-show="myForm.RoleName.$error.required" class="help-inline">Required</span>
		</div>
	  </div>
<div class="control-group" ><label class="control-label" for="NavigationId">NavigationId</label>
		<div class="controls">
		  <select ng-options="s.NavigationId as s.NavName for s in NavigationsList"  name="NavigationId" id="NavigationId" ng-model="item.NavigationId" ></select>		  
		</div></div>
<div class="control-group" ><label class="control-label" for="IsRead">IsRead</label>
		<div class="controls">
		  <input  type="checkbox" ng-true-value="1" ng-false-value="0" name="IsRead" id="IsRead" ng-model="item.IsRead" />		  
		</div></div>
<div class="control-group" ><label class="control-label" for="IsInsert">IsInsert</label>
		<div class="controls">
		  <input  type="checkbox" ng-true-value="1" ng-false-value="0" name="IsInsert" id="IsInsert" ng-model="item.IsInsert" />		  
		</div></div>
<div class="control-group" ><label class="control-label" for="IsUpdate">IsUpdate</label>
		<div class="controls">
		  <input  type="checkbox" ng-true-value="1" ng-false-value="0" name="IsUpdate" id="IsUpdate" ng-model="item.IsUpdate" />		  
		</div></div>
<div class="control-group" ><label class="control-label" for="IsDelete">IsDelete</label>
		<div class="controls">
		  <input  type="checkbox" ng-true-value="1" ng-false-value="0" name="IsDelete" id="IsDelete" ng-model="item.IsDelete" />		  
		</div></div>
	
		  <div class="form-actions">
			<button ng-click="saveItem()" ng-disabled="myForm.$invalid" class="btn btn-primary"><i class="icon-ok icon-white"></i> Save</button>
			 <button class="btn btn-warning cancel" ng-click="hideForm()"><i class="icon-close icon-white"></i>Cancel</button>		
		  </div>
	  </fieldset>
	</form>-->
</div>
<?php else: ?>
<p> Not permitted</p>
<?php endif; ?>
