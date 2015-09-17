@extends('layouts.master')

@section('content')

 <div class="container-fluid">
 <div class="row">

 <div class="col-md-8 col-md-offset-2">
 <div class="panel panel-default">
 <div class="panel-heading">Lines</div>
 <div class="panel-body">

	 @foreach ( $lines as $line)
	 	<h2>{{ $line->cell }}</h2>
	 @endforeach
</div>
 </div>
 </div>
 </div>
 </div>

@endsection
