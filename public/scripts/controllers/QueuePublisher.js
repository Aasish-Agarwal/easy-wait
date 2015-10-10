/* scripts/controllers/TimeEntry.js */
    
(function() {
    
    'use strict';

    angular
        .module('easywait')
        .controller('QueuePublisher', QueuePublisher);

    function QueuePublisher(qstatus, $window, $scope, $timeout, $cookies) {

            // vm is our capture variable
            var vm = this;
                
            // Initialize the counter & mobile.

            vm.init = function () {
            	vm.registered_mobile = $cookies.get('registered_mobile');
                vm.auth_token = $cookies.get('auth_token');
                vm.auth_username = $cookies.get('auth_username');
                vm.counter = $cookies.get('current_counter');
                vm.current_bookings = {};
                vm.initial_reserved_slots = 0;
                vm.periodic_reserved_slots = 0;

                vm.flag_authenticated = false;
                vm.flag_show_settings = false;
                
                vm.expireTomorrow = new Date();
                vm.expireTomorrow.setDate(vm.expireTomorrow.getDate() + 1);
                
                if (! vm.counter ) {
                	vm.counter = 0;
                }
                
                if (! vm.registered_mobile ) {
                	vm.registered_mobile = '';
                }
                if (! vm.auth_token ) {
                	vm.auth_token = '';
                }
                if (! vm.auth_username ) {
                	vm.auth_username = '';
                	$window.location.href = '/register';
                } else {
                	vm.flag_authenticated = true;
                }

                if ( vm.flag_authenticated ) {
                    vm.getStatus();
                    vm.update();
                    vm.retrieveAll();
                    vm.currentBookingStatus();
                    vm.getConfiguration();
                }
         	}

          // on the vm.timeentries array
            vm.getStatus = function() {
            	vm.message = '' ;
            	qstatus.getStatus(vm.registered_mobile).then(function(results) {
            	 vm.server_counter = results.data.counter;
                 vm.qsize = results.data.qsize;

	       		  if (vm.counter > 0 ) {
	                  vm.update_rate = Math.round((results.data.updtm - results.data.starttm)/60/vm.counter) + ' min each';
	    		  } else {
	    			  vm.update_rate = '';
	    		  }
	
	    		  vm.last_updated = Math.round((results.data.tmnow - results.data.updtm)/60) ;
	              if ( vm.last_updated > 120 ) {
	            	  vm.last_updated = '';
	              } else {
	            	  vm.last_updated += ' min ago';
	              }
                 
                 console.log(results);
              }, function(error) {
                console.log(error);
              });
            }              

            vm.toggleSettings = function() {
            	if ( vm.flag_show_settings ) {
            		vm.flag_show_settings = false ;
            	} else {
            		vm.flag_show_settings = true;
            	}
            	
            }
            vm.stoplocal = function() {
            	bootbox.confirm("Do you really want to stop the session?", function(result) {
            		if ( result == true ) {
                    	vm.counter = 0;
                        $cookies.put('current_counter',vm.counter, {'expires': vm.expireTomorrow});
                    	vm.retrieveAll();

                        if ( parseInt(vm.server_counter) != 0 ) {
        	            	vm.message = '' ;
        	            	qstatus.stop(vm.auth_token).then(function(results) {
        	                    //console.log(results);
        	                    vm.getStatus();
        	                }, function(error) {
        	                  //console.log(error);
        	                });
                        }
            		}
            	}); 
            }
            vm.nextlocal = function() {
            	vm.counter = parseInt(vm.counter) + 1;
                $cookies.put('current_counter',vm.counter, {'expires': vm.expireTomorrow});
            	vm.retrieveAll();
            }
            vm.refreshView = function() {
            	vm.retrieveAll();
            	vm.getStatus();
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

            vm.update = function() {
                if ( parseInt(vm.counter) > parseInt(vm.server_counter) ) {
	            	vm.message = '' ;
	            	qstatus.update_counter(vm.auth_token, vm.counter).then(function(results) {
	                    //console.log(results);
	                    vm.getStatus();
	                }, function(error) {
	                  //console.log(error);
	                });
                } 
      		   $timeout(vm.update, 1000);
            }

            vm.clearAllBookings  = function() {
            	bootbox.confirm("Do you really want to remove all bookings?", function(result) {
            		if ( result == true ) {
                    	qstatus.clearAllBookings(vm.auth_token).then(function(results) {
                            console.log(results);
                            vm.retrieveAll();
                            vm.getStatus();
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
                    	vm.isAcceptingBookings = false ;
                    } else {
                    	vm.isAcceptingBookings = true ;
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

            vm.setConfiguration = function(name,value) {
            	qstatus.setConfiguration(vm.auth_token, name + '=' + value).then(function(results) {
            		if ( name == 'skip') {
            			vm.initial_slots_to_reserve = '';
            		}
            		if ( name == 'skip_every') {
            			vm.periodic_slots_to_reserve = '';
            		}
            		vm.getConfiguration();
            }, function(error) {
                  console.log(error);
                });
            }

            vm.getConfiguration = function() {
            	qstatus.getConfiguration(vm.auth_token, 'fields=skip,skip_every' ).then(function(results) {
        			vm.initial_reserved_slots = results.data.skip;
        			vm.periodic_reserved_slots = results.data.skip_every;
            		
        			if ( ! vm.initial_reserved_slots ) {
        				vm.initial_reserved_slots = 0;
        			} 
        			if ( ! vm.periodic_reserved_slots ) {
        				vm.periodic_reserved_slots = 0;
        			} 
            	}, function(error) {
                  console.log(error);
                });
            }
    
    
    }
    
})();
