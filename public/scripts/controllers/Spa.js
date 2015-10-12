/* scripts/controllers/TimeEntry.js */
    
(function() {
    
    'use strict';

    angular
    .module('easywait').directive('explore', function() {
        var directive = {};

        directive.restrict = 'E';

        directive.templateUrl = "/html-templates/ew-explore.html";

        directive.scope = {
            vm : "=vm"
        }

        return directive;
    });    
    
    
    angular
    .module('easywait').directive('registration', function() {
        var directive = {};

        directive.restrict = 'E';

        directive.templateUrl = "/html-templates/ew-registration.html";

        directive.scope = {
            vm : "=vm"
        }

        return directive;
    });    
    
    
    
    angular
    .module('easywait').directive('providersettings', function() {
        var directive = {};

        directive.restrict = 'E';

        directive.templateUrl = "/html-templates/ew-provider-settings.html";

        directive.scope = {
            vm : "=vm"
        }

        return directive;
    });    
    
    
    angular
    .module('easywait').directive('serverappointments', function() {
        var directive = {};

        directive.restrict = 'E';

        directive.templateUrl = "/html-templates/ew-provider-appointments.html";

        directive.scope = {
            vm : "=vm"
        }

        return directive;
    });    
    
    
    angular
    .module('easywait').directive('qupdater', function() {
        var directive = {};

        directive.restrict = 'E';

        directive.templateUrl = "/html-templates/ew-qupdater.html";

        directive.scope = {
            vm : "=vm"
        }

        return directive;
    });    

    
    angular
    .module('easywait').directive('clientappointments', function() {
        var directive = {};

        directive.restrict = 'E';

        directive.templateUrl = "/html-templates/ew-client-appointments.html";

        directive.scope = {
            vm : "=vm"
        }

        return directive;
    });    

    
    angular
    .module('easywait').directive('serviceproviders', function() {
        var directive = {};

        directive.restrict = 'E';

        directive.templateUrl = "/html-templates/ew-service-providers.html";

        directive.scope = {
            vm : "=vm"
        }

        return directive;
    });    

    
    
    angular
    .module('easywait').directive('servicesubscription', function() {
        var directive = {};

        directive.restrict = 'E';

        directive.templateUrl = "/html-templates/ew-servicesubscription.html";

        directive.scope = {
            vm : "=vm"
        }

        return directive;
    });    
    
    
    angular
    .module('easywait').directive('servicestatus', function() {
        var directive = {};

        directive.restrict = 'E';

        directive.templateUrl = "/html-templates/ew-servicestatus.html";

        directive.scope = {
            vm : "=vm"
        }

        return directive;
    });    
    
    
    angular
    .module('easywait').directive('mainmenu', function() {
        var directive = {};

        directive.restrict = 'E';

        directive.templateUrl = "/html-templates/ew-mainmenu.html";

        directive.scope = {
            vm : "=vm"
        }

        return directive;
    });    
    

  angular
  .module('easywait').directive('ewtoolbar', function() {
      var directive = {};

      directive.restrict = 'E';

      directive.templateUrl = "/html-templates/ew-toolbar.html";

      directive.scope = {
          vm : "=vm"
      }

      return directive;
  });    

  
    angular
    .module('easywait').directive('ewhome', function() {
        var directive = {};

        directive.restrict = 'E';

        directive.templateUrl = "/html-templates/ew-home.html";

        directive.scope = {
            vm : "=vm"
        }

        return directive;
    });    
    
    
    
    angular
        .module('easywait')
        .controller('QueueViewer', QueueViewer);

    function QueueViewer(qstatus, $sce,  $window, $timeout, $cookies) {

            // vm is our capture variable
            var vm = this;
            vm.init = function () {
                vm.expireTomorrow = new Date();
                vm.expireTomorrow.setDate(vm.expireTomorrow.getDate() + 1);
            	
            	// Initialize the counter & mobile.
                vm.counter = '';
                vm.message = '';
                vm.token='';
                vm.name_to_publish = '';
                vm.country_code = 91;
                vm.update_rate = '';
                vm.last_updated = '';

                vm.flag_show_name = true;
                vm.flag_show_number = false;
                vm.flag_show_otp = false;
                
                vm.flag_show_customer_help = false;
                vm.flag_show_provider_help = false;
                
                
                vm.IDX_HOME = 0;
                vm.IDX_CUSTOMER = 1;
                vm.IDX_PROVIDER = 2;
                vm.IDX_SETTINGS = 3;
                vm.IDX_EXPLORE = 4;
                vm.sectionNames = new Array("home", "customer", "provider", "settings", "explore");
                vm.visibleSection = new Array();
                vm.last_section = $cookies.get('last_section');
                
                if ( ! vm.last_section ) {
                	vm.last_section = "home";
                } 
                vm.setActiveSection(vm.last_section);
                
                vm.mobile = $cookies.get('last_subscription');
                vm.subscribed_numbers = angular.fromJson($cookies.get('subscribed_numbers'));
                vm.vendor_info_map = angular.fromJson($cookies.get('vendor_info_map'));
                vm.current_bookings = angular.fromJson($cookies.get('current_bookings'));
                vm.all_bookings = angular.fromJson($cookies.get('all_bookings'));
                vm.booked_counters = {};

                vm.flag_introduction = $cookies.get('introduction_watched');

                if ( ! vm.flag_introduction ) {
                	vm.flag_introduction = true;
                } else {
                	vm.flag_introduction = false;
                }
                
                vm.expireDate = new Date();
                vm.expireDate.setDate(vm.expireDate.getDate() + 365);
                vm.isAcceptingBookings = 0;
                vm.qsize = 0;
                

                if ( vm.mobile ) {
                	vm.flag_viewing_queue = true;
                    vm.getStatus();
                } else {
                	vm.flag_viewing_queue = false;
                }
                
                if (! vm.all_bookings ) {
                	vm.all_bookings = {};
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

                vm.message ='';
         	}

            vm.haselements = function(obj) {
                var size = 0, key;
                for (key in obj) {
                    if (obj.hasOwnProperty(key)) size++;
                }
                if ( size > 0 ) {
                	return true;
                } else {
                	return false;
                }
            };
            
            vm.setActiveSection = function (section_name ) {
            	for	(var index = 0; index < vm.sectionNames.length; index++) {
            	    if ( vm.sectionNames[index] == section_name) {
            	    	vm.visibleSection[index] = true;
                        $cookies.put('last_section',section_name, {'expires': vm.expireDate});
            	    } else {
            	    	vm.visibleSection[index] = false;
            	    }
            	}
            }
            
            vm.toggleshow_provider_help = function (){
            	if ( vm.flag_show_provider_help ) {
            		vm.flag_show_provider_help = false ;
            	} else {
            		vm.flag_show_provider_help = true;
            		vm.flag_show_customer_help = false ;
            	}
            }
            
            vm.toggleshow_customer_help = function (){
            	if ( vm.flag_show_customer_help ) {
            		vm.flag_show_customer_help = false ;
            	} else {
            		vm.flag_show_customer_help = true;
            		vm.flag_show_provider_help = false ;
            	}
            }

            
            vm.toggleAssistance = function (){
            	if ( vm.flag_introduction ) {
            		vm.flag_introduction = false ;
            	} else {
            		vm.flag_introduction = true;
            	}
                $cookies.put('introduction_watched','watched', {'expires': vm.expireDate});
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
            	
            	if ( !vm.mobile ) {
            		return;
            	}
            	qstatus.getStatus(vm.mobile).then(function(results) {
        		  vm.counter = results.data.counter;

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
                  
                  vm.isAcceptingBookings = results.data.bookings_open;
                  vm.qsize = results.data.qsize;
                  if ( vm.isAcceptingBookings == "0") {
                	  vm.isAcceptingBookings = false;
                  } else {
                	  vm.isAcceptingBookings = true;
                  }

        		  //$timeout(vm.getStatus, 60000);
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

                if ( !mobile ) {
                	return;
                }

                if ( mobile == "6" ||  mobile == "7" ) {
                	mobile = "919871867488";
                }
               
                qstatus.getvendorinfo(mobile).then(function(results) {
                	if ( results.data.found == 0 ) {
                    	vm.vendor_info_map[mobile] = results.data.name;
                        vm.subscribed_numbers[mobile] = mobile; 
                        vm.mobile = mobile;
                    	vm.flag_viewing_queue = true;
                        vm.getStatus();

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
                        
                        // Setting a cookie
                        $cookies.put('registered_mobile',vm.cell_to_register, {'expires': vm.expireDate});
                        $cookies.put('auth_token',vm.token, {'expires': vm.expireDate});
                        $cookies.put('auth_username',vm.name_to_publish, {'expires': vm.expireDate});
                        
                        vm.cell_of_provider = vm.cell_to_register;
                        vm.setVendorName();

                        vm.cell_to_register = '';
                        vm.otp = '';
                        vm.name_to_publish = '';
                		vm.flag_show_otp = false;
                    	
                    	vm.message = 'Thanks for giving us an opportunity to serve. You can now start managing your queues' ;
                	}
                    console.log(results);
                }, function(error) {
                  console.log(error);
                });
            }
            
            vm.addBooking = function(mobile,reference,position) {
            	vm.preferred_position='';
            	
            	if ( ! reference ) {
            		alert("Booking requires a reference");
            		return;
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
                    	bootbox.alert("Failed to book appointment: " + results.data.srvr_msg, function() {});
                    }
                    vm.getStatus();
                    
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
            
            vm.cancelAllBookings = function(mobile) {
            	bootbox.confirm("Do you really want to remove all bookings?", function(result) {
            		if ( result == true ) {
				    	for (var i in vm.booked_counters) {
				    		var counter = vm.booked_counters[i];
				    		vm.cancelBooking(mobile, vm.current_bookings[counter] , counter);
				    	}
            		}
            	}); 
            }            
            
            
            vm.currentBookingStatus = function(mobile) {
            	qstatus.isAcceptingAppointment(mobile).then(function(results) {
            		vm.isAcceptingBookings = results.data.bookings_open;

                    if ( vm.isAcceptingBookings == "0") {
                    	vm.isAcceptingBookings = false;
                    } else {
                    	vm.isAcceptingBookings = true;
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
                	vm.flag_viewing_queue = false;
                	vm.booked_counters = {};
                	vm.current_bookings = {};
                    $cookies.remove('last_subscription');
                    $cookies.remove('current_bookings');
                }
                
                $cookies.put('subscribed_numbers',angular.toJson(vm.subscribed_numbers), {'expires': vm.expireDate});
                $cookies.put('all_bookings',angular.toJson(vm.all_bookings), {'expires': vm.expireTomorrow});
            }
            
            
            vm.showNumberInput  = function() {
            	if ( vm.name_to_publish && vm.name_to_publish.length > 0 ) {
            		vm.flag_show_name = false;
            		vm.flag_show_number = true;
            		vm.message = 'Provide your mobile number with country code';
            	}
            }
    }

    
    
})();
