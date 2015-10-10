<!DOCTYPE html>
<html>
   <head>
      <title>Easy Wait</title>
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Bootstrap 
-->
         
	  		<link href="bs/css/bootstrap.min.css" rel="stylesheet">
         	  <link href="bs/css/bootstrap-theme.min.css" rel="stylesheet">
      <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
         	  
	  
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


	  <script src="bs/js/bootstrap.min.js"></script>
    <!-- Application Dependencies -->
    <script type="text/javascript" src="bower_components/angular/angular.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular-route.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular-sanitize.js"></script>
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.13.4/ui-bootstrap-tpls.min.js"></script>
    
    <script type="text/javascript" src="bower_components/angular-resource/angular-resource.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.5/angular-cookies.min.js"></script>

    <!-- Application Scripts -->
    <script type="text/javascript" src="scripts/app.js"></script>
    <script type="text/javascript" src="scripts/services/qstatus.js"></script>
    <script type="text/javascript" src="scripts/controllers/Spa.js"></script>
    <script type="text/javascript" src="scripts/controllers/QueuePublisher.js"></script>
    <script type="text/javascript" src="js/bootbox.min.js"></script>
		
		
	<style type='text/css'>
		.localcounter {
		  width: 70%;
		  color: white;
		  font-size: 2em;
		  background-color: green;
		  vertical-align: middle;
		  text-align: center;
		}


		.bookedbox {
		  background-color: #f9f9f9;
		  color: black;
		  text-align: center;
		  vertical-align: middle;
		  font-size: 300%;
		}
		
		.vendorname {
		  background-color: #f9f9f9;
		  color: black;
		  text-align: center;
		  vertical-align: middle;
		}

		td span {
		    display:block;
		    width:100%;
		  text-align: center;
		  vertical-align: middle;
		}
		
	</style>

	<link href="css/sticky-footer-navbar.css" rel="stylesheet">
		
	</head>
   <body ng-app="easywait" ng-controller="QueueViewer as vm" data-ng-init="vm.init()">
      <!-- Grid System
      ====================================== -->
		<div class="container">
			<div class="row">
		      	<h3></h3>
	      		<mainmenu></mainmenu>
				<ewtoolbar vm="vm"></ewtoolbar>
			</div>
      	
		    <!-- Home Screen
		    ====================================== -->
			<div ng-if="vm.visibleSection[vm.IDX_HOME]" class="row">
		      		<div class="col-md-6">
			      		<ewhome vm="vm"></ewhome>
			      	</div>
			</div>
			
			<!-- Customer Screen
		    ====================================== -->
			<div ng-if="vm.visibleSection[vm.IDX_CUSTOMER]" class="row">
		      		<div class="col-md-4">
			      		<servicestatus vm="vm"></servicestatus>
			      		<serviceproviders vm="vm"></serviceproviders>
			      		<clientappointments vm="vm"></clientappointments>
			      		<servicesubscription vm="vm"></servicesubscription>
						<h4>{{vm.message}}</h4>
			      	</div>
			</div>

			<!-- Provider Screen
		    ====================================== -->
			<div ng-if="vm.visibleSection[vm.IDX_PROVIDER]" class="row" ng-controller="QueuePublisher as vmprovider" data-ng-init="vmprovider.init()">
		      		<div class="col-md-4">
						<qupdater vm="vmprovider"></qupdater>
						<serverappointments vm="vmprovider"></serverappointments>
		      		</div>
			</div>
			
		    <!-- Settings Screen
		    ====================================== -->
			<div ng-if="vm.visibleSection[vm.IDX_SETTINGS]" class="row">
		      		<div class="col-md-4">
			      		TODO - Settings
			      	</div>
			</div>
			
			
			<!-- Explore Solution Screen
		    ====================================== -->
			<div ng-if="vm.visibleSection[vm.IDX_EXPLORE]" class="row">
		      		<div class="col-md-4">
			      		TODO - Explore Solution
			      	</div>
			</div>

		</div>


		

    <div class="footer">
      <div class="container">
      <p class="text-muted">
      Powered By <a href="mailto:allied.service.14@gmail.com?Subject=Contact Us" target="_top">allied.service.14@gmail.com</a>
		</p>
      </div>
    </div>
      
      
      <!-- Include all compiled plugins (below), or include individual files
            as needed -->
    
	  </body>
</html>


