/* scripts/controllers/TimeEntry.js */
    
(function() {
    
    'use strict';

    angular
        .module('easywait')
        .controller('QueueViewer', QueueViewer);

    function QueueViewer(qstatus, $scope, $timeout, $cookies) {

            // vm is our capture variable
            var vm = this;
                
            vm.mytimeout = null;
            
            vm.init = function () {
                // Initialize the counter & mobile.
                vm.counter = '';
                vm.message = '';
                vm.token='';
                vm.name_to_publish = '';

                vm.mobile = $cookies.get('last_subscription');
                vm.subscribed_numbers = angular.fromJson($cookies.get('subscribed_numbers'));
                vm.vendor_info_map = angular.fromJson($cookies.get('vendor_info_map'));
                vm.current_bookings = angular.fromJson($cookies.get('current_bookings'));
                vm.all_bookings = angular.fromJson($cookies.get('all_bookings'));
                vm.booked_counters = {};
                
                vm.expireDate = new Date();
                vm.expireDate.setDate(vm.expireDate.getDate() + 365);
                vm.isAcceptingBookings = 0;
                
                vm.expireTomorrow = new Date();
                vm.expireTomorrow.setDate(vm.expireTomorrow.getDate() + 1);

                if (! vm.all_bookings ) {
                	vm.all_bookings = {};
                } 
                
                
                if (! vm.mobile ) {
                	vm.mobile = '';
                } else {
                	vm.currentBookingStatus(vm.mobile);
                }

                if (! vm.subscribed_numbers ) {
                	vm.subscribed_numbers = {};
                }

                if (! vm.current_bookings ) {
                	vm.current_bookings = {};
                } else {
                	vm.booked_counters = Object.keys(vm.current_bookings);
                }

                if (! vm.vendor_info_map ) {
                	vm.vendor_info_map = {};
                }

                vm.getStatus();
                vm.message ='';
         	}

            // Fetches the time entries and puts the results
            // on the vm.timeentries array
         	
         	vm.showpos = function (pos) {
         		  var crd = pos.coords;

         		  console.log('Your current position is:');
         		  console.log('Latitude : ' + crd.latitude);
         		  console.log('Longitude: ' + crd.longitude);
         		  console.log('More or less ' + crd.accuracy + ' meters.');
         		 vm.location = crd.latitude + " "  + crd.longitude ;
         		 return crd.latitude;
         	};

         	// http://maps.googleapis.com/maps/api/geocode/json?latlng=28.6596214,77.3797392&sensor=true
         	
     		vm.showerror =   function (err) {
     		  console.warn('ERROR(' + err.code + '): ' + err.message);
     		  return "BAD";
     		};
         		
         	//navigator.geolocation.getCurrentPosition(vm.showpos , vm.showerror  );

     		// Fetches the time entries and puts the results
          // on the vm.timeentries array
            vm.getStatus = function() {
            	vm.message = '' ;
            	qstatus.getStatus(vm.mobile).then(function(results) {
        		  vm.counter = results.data.counter;
        		  $timeout(vm.getStatus, 60000);
                  console.log(results);
              }, function(error) {
                console.log(error);
              });
            }              

            vm.setVendorName = function() {
            	qstatus.setvendorname(vm.token, vm.name_to_publish).then(function(results) {
                    console.log(results);
                }, function(error) {
                  console.log(error);
                });
            }
            
            vm.setMobile  = function( mobile ) {
                vm.mobile_to_subscribe = '';

               
                qstatus.getvendorinfo(mobile).then(function(results) {
                	if ( results.data.found == 0 ) {
                    	vm.vendor_info_map[mobile] = results.data.name;
                        vm.subscribed_numbers[mobile] = mobile; 
                        vm.mobile = mobile;
                        vm.getStatus();
                        vm.currentBookingStatus(mobile);

                        if ( vm.all_bookings[mobile] ) {
                        	vm.current_bookings = vm.all_bookings[mobile] ;
                        	vm.booked_counters = Object.keys(vm.current_bookings);
                        } else {
                        	vm.all_bookings[mobile] = {};
                        }

                        $cookies.put('vendor_info_map',angular.toJson(vm.vendor_info_map), {'expires': vm.expireDate});
                        $cookies.put('subscribed_numbers',angular.toJson(vm.subscribed_numbers), {'expires': vm.expireDate});
                        $cookies.put('last_subscription',mobile, {'expires': vm.expireDate});
                	} else {
                		alert("Publisher not registered");
                	}
                	console.log(results);
                }, function(error) {
	                console.log(error);
	            });
                
            }    

            vm.register = function() {
            	qstatus.register(vm.cell_to_register).then(function(results) {
                	vm.message = results.data ;
                    console.log(results);
                }, function(error) {
                  console.log(error);
                });
            } 

            vm.verifyOTP = function() {
            	vm.message = '' ;
            	qstatus.verify(vm.cell_to_register,vm.otp).then(function(results) {
                	vm.token = results.data.token ;
                    
                    // Setting a cookie
                    $cookies.put('registered_mobile',vm.cell_to_register, {'expires': vm.expireDate});
                    $cookies.put('auth_token',vm.token, {'expires': vm.expireDate});
                    $cookies.put('auth_username',vm.name_to_publish, {'expires': vm.expireDate});
                    
                    vm.cell_of_provider = vm.cell_to_register;
                    vm.getProviderStatus();
                    vm.setVendorName();

                    vm.cell_to_register = '';
                    vm.otp = '';
                    vm.name_to_publish = '';
                    
                	vm.message = 'Thanks for giving us an opportunity to serve. Chant Hare Krishna and Be Happy' ;
                    console.log(results);
                }, function(error) {
                  console.log(error);
                });
            }
            
            vm.addBooking = function(mobile,reference,position) {
            	vm.preferred_position='';
            	
            	if (typeof reference == 'undefined') {
            		alert("Booking requires a reference");
            		return;
            	}
            	
            	if (typeof position == 'undefined') {
            		position = 0;
            	}
            	if ( !position ) {
            		position = 0;
            	}

            	qstatus.bookAppointmemt(mobile,reference,position).then(function(results) {
                    console.log(results);
                    if ( results.data.status > 0 ) {
                    	vm.current_bookings[results.data.counter] = reference;
                    	vm.booked_counters = Object.keys(vm.current_bookings);
                    	vm.all_bookings[mobile] = vm.current_bookings;
                        $cookies.put('current_bookings',angular.toJson(vm.current_bookings), {'expires': vm.expireTomorrow});
                        $cookies.put('all_bookings',angular.toJson(vm.all_bookings), {'expires': vm.expireTomorrow});
                        vm.booking_reference = '';
                    } else {
                    	alert ("Failed to book appointment: " + results.data.srvr_msg);
                    }
            }, function(error) {
                  console.log(error);
                });

            }

            
            vm.cancelBooking = function(mobile,reference,counter) {
            	qstatus.cancelBooking(mobile,reference).then(function(results) {
            			console.log(results);
	                    if ( results.data.status > 0 ) {
	                    	delete vm.current_bookings[counter];
	                    	vm.booked_counters = Object.keys(vm.current_bookings);
	                    	vm.all_bookings[mobile] = vm.current_bookings;
	                        $cookies.put('current_bookings',angular.toJson(vm.current_bookings), {'expires': vm.expireTomorrow});
	                        $cookies.put('all_bookings',angular.toJson(vm.all_bookings), {'expires': vm.expireTomorrow});
	                    } 
		            }, function(error) {
		                  console.log(error);
		             });
            }
            
            
            vm.currentBookingStatus = function(mobile) {
            	qstatus.isAcceptingAppointment(mobile).then(function(results) {
            		vm.isAcceptingBookings = results.data.bookings_open;

                    if ( vm.isAcceptingBookings == "0") {
                    	vm.AppointmentsOpen = '';
                    	vm.AppointmentsClosed = 'Closed';
                    } else {
                    	vm.AppointmentsOpen = 'Open';
                    	vm.AppointmentsClosed = '';

                    }
                    console.log(results);
                }, function(error) {
                  console.log(error);
                });
            } 

            vm.removeSubscription = function(mobile) {
            	delete vm.subscribed_numbers[mobile];
            	delete vm.all_bookings[mobile] ;

                if ( mobile == vm.mobile ) {
                	vm.counter = '';
                    vm.mobile = '';
                	vm.booked_counters = {};
                	vm.current_bookings = {};
                    $cookies.remove('last_subscription');
                    $cookies.remove('current_bookings');
                }
                
                $cookies.put('subscribed_numbers',angular.toJson(vm.subscribed_numbers), {'expires': vm.expireDate});
                $cookies.put('all_bookings',angular.toJson(vm.all_bookings), {'expires': vm.expireTomorrow});
            }
    }
    
})();
