
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

  <a href="{{ url('/create') }}" class="btn btn-primary">Add Blog</a>
  <br><br>

  @if(Session::has('message'))
    <div class="alert alert-success">
        {{ Session::get('message') }}
    </div>
  @endif

  @if(Session::has('message_d'))
    <div class="alert alert-danger">
        {{ Session::get('message_d') }}
    </div>
  @endif
  <table class="table table-bordered">
    <thead>
      <tr>
      	<th>Sr.No</th>
        <th>Title</th>
        <th>Source</th>
        <th>Description</th>
        <th>Created At</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    @foreach($blog as $key => $blog)
      <tr>
      	<td>{{ ++$key }}</td>
      	<td>{{$blog['title']}}</td>
      	<td>{{$blog['source']}}</td>
      	<td>{{$blog['description']}}</td>
        <td> {{ $blog['created_at']->format('Y-m-d') }}</td>
        <td>
          
            <a href="{{ url('show') }}/{{ $blog['id'] }}" class="btn btn-primary">Show</a>
            <a href="{{ url('edit') }}/{{ $blog['id'] }}" class="btn btn-warning">Edit</a>
            <a href="{{ url('delete') }}/{{ $blog['id'] }}" class="btn btn-danger">Delete</a>

            <form method="post" action="{{ route('deleteFormData') }}">
              @csrf
                <input type="hidden" name="did" value="{{ $blog['id'] }}">
                <input type="submit" name="submit" value="Delete" class="btn btn-primary">
            </form>
        </td>
      </tr>
     @endforeach
    </tbody>
  </table>
</div>

</body>
</html>
