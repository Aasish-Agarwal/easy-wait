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

    
   </head>
   <body>

		<div class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" >
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="index.html" class="navbar-brand">Easy Wait</a>
				</div>

				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav">

					<li><a href="/auth/login">Login</a></li>
					<li><a href="/auth/logout">Logout</a></li>
					<li><a href="/auth/register">Register</a></li>
					<li><a href="/line">Lines</a></li>
				</div>
			</div>
		</div>

      <div class="container">
            <div class="row">
                  <div class="col-md-12">
                        <p></p>
                  </div>
                  <div class="col-md-12">
                        <p></p>
                  </div>
                  <div class="col-md-12">
                        <p></p>
                  </div>
                  <div class="col-md-12">
                        <p></p>
                  </div>
            </div>
      </div>
      
      <!-- Grid System
      ====================================== -->
      <div class="container">
      	<div class="row">
      	<h3></h3>
      	</div>

      	<div class="row">
            <div class="col-md-9 content">
            	@yield('content')
            </div>
      	
      </div>

      <!-- Include all compiled plugins (below), or include individual files
            as needed -->
	  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
   </body>
</html>
