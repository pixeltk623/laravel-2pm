@extends('blogs/layout')
@section('page_title','Manage Blade')
@section('description','PHP Training')
@section('container')
	<h2>Blogs Page</h2>

	<h1></h1>

	@if(count($data)>1)
		<h1>Hello</h1>

	@else
		<h1>Hi</h1>		
	@endif

	@if(true)
		<p>{{count($data)}}</p>
	@endif


	@if (count($data) === 1)
    I have one record!
	@elseif (count($data) > 1)
	    I have multiple data!
	@else
	    I don't have any records!
	@endif


	@isset($data)
     $records is defined and is not null...
	@endisset

	@empty($data)
	    // $records is "empty"...
	@endempty
@endsection
