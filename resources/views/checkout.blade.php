<?php 
  

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <title>Hello, world!</title>
  </head>
  <body>
    <div class="container">

        <h1 class="text-primary text-center">Checkout Page</h1>

        @if (session('msg'))
        <div class="alert alert-success">
           {{ session('msg') }}
        </div>
        @endif

        <table class="table table-bordered">
        	<tr>
        		<th>Sr.No</th>
        		<th>Image</th>
        		<th>Product Name</th>
        		<th>Quantity</th>
        		<th>Total Price</th>
        		<th>Action</th>
        	</tr>

            @if (session('cart'))
                @php    
                    $slno=1;
                @endphp
                @foreach(session('cart') as $id => $dataValue)
                    <tr>
                        <td>{{$slno++}}</td>
                        <td>
                            <img src="{{$dataValue['image']}}" width="50">
                        </td>
                        <td>{{$dataValue['name'] }}</td>
                        <td>
                            <input type="number" data-id="{{ $id }}" id="qty" name="qty" value="{{ $dataValue['quantity'] }}">
                         </td>
                        <td>{{ $dataValue['price'] * $dataValue['quantity'] }}</td>
                        <td>
                            <a href="delete/{{ $id }}" class="btn btn-danger" >Delete</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <th class="text-danger text-center" colspan="6">No Product Found</th>
                </tr>
            @endif

        </table>

      
    </div>

    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on("change","#qty",  function(){
                var qty = $(this).val();

                var pid = $(this).data("id");
                console.log(qty);
               var  myKeyVals =  { pid: pid, qty: qty, "_token": "{{ csrf_token() }}" }


                if (qty>0) {

                     $.ajax({
                          type: 'POST',
                          url: "http://127.0.0.1:8000/update",
                          data: myKeyVals,
                          dataType: "text",
                          success: function(resultData) {
                                
                                location.reload(); 

                            }
                        });

                } else {
                    $(this).val("1");
                    alert("For Delete This Product You can click on delete button");
                }
            });
        });
    </script>
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