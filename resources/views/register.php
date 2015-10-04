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


					<div ng-if="vm.flag_show_name" class="input-group">
				      <input class="form-control" type="text" ng-model="vm.name_to_publish" placeholder="Name">
				      <span class="input-group-btn">
				        <button class="glyphicon glyphicon-arrow-right btn btn-primary" ng-click="vm.showNumberInput()"></button>
				      </span>
				    </div><!-- /input-group -->
				    
					                
					<div ng-if="vm.flag_show_number" class="input-group">
				      <input class="form-control" type="number" ng-model="vm.cell_to_register" placeholder="91XXXXXXXXXX" ng-minlength=9 ng-maxlength=13>
				      <span class="input-group-btn">
						<button class="glyphicon glyphicon-arrow-right btn btn-primary" ng-click="vm.register()"></button>
				      </span>
				    </div><!-- /input-group -->
				    
					<div ng-if="vm.flag_show_otp" class="input-group">
						<input class="form-control" ng-model="vm.otp" placeholder="OTP"  type="number"  ng-required=true ng-minlength=3 ng-maxlength=5>
					    <span class="input-group-btn">
							<button class="glyphicon glyphicon-arrow-right btn btn-primary" ng-click="vm.verifyOTP()"></button>
					    </span>
				    </div><!-- /input-group -->
    
					<p ng-bind-html="vm.message"></p>
					<hr>
					Having Difficulties? Contact Us:
					<a href="mailto:allied.service.14@gmail.com?Subject=Easy Wait - Service Enquiry" target="_top">allied.service.14@gmail.com</a>
					
					</div>
					
		</div>
      	
      </div>

      
      <!-- Include all compiled plugins (below), or include individual files
            as needed -->
	  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <!-- Application Dependencies -->
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular-route.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular-sanitize.js"></script>
		

	
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


