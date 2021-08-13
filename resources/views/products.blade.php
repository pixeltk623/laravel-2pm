<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container">

        <h1 class="text-primary text-center">Add To Cart</h1>

       @if (session('msg'))
        <div class="alert alert-success">
           {{ session('msg') }}
        </div>
        @endif

        @php
            $total = 0;
        @endphp

        @foreach(session('cart') as $id => $dataValue)
            @php $total = $total+1; @endphp
        @endforeach

        <div class="dropdown">
          <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            Cart <span class="badge bg-secondary">{{$total}}</span>
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="width: 100%;"> 
            <div><a class="dropdown-item" href="#">Action</a></div>
            <div><a class="dropdown-item" href="#">Another action</a></div>
            <div><a class="dropdown-item" href="#">Something else here</a></div>
          </div>
        </div>

        <br><br>
        <div class="row row-cols-1 row-cols-md-4 g-4">
            @foreach($data as $data)
            <div class="col">
                <div class="card">
                  <img src="{{$data['image']}}" width="100%" height="250px" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">{{ $data['name'] }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Cloths</h6>
                    <h5>{{ $data['price'] }}</h5>

                    <p class="card-text">{{ $data['description'] }}</p>
                  </div>
                </div>
                <a href="addToCart/{{$data['id']}}" class="btn btn-warning w-100 mt-2">Add To Cart</a>
            </div>


            @endforeach

        </div>
    </div>

 <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>