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
                <?php 

                $totalAmount = 0;

                ?>
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
                    <?php 
                    $totalAmount = $totalAmount + $dataValue['price'] * $dataValue['quantity'];
                    ?>
                @endforeach
                    <tr>
                        <th colspan="4" class="text-center text-primary">Total Amount </th>
                        <th colspan="2">{{ $totalAmount}}</th>
                    </tr>
            @else
                <tr>
                    <th class="text-danger text-center" colspan="6">No Product Found</th>
                </tr>
            @endif

        </table>

      <a href="Checkout" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-warning">Payment( ₹ {{  $totalAmount}})</a>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="post" id="formData">
             <div class="row">
              <div class="col-md-6 mb-3">
                <label for="cc-name">Name on card</label>
                <input type="text" class="form-control" id="cc-name" placeholder="" required>
                <small class="text-muted">Full name as displayed on card</small>
                <div class="invalid-feedback">
                  Name on card is required
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="cc-number">Credit card number</label>
                <input type="text" class="form-control" id="cc-number" placeholder="" required>
                <div class="invalid-feedback">
                  Credit card number is required
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3 mb-3">
                <label for="cc-expiration">Expiration</label>
                <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                <div class="invalid-feedback">
                  Expiration date required
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="cc-expiration">CVV</label>
                <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                <div class="invalid-feedback">
                  Security code required
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary" id="pay">Pay</button>
        </form>
          </div>
        
        </div>
        </div>
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

            // $(document).on("click", "#pay", function(){
            //     var str = $( "#form" ).serialize();
            //     console.log(str);
            // });

            $( 'form' ).submit(function ( e ) {
                var carHolderName = $("#cc-name").val();
                var cardNumber = $("#cc-number").val();
                var expiryDate = $("#cc-expiration").val();
                var cardCvv = $("#cc-cvv").val();

                var  cardData =  { carHolderName: carHolderName, cardNumber: cardNumber,  expiryDate: expiryDate, cardCvv: cardCvv, "_token": "{{ csrf_token() }}" }

                $.ajax({
                  type: 'POST',
                  url: "http://127.0.0.1:8000/stripe-token",
                  data: cardData,
                  dataType: "text",
                  success: function(token) {
                        //
                        var tokenId = JSON.parse(token);

                        if (tokenId) {
                             $.ajax({
                                  type: 'POST',
                                  url: "http://127.0.0.1:8000/payment",
                                  data: {tokenId: tokenId, "_token": "{{ csrf_token() }}"},
                                  dataType: "text",
                                  success: function(message) {
                                    console.log(message);
                                  }
                             });
                        }

                    }
                });


                e.preventDefault();


            })
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