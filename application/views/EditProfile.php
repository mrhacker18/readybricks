<script src="static/appScript/EditProfileCtrl.js"></script>
<script>function getAuth(){ <?php echo $fx ?>;}</script>
<?php if ($read): ?>
<div ng-controller="EditProfileCtrl">
<!-- START BREADCRUMB -->
<ul class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>index.php/#/">Home</a></li>
    <li class="active">Edit Profile</li>
</ul>
<div class="page-title">                    
    <h2><span class="fa fa-arrow-circle-o-left"></span>Edit Profile</h2>
</div>
<div class="page-content-wrap">
<div class="block">

  <div class="container">
      <div class="row">
        <form action="#"  enctype="multipart/form-data" onsubmit="return false;"  methode="post">

            <div class="col-md-6 col-md-offset-2">
                  <div class="form-group" ng-show="item.FirstName !=''">
                  <label for="email">First Name:</label>
                  <input type="text" class="form-control" ng-class="FirstNameError ? 'error':''"  ng-model="item.FirstName"  placeholder="Enter First Name" >
                  <label ng-show="FirstNameError" ng-bind="errors.FirstNameMsg" class="error"></label>

                </div>

                <div class="form-group" ng-show="item.LastName!=''">
                 <label for="email">Last Name:</label>
                  <input type="text" class="form-control" ng-class="LastNameError ? 'error':''"  ng-model="item.LastName"  placeholder="Enter Last Name" >
                  <label ng-show="LastNameError" ng-bind="errors.LastNameMsg" class="error"></label>

                </div>
               <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="email" class="form-control" ng-class="emailError ? 'error':''"  ng-model="item.Email" placeholder="Enter email" >
                  <label ng-show="emailError" ng-bind="errors.emailMsg" class="error"></label>
                </div>
            
                <div class="form-group">
                  <label for="pwd">Password:</label>
                  <input type="password" class="form-control" ng-class="passwordError ? 'error':''" ng-model="item.Password" placeholder="Enter password">
                  <label ng-show="pwdError" ng-bind="errors.passwordMsg" class="error"></label>
                </div>

                <div class="form-group">
                  <label for="pwd">Confirm Password:</label>
                  <input type="password" class="form-control" ng-class="cpasswordError ? 'error':''" ng-model="item.CPassword" placeholder="Enter password">
                  <label ng-show="cpasswordError" ng-bind="errors.cpasswordMsg" class="error"></label>
                </div>
   
        </div>
     <!-- End Col-md-6 -->

            <div class="col-md-10 text-center">
            <br/><br/>
              <div class="form-group">
                         <button type="submit" ng-click="saveItem()" class="btn btn-primary">Submit</button>
              </div>
            </div>
        </form>                             
    </div> <!-- End Row -->
  </div>  <!-- End Container -->
                  
</div>

<?php else: ?>
<p> Not permitted</p>
<?php endif; ?>
