<script src="static/appScript/CustomerCtrl.js"></script>
<script>function getAuth(){ <?php echo $fx ?>;}</script>
<?php if ($read): ?>
<div ng-controller="CustomerCtrl">
<div class="element-wrapper" ng-show="fgShowHide">
                <h6 class="element-header">
                  Manage Customer
                </h6>
                <div class="element-box">
<!--                   <div class="form-desc">
                        <button type="button" ng-show="auth.insert" ng-click="showForm()" class="btn btn-success" ><i class="icon-plus icon-white"></i><b> Add </b></button>

                  </div> -->
                  <div class="table-responsive">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <div class="dataTables_length"><label>Show <select name="dataTable1_length" class="form-control form-control-sm rounded bright" style="width:75px"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries </label></div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div id="dataTable1_filter" class="dataTables_filter float-right"><label>Search:
                                        <input type="search" ng-model="search" class="form-control form-control-sm rounded bright" placeholder="" ng-change="doSearch()"></label>
                                </div>
                            </div>
                        </div>
                        <table  width="100%" class="table table-lightborder">
                        <thead>
                            <tr>
                                <th>Name</th><th>Company Name</th><th>Phone No</th><th>Email</th><th>Address</th><th>Location</th> 
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Name</th><th>Company Name</th><th>Phone No</th><th>Email</th><th>Address</th><th>Location</th> 
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr ng-repeat="item in list">
                                <td>{{item.Name}}</td>
                                <td>{{item.Name}}</td>
                                <td>{{item.PhoneNo}}</td>
                                <td>abc@gmail.com</td>
                                <td>{{item.Address}}</td>
                                <td>India</td>
                                <td class="text-center">
                                    <button class="ml-3 mb-2 btn btn-outline-info " ng-click="viewItem(item)" type="button">  <i class="os-icon os-icon-eye" style="margin-top: -3px;"></i></button>
                                    <button class="mb-2 btn btn-outline-info " ng-click="editItem(item)" type="button">  <i class="os-icon os-icon-ui-49" style="margin-top: -3px;"></i></button>
                                    <button class=" mb-2 btn btn-outline-danger " ng-click="deleteItem(item)" type="button"> <i class="os-icon os-icon-ui-15" style="margin-top: -3px;"></i></button>
                                </td>
                            </tr>
                            <tr ng-show="list.length ==0"><td colspan="10" class="text-center">Customer Not found</td></tr>

                            </tbody></table>



                  </div>

                            <div class="row"><div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="dataTable1_info" role="status" aria-live="polite">Showing {{pagingOptions.currentPage}} to {{totalpaging}} of {{totalItems}} entries</div></div>
                                    <div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers float-right"><ul class="pagination"><li class="paginate_button page-item previous" ng-class="{'disabled': pagingOptions.currentPage == 1}"><a href="javascript:void(0)" ng-click="setPage(pagingOptions.currentPage - 1)" class="page-link">Previous</a></li><li ng-repeat="pages in arrayTwo(pagingOptions.currentPage,totalpaging) track by $index" ng-class="{'active': pages == pagingOptions.currentPage}"  class="paginate_button page-item "><a href="javascript:void(0)" ng-click="setPage(pages)" class="page-link" ng-if="pages !='...'">{{pages}}</a><span href="javascript:void(0)"  data-paging-options="pages" ng-if="pages =='...'" class="page-link">{{pages}}</span></li><li class="paginate_button page-item next" ng-class="{disabled: pagingOptions.currentPage == totalpaging || totalItems == 0}"><a href="javascript:void(0);" ng-click="setPage(pagingOptions.currentPage + 1)" class="page-link">Next</a></li></ul></div></div>
                                </div>

                </div>

              </div>












<div ng-show="!fgShowHide && !viewProfileDetail" style="display:none">
    <div class="element-wrapper">
                <h6 class="element-header">{{datatype}} Customer</h6>
                <div class="element-box"><div class="form-desc"><button type="button"  ng-click="hideForm()" class="btn btn-success" ><i class="icon-plus icon-white"></i><b> Back </b></button></div>
    <!-- END Form Elements Title -->
    <form action="#"  name="myForm" method="post" enctype="multipart/form-data"  onsubmit="return false;">

        <div class="form-group" ng-class="nameError ? 'has-error':''">
            <label class="col-md-3 control-label" for="example-text-input">Name</label>
            <div class="col-md-9">
                <input type="text" id="example-text-input" name="name" id="name" ng-model="item.Name"  class="form-control" placeholder="Name" ng-focus="hideErrorMsg('nameError')">
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
</div>

<div ng-show="viewProfileDetail" style="display:none">
    <div class="element-wrapper">
                <h6 class="element-header">View Customer Detail</h6>
                <div class="element-box">
                        <button type="button"  ng-click="hideForm()" class="btn btn-success" ><i class="icon-plus icon-white"></i><b> Back </b></button>
                </div>

                <div class="user-profile">
                  <div class="up-head-w" style="background-image:url(img/profile_bg1.jpg)">
                    <div class="up-main-info">
                      <div class="user-avatar-w">
                        <div class="user-avatar">
                          <img alt="" src="img/avatar1.jpg">
                        </div>
                      </div>
                      <h1 class="up-header">
                        {{item.firstname}}{{item.lastname}}
                      </h1>
                    </div>
                    <svg class="decor" width="842px" height="219px" viewBox="0 0 842 219" preserveAspectRatio="xMaxYMax meet" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g transform="translate(-381.000000, -362.000000)" fill="#FFFFFF"><path class="decor-path" d="M1223,362 L1223,581 L381,581 C868.912802,575.666667 1149.57947,502.666667 1223,362 Z"></path></g></svg>
                  </div>
                  <div class="up-controls">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="value-pair">
                          <div class="label">
                            Status:
                          </div>
                          <div class="value badge badge-pill badge-success"> 
                            Active

                          </div>
                        </div>
                        <div class="value-pair">
                          <div class="label">
                            Member Since:
                          </div>
                          <div class="value">
                            01-01-2020
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6 text-right">
<!--                         <a class="btn btn-primary btn-sm" href=""><i class="os-icon os-icon-link-3"></i><span>Add to Friends</span></a><a class="btn btn-secondary btn-sm" href=""><i class="os-icon os-icon-email-forward"></i><span>Send Message</span></a> -->
                      </div>
                    </div>
                  </div>
                  <div class="up-contents">
                    <h5 class="element-header">
                      Customer Detail
                    </h5>
                    <div class="row m-b">
                      <div class="col-md-10 col-md-offset-1" style="font-size: 20px;">
                        <div class="row">
                          <div class="col-sm-6 b-t b-l b-r b-b">
                              <b>Full Name </b>
                          </div>
                          <div class="col-sm-6 b-t b-r b-b">
                              abc deed
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6 b-l b-r b-b">
                              <b>Company Name </b>
                          </div>
                          <div class="col-sm-6  b-r b-b">
                              abc deed
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6 b-l b-r b-b">
                              <b>Phone Number </b>
                          </div>
                          <div class="col-sm-6  b-r b-b">
                                +91 88661222
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6 b-l b-r b-b">
                              <b>Email </b>
                          </div>
                          <div class="col-sm-6  b-r b-b">
                              abc@gmail.com
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-sm-6 b-l b-r b-b">
                              <b>Address </b>
                          </div>
                          <div class="col-sm-6  b-r b-b">
                              Near bus stop,
                              rajkot ,gujarat
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6 b-l b-r b-b">
                              <b>Location </b>
                          </div>
                          <div class="col-sm-6  b-r b-b">
                                Rajkot Gujarat India
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                  <div class="up-contents">
                    <h5 class="element-header">
                      Customer Statistics
                    </h5>
                    <div class="row m-b">
                      <div class="col-lg-12">
                        <div class="row">
                          <div class="col-sm-6 b-r b-b">
                            <div class="el-tablo centered padded">
                              <div class="value">
                                3814
                              </div>
                              <div class="label">
                                Total Orders
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 b-b">
                            <div class="el-tablo centered padded">
                              <div class="value">
                                2000
                              </div>
                              <div class="label">
                                Total Pending Orders
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6 b-r">
                            <div class="el-tablo centered padded">
                              <div class="value">
                                300
                              </div>
                              <div class="label">
                                Total Completed Orders
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6 ">
                            <div class="el-tablo centered padded">
                              <div class="value">
                                $1200
                              </div>
                              <div class="label">
                                Total Spend
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
<!--                       <div class="col-lg-6">
                        <div class="padded">
                          <div class="element-info-with-icon smaller">
                            <div class="element-info-icon">
                              <div class="os-icon os-icon-bar-chart-stats-up"></div>
                            </div>
                            <div class="element-info-text">
                              <h5 class="element-inner-header">
                                Monthly Revenue
                              </h5>
                              <div class="element-inner-desc">
                                Calculated every month
                              </div>
                            </div>
                          </div>
                          <div class="el-chart-w"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                            <canvas height="135" id="liteLineChart" width="313" style="display: block; width: 313px; height: 135px;" class="chartjs-render-monitor"></canvas>
                          </div>
                        </div>
                      </div>
 -->                    </div>
<!--                     <div class="os-tabs-w">
                      <div class="os-tabs-controls">
                        <ul class="nav nav-tabs bigger">
                          <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tab_overview">Activity</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tab_sales">Daily Sales</a>
                          </li>
                        </ul>
                        <ul class="nav nav-pills smaller d-none d-md-flex">
                          <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#">Today</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#">7 Days</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#">14 Days</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#">Last Month</a>
                          </li>
                        </ul>
                      </div>
                      <div class="tab-content">
                        <div class="tab-pane active" id="tab_overview">
                          <div class="timed-activities padded">
                            <div class="timed-activity">
                              <div class="ta-date">
                                <span>21st Jan, 2017</span>
                              </div>
                              <div class="ta-record-w">
                                <div class="ta-record">
                                  <div class="ta-timestamp">
                                    <strong>11:55</strong> am
                                  </div>
                                  <div class="ta-activity">
                                    Created a post called <a href="#">Register new symbol</a> in Rogue
                                  </div>
                                </div>
                                <div class="ta-record">
                                  <div class="ta-timestamp">
                                    <strong>2:34</strong> pm
                                  </div>
                                  <div class="ta-activity">
                                    Commented on story <a href="#">How to be a leader</a> in <a href="#">Financial</a> category
                                  </div>
                                </div>
                                <div class="ta-record">
                                  <div class="ta-timestamp">
                                    <strong>7:12</strong> pm
                                  </div>
                                  <div class="ta-activity">
                                    Added <a href="#">John Silver</a> as a friend
                                  </div>
                                </div>
                                <div class="ta-record">
                                  <div class="ta-timestamp">
                                    <strong>9:39</strong> pm
                                  </div>
                                  <div class="ta-activity">
                                    Started following user <a href="#">Ben Mosley</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="timed-activity">
                              <div class="ta-date">
                                <span>3rd Feb, 2017</span>
                              </div>
                              <div class="ta-record-w">
                                <div class="ta-record">
                                  <div class="ta-timestamp">
                                    <strong>9:32</strong> pm
                                  </div>
                                  <div class="ta-activity">
                                    Added <a href="#">John Silver</a> as a friend
                                  </div>
                                </div>
                                <div class="ta-record">
                                  <div class="ta-timestamp">
                                    <strong>5:14</strong> pm
                                  </div>
                                  <div class="ta-activity">
                                    Commented on story <a href="#">How to be a leader</a> in <a href="#">Financial</a> category
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="timed-activity">
                              <div class="ta-date">
                                <span>21st Jan, 2017</span>
                              </div>
                              <div class="ta-record-w">
                                <div class="ta-record">
                                  <div class="ta-timestamp">
                                    <strong>11:55</strong> am
                                  </div>
                                  <div class="ta-activity">
                                    Created a post called <a href="#">Register new symbol</a> in Rogue
                                  </div>
                                </div>
                                <div class="ta-record">
                                  <div class="ta-timestamp">
                                    <strong>2:34</strong> pm
                                  </div>
                                  <div class="ta-activity">
                                    Commented on story <a href="#">How to be a leader</a> in <a href="#">Financial</a> category
                                  </div>
                                </div>
                                <div class="ta-record">
                                  <div class="ta-timestamp">
                                    <strong>9:39</strong> pm
                                  </div>
                                  <div class="ta-activity">
                                    Started following user <a href="#">Ben Mosley</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane" id="tab_sales">
                          <div class="el-tablo">
                            <div class="label">
                              Unique Visitors
                            </div>
                            <div class="value">
                              12,537
                            </div>
                          </div>
                          <div class="el-chart-w">
                            <canvas height="0" id="lineChart" width="0" class="chartjs-render-monitor" style="display: block; width: 0px; height: 0px;"></canvas>
                          </div>
                        </div>
                        <div class="tab-pane" id="tab_conversion"></div>
                      </div>
                    </div>
                  </div>
                </div> -->
    </div>              
</div>



</div></div>
</div>
<?php else: ?>
<p> Not permitted</p>
<?php endif; ?>
