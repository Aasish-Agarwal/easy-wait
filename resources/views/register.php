<!DOCTYPE html>
<html>
   <head>
      <title>Easy Wait</title>
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Bootstrap -->
	  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">

      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media
         queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page
         via file:// -->
      <!--[if lt IE 9]>
         <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/
            html5shiv.js"></script>
         <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/
            respond.min.js"></script>
      <![endif]-->
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
       <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
       <script src="js/jquery.cookie.js"></script>

		<script>
		$(function(){
			$("#navbar").load("nav.html");
		});
		</script>

   </head>
   <body ng-app="easywait" ng-controller="QueueViewer as vm" data-ng-init="vm.init()">

   <div id="navbar"></div>
   
      <!-- Grid System
      ====================================== -->
      <div class="container">
      	<div class="row">
      	<h3></h3>
      	</div>

      	<div class="row">
      	      		<div class="col-md-3">
		                <form ng-if="vm.flag_show_name"  class="navbar-form">
							<input class="form-control" type="text" ng-model="vm.name_to_publish" placeholder="Name"></input>
		                	<button class="glyphicon glyphicon-arrow-right btn btn-primary" ng-click="vm.showNumberInput()"></button>
						</form>
	                

		                <form ng-if="vm.flag_show_number"  class="navbar-form">
							<input class="form-control" type="number" ng-model="vm.cell_to_register" placeholder="91XXXXXXXXXX" ng-minlength=9 ng-maxlength=13></input>
		                	<button class="glyphicon glyphicon-arrow-right btn btn-primary" ng-click="vm.register()"></button>
   		                </form>
						
		                <form ng-if="vm.flag_show_otp"  class="navbar-form">
		                    <input class="form-control" ng-model="vm.otp" placeholder="OTP"  type="number"  ng-required=true ng-minlength=3 ng-maxlength=3></input>
		                	<button class="glyphicon glyphicon-arrow-right btn btn-primary" ng-click="vm.verifyOTP()"></button>
		               </form>
		                
						<h4>{{vm.message}}</h4>
						
					</div>
					
		</div>
      	
      </div>

      
      <!-- Include all compiled plugins (below), or include individual files
            as needed -->
	  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <!-- Application Dependencies -->
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.13.4/ui-bootstrap-tpls.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.5/angular-resource.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.5/angular-cookies.min.js"></script>
	  
    <!-- Application Scripts -->
    <script type="text/javascript" src="scripts/app.js"></script>
    <script type="text/javascript" src="scripts/services/qstatus.js"></script>
    <script type="text/javascript" src="scripts/controllers/QueueViewer.js"></script>
    <script type="text/javascript" src="js/bootbox.min.js"></script>
    
	  </body>
</html>


