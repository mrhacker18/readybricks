<link href="<?php echo base_url(); ?>static/css/bootstrap-datetimepicker.css" rel="stylesheet" media="screen"><script src="static/appScript/StockCtrl.js"></script>
<script>function getAuth(){ <?php echo $fx ?>;}</script>
<?php if ($read): ?>
<div ng-controller="StockCtrl">

<ul class="breadcrumb breadcrumb-top">
    <li><a href="<?php echo base_url(); ?>index.php/#/">Dashboard</a></li>
    <li>Stock</li>
</ul>

<div ng-show="fgShowHide">
	 <!-- Datatables Content -->
     <div class="block full">
        <div class="block-title">
           <div class="block-options pull-right">
            </div>
            <h2><strong>Filter</strong> </h2>
        </div>
            <div class="row">
            <div class="col-md-3">
                    <label>Select Model</label>
                  <select name="MCategoryId" id="MCategoryId" ng-model="item.ModelId" required ng-options="model.Name for model in ModelList track by model.ModelId" class="form-control" placeholder="Category Name">
                            <option value="">Select Model</option>
                  </select>
            </div>
            <div class="col-md-3">
                    <label>Start Date</label>
                    <input type="text" name="startdate" ng-model="item.startdate" id="StartDate" class="form-control">
            </div>
            <div class="col-md-3">
                    <label>End Date</label>
                    <input type="text" name="enddate" ng-model="item.enddate" id="EndDate" class="form-control">
            </div>
            <div class="col-md-3">
                    <label>&nbsp;</label>
                    <br/>
                <button   ng-click="FindStock()"  class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Find</button>
            </div>
        </div>
        </div>
    </div>
    <div class="block full">
    	<div class="block-title">
           <div class="block-options pull-right">
            </div>
            <h2><strong>Manage</strong> Stock</h2>
        </div>
        <div class="table-responsive">
        <div class="col-md-2 padding0 " ng-if="TotalInStock !=''">
            <label>In Stock</label>
            <h4><b>{{TotalInStock}}</b></h4>
        </div>            
        <div class="col-md-2 padding0 " ng-if="TotalOutOfStock !=''">
            <label>Unit Sold</label>
            <h4><b>{{TotalOutOfStock}}<b></h4>
        </div>            
        <div class="col-md-3 padding0 col-md-offset-4" ng-class="TotalOutOfStock != '' ? 'col-md-offset-5' : 'col-md-offset-9'">
                <label>
                <div class="input-group">
                    <input type="search"  class="form-control" placeholder="Search" ng-model="search" ng-change="doSearch()"><span class="input-group-addon"><i class="fa fa-search"></i></span>
                </div>
                </label>
        </div>

        <table class="table table-bordered bordered table-striped table-condensed datatable">
        	<!-- <table id="example-datatable" class="table table-vcenter table-condensed table-bordered"> -->
                <thead>
                    <tr>

<!--                         <th class="text-center">Action</th>
 --> <!--                    <th class="text-center">ID</th>
      -->                   <th>#</th>
                            <th class="text-center">Model Number</th>
                            <th class="text-center">Serial Number</th>
                            <th class="text-center">Order ID</th>
                            <th class="text-center">Stock In</th>
                            <th class="text-center">Stock Out</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                	<tr ng-repeat="category in list">
                        <td>{{currentindex + $index}}</td>
                        <td>{{category.Name}}</td>
                        <td>{{category.SerialNo}}</td>
                        <td><a href="index.php/#/Order?orderid={{category.OrderId}}">{{category.OrderId}}</a></td>
                        <td>{{fixDate(category.sDate) | date: 'dd-MM-yyyy H:m:s'}}</td>
                        <td>{{category.DateTime}}</td>
                        <td><lable ng-show="category.OrderId ==null" class="label label-primary">Available</lable><lable ng-show="category.DateTime != null" class="label label-warning">Sold</lable>
                         
                        </td>
                        <td>                            
                        <button type="button" class="btn  btn-xs btn-danger" ng-click="deleteItem(category.SNoId)">Delete</button> </td>

                	</tr>
                  	<tr ng-show="list.length ==0"><td colspan="8" class="text-center">Stock Not found</td></tr>
                     
                </tbody>
                </table>
	    </div>
	    <div class="row">
	    <div class="col-sm-5 hidden-xs">
	    	
        </div>
	    	<div class="col-sm-7 col-xs-12 clearfix">
	    		<div class="dataTables_paginate paging_bootstrap" ng-show="list.length !=0">
              
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

</div>
<?php else: ?>
<p> Not permitted</p>
<?php endif; ?>
<script type="text/javascript">
        $(function () {
            $('#StartDate,#EndDate').datetimepicker({
              
               maxDate: moment(),
               format: 'DD-MM-Y' // HH:mm:ss

            });

        });

</script>