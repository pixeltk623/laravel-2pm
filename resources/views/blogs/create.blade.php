<!-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
 -->
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

  <form method="post" action="{{ route('create.postdata') }}">
    @csrf
    <div class="form-group">
        <label>Title</label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror">

        @error('title')
            <br>
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
     <div class="form-group">
        <label>Source</label>
        <select class="form-control @error('source') is-invalid @enderror" name="source">
            <option value="">Select</option>
            <option value="News">News</option>
            <option value="Media">Media</option>
            <option value="Website">Website</option>
        </select>
        @error('source')
            <br>
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
     <div class="form-group">
        <label>Description</label>
        <textarea class="form-control @error('description') is-invalid @enderror" name="description"></textarea>
        @error('description')
            <br>
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <input type="submit" name="submit" class="btn btn-primary">
  </form>            
  
</div>

</body>
</html>
