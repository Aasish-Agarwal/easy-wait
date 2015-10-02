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
  width: 50%;
  color: white;
  font-size: 2em;
  background-color: grey;
	text-align: center;
}

.bookedbox_server {
  width: 20%;
  color: white;
  font-size: 1em;
  background-color: #428bca;
	text-align: center;
}

.qstatus {
  color: white;
  width: 30%;
  background-color: #428bca;
	text-align: center;
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
      	<table >
			  <tr>
			  <td ><button type="button" class="btn btn-danger btn-lg" ng-click="vm.stoplocal()"><span class="glyphicon glyphicon-stop" aria-hidden="true"></span></button></td>
			  <td class="bookedbox">{{vm.counter}}</td>
			  <td class="bookedbox_server ">{{vm.server_counter}}</td>
			  <td ><button type="button" class="btn btn-primary btn-lg" ng-click="vm.nextlocal()"><span class="glyphicon glyphicon-forward" aria-hidden="true"></span></button></td>
			  </tr>
		</table>

    </div>
			
    
			<div class="col-md-4">
<h3>Appointments:
<span class="label label-danger">{{vm.isNotAcceptingBookings}}</span> 
<span class="label label-success">{{vm.isAcceptingBookings}}</span>
<span class="label label-primary">Next: {{vm.qsize}}</span>
</h3>			    
					<table class="table table-striped" >
					 	<thead>
					  <tr>
					     <th>Reference</th>
					     <th>Counter</th>
					  </tr>
					 </thead>
 					  <tbody ng:repeat="booking in vm.current_bookings">
					    <tr><td>{{booking.reference}}</td><td>{{booking.counter}}</td></tr>
					  </tbody>
					</table>			
			
<ul class="nav nav-pills" role="tablist">
  <li role="presentation"><button type="button" class="btn btn-danger btn-lg"   ng-click="vm.clearAllBookings()"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> </button></li>
  <li role="presentation"><button type="button" class="btn btn-danger btn-lg" ng-click="vm.closeAppointments()"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> </button></li>
  <li role="presentation"><button type="button" class="btn btn-success btn-lg"  ng-click="vm.acceptAppointments()"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> </button></li>
  <li role="presentation"><button type="button" class="btn btn-primary btn-lg"  ng-click="vm.retrieveAll()"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></button></li>
</ul>
					
			    
			    
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

    <script type="text/javascript" src="js/bootbox.min.js"></script>

    
	  </body>
</html>


