{{-- @extends('blogs/layout')
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
 --}}

 <!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Bordered Table</h2>
  <p>The .table-bordered class adds borders on all sides of the table and the cells:</p>            
  <table class="table table-bordered">
    <thead>
      <tr>
      	<th>Sr.No</th>
        <th>Title</th>
        <th>Source</th>
        <th>Description</th>
      </tr>
    </thead>
    <tbody>
    @foreach($blog as $key => $blog)
      <tr>
      	<td>{{ ++$key }}</td>
      	<td>{{$blog['title']}}</td>
      	<td>{{$blog['source']}}</td>
      	<td>{{$blog['description']}}</td>
      </tr>
     @endforeach
    </tbody>
  </table>
</div>

</body>
</html>
