/* scripts/controllers/TimeEntry.js */
    
(function() {
    
    'use strict';

    angular
        .module('easywait')
        .controller('QueuePublisher', QueuePublisher);

    function QueuePublisher(qstatus, $scope, $timeout, $cookies) {

            // vm is our capture variable
            var vm = this;
                
            // Initialize the counter & mobile.

            vm.init = function () {
            	vm.registered_mobile = $cookies.get('registered_mobile');
                vm.auth_token = $cookies.get('auth_token');
                vm.auth_username = $cookies.get('auth_username');
                vm.server_counter = 0;
                vm.current_bookings = {};
                //vm.isAcceptingBookings = 0;

                if (! vm.registered_mobile ) {
                	vm.registered_mobile = '';
                }
                if (! vm.auth_token ) {
                	vm.auth_token = '';
                }
                if (! vm.auth_username ) {
                	vm.auth_username = '';
                }

                vm.getStatus();
                vm.counter = vm.server_counter;
                vm.update();
                vm.currentBookingStatus();
         	}

          // on the vm.timeentries array
            vm.getStatus = function() {
                vm.auth_token = $cookies.get('auth_token');
            	vm.message = '' ;
            	qstatus.getStatus(vm.registered_mobile).then(function(results) {
            	 vm.server_counter = results.data.counter;
                  console.log(results);
                  vm.retrieveAll();
              }, function(error) {
                console.log(error);
              });
            }              

            vm.stoplocal = function() {
            	vm.counter = 0;
            }
            vm.nextlocal = function() {
            	vm.counter = vm.counter + 1;
            }
            
            vm.stop = function() {
                vm.auth_token = $cookies.get('auth_token');
            	vm.message = '' ;
            	qstatus.stop(vm.auth_token).then(function(results) {
                    console.log(results);
                    vm.getStatus();
                }, function(error) {
                  console.log(error);
                });
            }

            vm.retrieveAll = function() {
            	vm.message = '' ;
            	qstatus.retrieveAll(vm.auth_token,vm.counter).then(function(results) {
                    console.log(results);
                    vm.current_bookings = results.data;
                }, function(error) {
                  console.log(error);
                });
            }

            vm.next = function() {
            	vm.message = '' ;
            	qstatus.next(vm.auth_token).then(function(results) {
                    console.log(results);
                    vm.getStatus();
                }, function(error) {
                  console.log(error);
                });
            }
            vm.update = function() {
                if ( vm.counter != vm.server_counter ) {
	            	vm.message = '' ;
	            	qstatus.update_counter(vm.auth_token, vm.counter).then(function(results) {
	                    console.log(results);
	                    vm.getStatus();
	                }, function(error) {
	                  console.log(error);
	                });
                }
      		   $timeout(vm.update, 10000);
            }

            vm.clearAllBookings  = function() {
            	bootbox.confirm("Do you really want to remove all bookings?", function(result) {
            		if ( result == true ) {
                    	qstatus.clearAllBookings(vm.auth_token).then(function(results) {
                            console.log(results);
                            vm.retrieveAll();
                        }, function(error) {
                          console.log(error);
                        });
            		}
            	}); 
            }

            vm.currentBookingStatus = function() {
            	qstatus.isAcceptingAppointment(vm.registered_mobile).then(function(results) {
            		vm.isAcceptingBookings = results.data.bookings_open;
                    if ( vm.isAcceptingBookings == "0") {
                    	vm.isAcceptingBookings = '';
                    	vm.isNotAcceptingBookings = 'Closed';
                    } else {
                    	vm.isAcceptingBookings = 'Open';
                    	vm.isNotAcceptingBookings = '';
                    }
            		console.log(results);
                }, function(error) {
                  console.log(error);
                });
            } 
            
            vm.acceptAppointments = function() {
            	qstatus.acceptAppointment(vm.auth_token).then(function(results) {
            		vm.currentBookingStatus();
            		console.log(results.data.bookings_open);
                }, function(error) {
                  console.log(error);
                });
            } 

            vm.closeAppointments = function() {
            	qstatus.closeAppointment(vm.auth_token).then(function(results) {
            		vm.currentBookingStatus();
            		console.log(results);
                }, function(error) {
                  console.log(error);
                });
            } 
            
    }
    
})();
