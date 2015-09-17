var mod_admin = {};



$(document).ready(function (){
	$.post( "modules/auth/moduleEntry.php", {action:'getAuthStatus'}, function( data ) {
		if ( data.IsVald == 1) {
		    $('#loginuser').html("Welcome " + data.User);
		    $("#frmsignin").hide(); 
		    $("#loggedin").show(); 
		    $("#frmchangepwd").hide(); 
		} else {
		    $("#frmsignin").show(); 
		    $("#loggedin").hide(); 
		}
	});
});


$(document).ajaxError(function( event, request, settings ) {
    //When XHR Status code is 0 there is no connection with the server
    if (request.status == 0){ 
    	
		$(".userstat").css("background-color","red");
        //alert("Communication with the server is lost!");
    } 
});


$('#btnLogin').on('click', function (e) {

	var username = $('#username').val();
	var pwd = $('#pwd').val();
	
	$.post( "modules/auth/moduleEntry.php", {action:'authenticate', username:username,pwd:pwd}, function( data ) {
		if ( data.status == "OK") {
		    $('#loginuser').html("Welcome " + username);
		    $('#username').val("") ;
		    $('#pwd').val("") ;
		    $("#frmsignin").hide(); 
		    $("#loggedin").show(); 
		    $("#frmchangepwd").hide(); 
		} else {
		    $("#frmsignin").show(); 
		    $("#loggedin").hide(); 
		    $('#signinstatus').html("Failed to log in") ;
		}
	});
})

$('#btnUpdateProvider').on('click', function (e) {
	var provider_name = $('#provider_name').val();
	var provider_pwd = $('#provider_pwd').val();
	var provider_fname = $('#provider_fname').val();

	$.post( "modules/auth/moduleEntry.php", {action:'updateProvider', provider_name:provider_name,provider_pwd:provider_pwd,provider_fname:provider_fname }, function( data ) {
		if ( data.status == "OK") {
		    $('#provider_name').val("") ;
		    $('#provider_pwd').val("") ;
		    $('#provider_fname').val("") ;
		    alert("Successfully Updated: " + provider_name);
		} else {
		    alert("Failure Adding: " + provider_name);
		}
	});
})


$('#btnLogout').on('click', function (e) {
	$.post( "modules/auth/moduleEntry.php", {action:'logout'}, function( data ) {
	    $('#signinstatus').html("") ;
	    $("#frmsignin").show(); 
	    $("#loggedin").hide(); 
	    $("#mysessions").html("");
	});
})

$('#btnTogglePwdFrm').on('click', function (e) {
	if($("#frmchangepwd").is(":hidden"))
	{
	    $("#frmchangepwd").show(); 
	} else {
	    $("#frmchangepwd").hide(); 
	}
})

$('#btnChangePwd').on('click', function (e) {
	var oldpwd = $('#oldpwd').val();
	var newpwd = $('#newpwd').val();
	var newpwdrepeat = $('#newpwdrepeat').val();
	
	if ( newpwdrepeat == newpwd ) {
		$.post( "modules/auth/moduleEntry.php", {action:'changePwd', oldpwd:oldpwd,newpwd:newpwd}, function( data ) {
			if ( data.status == "OK") {
			    $("#frmchangepwd").hide(); 
		            alert("Password Changed");
			} else {
		            alert("ERROR:: " + data.statusdetail);
			}
		});
	} else {
		alert("ERROR:: New Passwords Does Not Match");
	}
})
