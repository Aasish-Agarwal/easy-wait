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
		});
		</script>

<style type='text/css'>

.bookedbox {
  width: 350px;
  height: 40px;
  color: white;
  background-color: grey;
	text-align: center;
}

.counterbox {
  color: white;
  text-align: center;
}

.counterbox td {
  width: 30px;
  background-color: black;
}

.counterbox td h1 {
  width: 140px;
  background-color: green;
}

</style>
		
   </head>
   <body ng-app="easywait" ng-controller="QueuePublisher as vm" data-ng-init="vm.init()">

   <div id="navbar"></div>
   
      <!-- Grid System
      ====================================== -->
      <div class="container">
      	<div class="row">
      	<h3></h3>
      	</div>
      	<div class="row">
			<div class="well col-md-3">
		                	{{ vm.auth_username }} - {{ vm.registered_mobile }}
      					<div class="counterbox">
		                	<table >
		                	<tr>
		                	<td><button class="glyphicon glyphicon-stop btn btn-danger" ng-click="vm.stoplocal()"></button></td>
		                	<td><h1>{{vm.counter}}<h1></td>
		                	<td>{{vm.server_counter}}</td>
		                	<td><button class="glyphicon glyphicon-forward btn btn-danger" ng-click="vm.nextlocal()"></button></td>
		                	</tr>
		                	</table>
		                </div>
			</div>
			<div class="col-md-4">
			          <form class="navbar-form">
			          	<button class="btn btn-primary btn-lg btn-block" ng-hide="vm.isAcceptingBookings" ng-click="vm.acceptAppointments()">Accept Appointments</button>
			          	<button class="btn btn-danger btn-lg btn-block" ng-show="vm.isAcceptingBookings" ng-click="vm.closeAppointments()">Close Appointments</button>
			          </form>
			</div>
			<div class="col-md-4">
				<h3>Current Bookings:</h3>
					<div ng-repeat="booking in vm.current_bookings"> 
						  <table  border="1">
						  <tr>
						  
						  <td class="bookedbox">{{booking.reference}}</td>
						  <td class="bookedbox">{{booking.counter}}</td>
							</tr>
						 </table>
	                	
	                </div>
			        <button class="btn btn-danger btn-lg btn-block" ng-click="vm.clearAllBookings()">Clear All Appointments</button>
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
    <script type="text/javascript" src="scripts/controllers/QueuePublisher.js"></script>
    	  
	  </body>
</html>


