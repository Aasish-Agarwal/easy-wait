angular.module('easywait')
.factory('qstatus', ['$http', function($http) {

  var getStatus = function(cell) {
    var url = 'api/qstatus/get/' + cell;
    return $http.get(url).success(function(data) { });
  };

  var register = function(cell) {
	    var url = 'api/vendor/register/' + cell;
	    return $http.get(url).success(function(data) { });
  };
  
  var verify = function(cell,otp) {
	    var url = 'api/vendor/verify/' + cell + "/" + otp;
	    return $http.get(url).success(function(data) { });
	};

  var stop = function(token) {
	    var url = 'api/qstatus/reset/' + token ;
	    return $http.get(url).success(function(data) { });
	};

  var next = function(token) {
	    var url = 'api/qstatus/next/' + token;
	    return $http.get(url).success(function(data) { });
	};

  var setvendorname = function(token,name) {
	    var url = 'api/vendor/setname/' + token + "/" + name;
	    return $http.get(url).success(function(data) { });
	};
	
  var getvendorinfo = function(cell) {
	    var url = 'api/qstatus/publicinfo/' + cell ;
	    return $http.get(url).success(function(data) { });
	};

  var bookAppointmemt = function(cell,reference,position) {
	    var url = 'api/appointment/book/' + cell + '/' + reference + '/' + position;
	    return $http.get(url).success(function(data) { });
	};
		
  var update_counter = function(token,counter) {
	    var url = 'api/qstatus/update/' + token+'/' + counter;
	    return $http.get(url).success(function(data) { });
	};

var acceptAppointment = function(token) {
		    var url = 'api/appointment/accept/' + token;
	    return $http.get(url).success(function(data) { });
	};
	
  var closeAppointment = function(token) {
	    var url = 'api/appointment/close/' + token;
	    return $http.get(url).success(function(data) { });
	};
	
  var isAcceptingAppointment = function(cell) {
	    var url = 'api/appointment/isaccepting/' + cell;
	    return $http.get(url).success(function(data) { });
	};
	
	  var retrieveAll = function(token,counter) {
		    var url = 'api/appointment/retrieveall/' + token + '/' + counter;
		    return $http.get(url).success(function(data) { });
		};
		
 var clearAllBookings = function(token,counter) {
	    var url = 'api/appointment/reset/' + token ;
	    return $http.get(url).success(function(data) { });
	};
		
		
	return {
    getStatus: getStatus,
    register: register,
    verify: verify,
    next: next,
    stop: stop,
    setvendorname: setvendorname,
    getvendorinfo: getvendorinfo,
    bookAppointmemt: bookAppointmemt,
    acceptAppointment: acceptAppointment,
    closeAppointment: closeAppointment,
    isAcceptingAppointment: isAcceptingAppointment,
    retrieveAll: retrieveAll,
    update_counter: update_counter,
    clearAllBookings: clearAllBookings
  };
}]);
