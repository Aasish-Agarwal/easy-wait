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

		<script>
		$(function(){
			$("#navbar").load("nav.html");
		});
		</script>

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
    <script type="text/javascript" src="scripts/controllers/QueueViewer.js"></script>
    <script type="text/javascript" src="js/bootbox.min.js"></script>
		
		
		<style type='text/css'>
		
		.bookedbox {
		  background-color: #f9f9f9;
		  color: black;
		  text-align: center;
		  font-size: 300%;
		}
		
		.vendorname {
		  background-color: #f9f9f9;
		  color: black;
		  text-align: center;
		}


</style>

	<link href="css/sticky-footer-navbar.css" rel="stylesheet">
		
	</head>
   <body ng-app="easywait" ng-controller="QueueViewer as vm" data-ng-init="vm.init()">

   <div id="navbar"></div>
   
      <!-- Grid System
      ====================================== -->
      <div class="container">
      	<div class="row">
      	<h3></h3>
      	      	<h3></h3>
      	</div>

      	<div ng-if="vm.flag_introduction" class="row">
	      		
	      		<div class="col-md-6">
      			<h1>Hate Queues? Tune in to get relieved.</h1>
				<ul >
				  <li role="presentation">Doctors, Restraunts, Temples, Community Events</li>
				  <li role="presentation">Wherever is a long quque</li>
				</ul>
      			<hr>
      			<h3>Waiting Made Easy In 5 Steps <button ng-if="vm.flag_introduction" class="btn btn-success" ng-click="vm.toggleAssistance()">Start Now</button></h3>
      			<img src="img/qsnapshot.png" width="600" height="500" alt="" /> 
      			
				<ul >
				  <li role="presentation">Provider Registers With Its Phone Number</li>
				  <li role="presentation">Provider Shares The Number With Customers</li>
				  <li role="presentation">Customers Subscribe The Providers Number</li>
				  <li role="presentation">Provider Updates Queue Status</li>
				  <li role="presentation">Customers Refreshes Status View</li>
				</ul>
      			
      		    <hr>
      			<h3>Ask your provider to register with us now</h3>
				<button ng-if="vm.flag_introduction" class="btn btn-success" ng-click="vm.toggleAssistance()">Start Now</button>      		    
      		    
      		    </div>
      	</div>
      	
      	<div ng-if="! vm.flag_introduction" class="row">
			
      	
	      		<div class="col-md-4">
	      		
					<div class="input-group">
				      <input type="number" data-toggle="tooltip" title="Mobile Number with Country Code" class="form-control" ng-model="vm.mobile_to_subscribe" placeholder="91XXXXXXXXXX" ng-minlength=1 ng-maxlength=13>
				      <span class="input-group-btn">
	                	<button class="glyphicon glyphicon-arrow-right btn btn-primary" data-toggle="tooltip" title="Watch Status"  ng-click="vm.setMobile(vm.mobile_to_subscribe)"></button>
				      </span>
				    </div><!-- /input-group -->
	      		
	      		
	      		
      					<table ng-if="vm.flag_viewing_queue" class="table" >
      					<tr>
      					<td class="bookedbox" colspan=2> {{vm.counter}} </td>
		                </tr>

      					<tr>
      					<td class="vendorname" >{{vm.update_rate}} </td>
      					<td class="vendorname" >{{vm.last_updated}} </td>
      					</tr>
		                
		                <tr>
		                <td colspan=2 class="vendorname" data-toggle="tooltip" title="Refresh"><button class="glyphicon glyphicon-refresh btn btn-primary" ng-click="vm.getStatus()">  {{ vm.vendor_info_map[vm.mobile] }} - {{ vm.mobile  }}</button></td>
		                </tr>
		                </table>
			                
			                
			   </div>

	      		<div ng-if="vm.flag_viewing_queue" class="col-md-4">
					<h3>Appointments:
					<span ng-if="! vm.isAcceptingBookings" class="label label-danger"><i class="fa fa-power-off"></i></span> 
					<span ng-if="vm.isAcceptingBookings" class="label label-success"><i class="fa fa-power-off"></i></span>
					</h3>			    
					
					
					<table class="table table-striped" >
					 	<thead>
					  <tr>
					     <th><button data-toggle="tooltip" title="Cancel All"  class="glyphicon glyphicon-trash btn btn-danger" ng-click="vm.cancelAllBookings(vm.mobile)"></button> </th>
					     <th>Reference</th>
					     <th>Counter</th>
					  </tr>
					 </thead>
 					  <tbody ng:repeat="counter in vm.booked_counters">
						  <td><button class="glyphicon glyphicon-remove btn btn-danger" ng-click="vm.cancelBooking(vm.mobile, vm.current_bookings[counter] , counter)"></button></td>
						  <td>{{vm.current_bookings[counter]}}</td>
						  <td>{{counter}}</td>
					    </tbody>
					</table>			
			      	

		      		<div ng-if="vm.isAcceptingBookings">
						<form class="navbar-form">
		                	<input type="text" class="form-control" ng-model="vm.booking_reference" placeholder="Reference" ng-minlength=2 ng-maxlength=32>
		                    </input>
		                	<input type="number" class="form-control" ng-model="vm.preferred_position" placeholder="Preferred Position" ng-minlength=1 ng-maxlength=2>
		                    </input>
		                    <button class="btn btn-primary"  ng-click="vm.addBooking(vm.mobile,vm.booking_reference,vm.preferred_position)">Book</button>
		                    You are likely to get number {{vm.qsize}} or later
						</form>
					</div>
					
				</div>
	      		
	      		
	      		<div class="col-md-4">
			      	<h3>Subscriptons: </h3>

					<table class="table table-striped" >
					 	<thead>
					  <tr>
					     <th>Remove</th>
					     <th>Queue Of</th>
					     <th>Watch</th>
					  </tr>
					 </thead>
 					  <tbody ng:repeat="mobile in vm.subscribed_numbers">
						  <tr>
						  
						  <td><button class="glyphicon glyphicon-remove btn btn-danger" ng-click="vm.removeSubscription(mobile)"></button></td>
						  <td >{{ vm.vendor_info_map[mobile] }}</td>
						  <td><button class="glyphicon glyphicon-arrow-right btn btn-primary" ng-click="vm.setMobile(mobile)"></button></td>
						  </tr>
 					  </tbody>
					</table>			
			      	
					
							
				</div>

						
				</div>
	   
	   
	    <div class="row">
	      		<div class="col-md-4">
			<h4>{{vm.message}}</h4>
			</div>
		</div>	   
	   
	   </div>


		

    <div class="footer">
      <div class="container">
      <p class="text-muted">
      <button ng-if="vm.flag_introduction" class="glyphicon glyphicon-user btn btn-danger" ng-click="vm.toggleAssistance()"></button>
      <button ng-if="! vm.flag_introduction" class="glyphicon glyphicon-user btn btn-info" ng-click="vm.toggleAssistance()"></button>
      Powered By <a href="mailto:allied.service.14@gmail.com?Subject=Contact Us" target="_top">allied.service.14@gmail.com</a>
		</p>
      </div>
    </div>
      
      
      <!-- Include all compiled plugins (below), or include individual files
            as needed -->
    
	  </body>
</html>


