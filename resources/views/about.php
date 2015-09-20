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

		<script>
		$(function(){
			$("#navbar").load("nav.html");
			$("#about").load("about-easywait.html");
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
      		<div id="about"></div>
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
    	  
	  </body>
</html>


