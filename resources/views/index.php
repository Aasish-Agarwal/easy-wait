<!DOCTYPE html>
<html>
   <head>
      <title>Easy Wait</title>
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- Bootstrap 
-->
         
	  		<link href="bs/css/bootstrap.min.css" rel="stylesheet">
         	  <link href="bs/css/bootstrap-theme.min.css" rel="stylesheet">
         	  
	  
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

<style type='text/css'>

.bookedbox {
  width: 300px;
  background-color: grey;
  color: white;
  text-align: center;
}

.bookedbox h1 {
  background-color: green;
}

</style>

		
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
	
	      		<div class="col-md-4">
					<h3>Queue Status: </h3>
	      				<form class="navbar-form">
	      					<div class="bookedbox">
			                	{{ vm.vendor_info_map[vm.mobile] }} - {{ vm.mobile  }}
			                	<h1>{{vm.counter}}<h1>
			                	</div>
			                </form>
	      		</div>

	      		<div class="col-md-4">
					<h3>Current Bookings: </h3>
		      		<div ng-repeat="counter in vm.booked_counters"> 
						  <table  border="1">
						  <tr>
						  
						  <td><button class="glyphicon glyphicon-remove btn btn-danger" ng-click="vm.cancelBooking(vm.mobile, vm.current_bookings[counter] , counter)"></button></td>
						  <td class="bookedbox">{{vm.current_bookings[counter]}}</td>
						  <td class="bookedbox">{{counter}}</td>
							</tr>
						 </table>
					</div>

		      		<div ng-show="vm.isAcceptingBookings">
						<form class="navbar-form">
		                	<input type="text" class="form-control" ng-model="vm.booking_reference" placeholder="Reference" ng-minlength=2 ng-maxlength=32>
		                    </input>
		                	<input type="number" class="form-control" ng-model="vm.preferred_position" placeholder="Preferred Position" ng-minlength=1 ng-maxlength=2>
		                    </input>
		                    <button class="btn btn-primary"  ng-click="vm.addBooking(vm.mobile,vm.booking_reference,vm.preferred_position)">Book</button>
						</form>
					</div>
					
				</div>
	      		
	      		
	      		<div class="col-md-4">
			      	<h3>Subscription History: </h3>
			      		<div ng-repeat="mobile in vm.subscribed_numbers"> 
						  <table  border="1">
						  <tr>
						  
						  <td><button class="glyphicon glyphicon-remove btn btn-danger" ng-click="vm.removeSubscription(mobile)"></button></td>
						  <td class="bookedbox">{{ vm.vendor_info_map[mobile] }}</td>
						  <td><button class="glyphicon glyphicon-ok btn btn-success" ng-click="vm.setMobile(mobile)"></button></td>
						  </tr>
						 </table>
							
						</div>

	      			<h3>Subscribe: </h3>
	                <form class="navbar-form">
	                    <label>Phone Number with country code</label><br>
	                	<input type="number" class="form-control" ng-model="vm.mobile_to_subscribe" placeholder="91XXXXXXXXXX" ng-minlength=9 ng-maxlength=13>
	                    </input>
	                    <button class="btn btn-primary " ng-click="vm.setMobile(vm.mobile_to_subscribe)">Subscribe</button>
					</form>
						
				</div>
	      	</div>

	    <div class="row">
			<h4>{{vm.message}}</h4>
		</div>
		
      </div>

      
      
      <!-- Include all compiled plugins (below), or include individual files
            as needed -->
	  <script src="bs/js/bootstrap.min.js"></script>
    <!-- Application Dependencies -->
    <script type="text/javascript" src="bower_components/angular/angular.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.13.4/ui-bootstrap-tpls.min.js"></script>
    
    <script type="text/javascript" src="bower_components/angular-resource/angular-resource.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.5/angular-cookies.min.js"></script>

    <!-- Application Scripts -->
    <script type="text/javascript" src="scripts/app.js"></script>
    <script type="text/javascript" src="scripts/services/qstatus.js"></script>
    <script type="text/javascript" src="scripts/controllers/QueueViewer.js"></script>
    	  
	  </body>
</html>


