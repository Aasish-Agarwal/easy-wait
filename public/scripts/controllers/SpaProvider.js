/* scripts/controllers/TimeEntry.js */
    
(function() {
    
    'use strict';

    angular
        .module('easywait')
        .controller('QueuePublisher', QueuePublisher);

    function QueuePublisher(qstatus, $sce,  $window, $scope, $timeout, $cookies) {

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

                vm.flag_show_name = true;
                vm.flag_show_number = false;
                vm.flag_show_otp = false;
                
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

            vm.setVendorName = function(  ) {
            	if ( vm.name_to_publish && vm.name_to_publish.length > 0 ) {
                	qstatus.setvendorname(vm.auth_token,vm.name_to_publish).then(function(results) {
                    	vm.auth_username = vm.name_to_publish;
                        $cookies.put('auth_username',vm.auth_username, {'expires': vm.expireDate});
                    	vm.name_to_publish = '';
                        console.log(results);
                    }, function(error) {
                      console.log(error);
                    });
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
                if ( parseInt(value) >= 0 ) {

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
                } else {
                	bootbox.alert("Numeric Value Required", function() {});
                }
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

            vm.showNumberInput  = function() {
            	if ( vm.name_to_publish && vm.name_to_publish.length > 0 ) {
            		vm.flag_show_name = false;
            		vm.flag_show_number = true;
            		vm.message = 'Provide your mobile number with country code';
            	}
            }

            vm.register = function() {
            	
                //vm.flag_show_number = false;
                //vm.flag_show_otp = false;

            	if ( vm.cell_to_register ) {
                	qstatus.register(vm.cell_to_register).then(function(results) {

                        if ( results.data.status == 'Exception' ) {
                        	var message = results.data.service_response;
                        	if ( typeof(message) == 'object') {
                        		message = JSON.stringify(message);
                        	}
                        	bootbox.alert(message, function() {});
                        } else {
                    		vm.flag_show_number = false;
                    		vm.flag_show_otp = true;
                    		
                    		var message = results.data.message ;
                    		message += '<hr>Registration For: ' + vm.cell_to_register;
                    		message += '<hr>If you do not recieve the missed call in next 10 minutes.';
                    		message +=  '<ul><li>Verify that you have the correct number specified.</li>' ;
                    		message += '<li>If the number is correct try again in 10 minutes</li>' ;
                    		message += '<li>If you still dont get the missed call, contact us via eMail</li></ul>' ;
                    		
                    		
                    		vm.message = $sce.trustAsHtml(message) ;
                    		
                    		if (results.data.service == 'cognalys') {
                    			vm.otp_service = 'cognalys';
                    			vm.keymatch = results.data.keymatch;
                    			vm.otp_start = results.data.otp_start;
                    		} else {
                    			vm.otp_service = 'motp';
                    		}
                        }
                        console.log(results);
                	}, function(error) {
                      console.log(error);
                    });
            	} else {
                	bootbox.alert("Invalid Mobile Number ", function() {});
            	}
            } 

            vm.verifyOTP = function() {
            	vm.message = '' ;
            	if ( !vm.otp ) {
                	bootbox.alert("OTP Required", function() {});
            		return;
            	}
            	
    			var options = '';
    			if ( vm.otp_service == 'cognalys' ) {
    				options = 'service=cognalys&keymatch=' + vm.keymatch + '&otp_start=' + vm.otp_start; 
    			} else {
    				options = 'service=motp'; 
    			}
            	
            	qstatus.verify(vm.cell_to_register,vm.otp,options).then(function(results) {
                	if ( results.data.token == "undef" ) {
                    	bootbox.alert("OTP Is incorrect" , function() {});
                	} else {
                		vm.token = results.data.token ;

                    	vm.registered_mobile = vm.cell_to_register;
                        vm.auth_token = vm.token;
                		
                        // Setting a cookie
                        $cookies.put('registered_mobile',vm.cell_to_register, {'expires': vm.expireDate});
                        $cookies.put('auth_token',vm.token, {'expires': vm.expireDate});
                        $cookies.put('auth_username',vm.name_to_publish, {'expires': vm.expireDate});
                        
                        vm.cell_of_provider = vm.cell_to_register;
                        vm.setVendorName();

                        //vm.cell_to_register = '';
                        vm.otp = '';
                        //vm.name_to_publish = '';
                		vm.flag_show_otp = false;
                    	vm.flag_authenticated = true;

                    	vm.getStatus();
                        vm.update();
                        vm.retrieveAll();
                        vm.currentBookingStatus();
                        vm.getConfiguration();
                    	
                    	vm.message = 'Thanks for giving us an opportunity to serve. You can now start managing your queues' ;
                	}
                    console.log(results);
                }, function(error) {
                  console.log(error);
                });
            }
            
    
    }
    
})();
