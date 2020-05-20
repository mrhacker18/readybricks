<script src="static/appScript/ModelsCtrl.js"></script>
<script>function getAuth(){ <?php echo $fx ?>;}</script>
<?php if ($read): ?>
<div ng-controller="ModelsCtrl">

<ul class="breadcrumb breadcrumb-top">
    <li><a href="<?php echo base_url(); ?>index.php/#/">Dashboard</a></li>
    <li>Models</li>
</ul>

<div ng-show="fgShowHide">
	 <!-- Datatables Content -->
    <div class="block full">
    	<div class="block-title">
           <div class="block-options pull-right">
            <a href="javascript:void(0)" class="btn  btn-sm btn-primary toggle-bordered enable-tooltip" data-toggle="button" title="" data-original-title="Toggles .form-bordered class" aria-pressed="false" ng-show="auth.insert" ng-click="showForm()" >Add Models</a>
            </div>
            <h2><strong>Manage</strong> Models</h2>
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
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                	<tr ng-repeat="item in list">
<!--                 		<td>{{category.catId}}</td>
 -->                		<td>{{item.name}}</td>

                        <td>
                        <button type="button" class="btn  btn-xs btn-info" ng-click="editItem(item)">Edit</button>

                        &nbsp;&nbsp;
                        <button type="button" class="btn  btn-xs btn-danger" ng-click="deleteItem(item.modelId)">Delete</button> </td>
                	</tr>
                  	<tr ng-show="list.length ==0"><td colspan="3" class="text-center">Models Not found</td></tr>
                     
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
                              <a href="javascript:void(0)" ng-click="setPage(pagingOptions.currentPage - 2)"  ><i class="fa fa-chevron-left"></i> 
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








<div ng-show="!fgShowHide" style="display:none">

<div class="block">
    <!-- Basic Form Elements Title -->
    <div class="block-title">
        <h2><strong>{{datatype}}</strong> Models</h2>
    </div>
    <!-- END Form Elements Title -->
    <form action="#"  name="myForm" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" onsubmit="return false;">

        <div class="form-group" ng-class="nameError ? 'has-error':''">
            <label class="col-md-3 control-label" for="example-text-input">Name</label>
            <div class="col-md-9">
                <input type="text" id="example-text-input" name="name" id="name" ng-model="item.name"  class="form-control" placeholder="Name" ng-focus="hideErrorMsg('nameError')">
                <span ng-show="nameError" ng-bind="errors.nameMsg" class="help-block"></span>
            </div>
        </div>
        
        <div class="form-group form-actions">
            <div class="col-md-9 col-md-offset-3">
                <button   ng-click="saveItem()"  class="btn btn-primary"><i class="fa fa-angle-right"></i> Submit</button>
                <button class="btn btn-warning cancel" ng-click="hideForm()"><i class="icon-close icon-white"></i>Cancel</button>
            </div>
        </div>
    </form>
                                  
</div>


</div>
<?php else: ?>
<p> Not permitted</p>
<?php endif; ?>
