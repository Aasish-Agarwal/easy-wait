@extends('layouts.master')

@section('content')

<div class="container-fluid">
<div class="row">
<div class="col-md-8 col-md-offset-2">
<div class="panel panel-default">
<div class="panel-heading">Register</div>
<div class="panel-body">

    @if (count($errors) > 0)
	<div class="alert alert-danger">
		<strong>Whoops!</strong> There were some problems with your input.<br><br>
		<ul>
		     @foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
		     @endforeach
	
		</ul>
	</div>

    @endif

<form class="form-horizontal" role="form" method="POST" action="/auth/register">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	
		
	<div class="input-group">
		<span class="input-group-addon">Name</span>
		<input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name">
	</div>
	<div class="input-group">
		<span class="input-group-addon">E-Mail</span>
		<input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="abc@xyz.com">
	</div>
	<div class="input-group">
		<span class="input-group-addon">Password</span>
		<input type="password" class="form-control" name="password">
	</div>
	<div class="input-group">
		<span class="input-group-addon">Confirm Password</span>
		<input type="password" class="form-control" name="password_confirmation">
	</div>
	<div class="input-group col-md-offset-4">
		<button type="submit" class="form-control btn btn-primary">Register</button>
	</div>
	
	<div class="form-group">

	</div>
</form>

</div>
</div>
</div>
</div>
</div>

@endsection
