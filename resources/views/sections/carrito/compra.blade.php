<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        
    <link href="{{ asset('carrito/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('carrito/css/estilo.css') }}" rel="stylesheet">

    <script src="{{ asset('carrito/js/popper.min.js') }}"></script>


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <link href="{{ asset('carrito/css/sweetalert2.min.css') }}" rel="stylesheet">


    <title>Diroxa Software- Buy Section</title>

</head>

<body>
    <header>
        <div class="container">
            <div class="row justify-content-between mb-5">
                <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
                    <a class="navbar-brand" href="index.html">Shop Section</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </nav>
            </div>
        </div>
    </header>

    <br>

    <main>
        <div class="container">
            <div class="row mt-3">
                <div class="col">
                    <h2 class="d-flex justify-content-center mb-3">Finalizing buy</h2>
                    <form id="procesar-pago" action="#" method="post">
                    @csrf
                      

                        <div id="carrito" class="form-group table-responsive" >
                            <table class="table" id="lista-compra" >
                                <thead>
                                    <tr>
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Total Vat (20%)</th>
                                        <th scope="col">Sub Total(incl Vat)</th>
                                        <th scope="col">Clean</th>
                                    </tr>

                                </thead>
                                <tbody >

                                </tbody>
                                <tr>
                                    <th colspan="4" scope="col" class="text-right">SUB TOTAL :</th>
                                    <th scope="col">
                                        <p id="subtotal"></p>
                                    </th>
                                    <!-- <th scope="col"></th> -->
                                </tr>
                                <tr>
                                    <th colspan="4" scope="col" class="text-right">Tax :</th>
                                    <th scope="col">
                                        <p id="igv"></p>
                                    </th>
                                    <!-- <th scope="col"></th> -->
                                </tr>



                                <tr>
                                    <th colspan="4" scope="col" class="text-right">TOTAL :</th>
                                    <th scope="col">
                                        <input id="total" name="monto" class="font-weight-bold border-0" readonly style="background-color: white;"></input>
                                    </th>
                                    <!-- <th scope="col"></th> -->
                                </tr>

                            </table>
                        </div>

                        <div class="row justify-content-center" id="loaders">
                            <img id="cargando" src="img/cargando.gif" width="220">
                        </div>

                    <div class="row">
                      <div class="col-md-6">
                            <form class="form-inline">
                                <label class="my-1 mr-2" for="paymentMethod">Payment Method</label>
                                <select class="custom-select my-1 mr-sm-2" id="paymentMethod">
                                    <option selected>Choose...</option>
                                    <option value="card">Card</option>
                                    <option value="cash">Cash</option>
                                </select>
                            </form>
                      </div>
                    </div>
                      
                        <div class="row justify-content-between">
                            <div class="col-md-4 mb-2">
                                <a href="#" ></a>
                                <a name="atipobutton"  href=""type="button" class="btn btn-info btn-block redirectKeepBuying" id="redirectKeepBuying">
                                    Back
                                </a>
                            </div>
                            <div class="col-xs-12 col-md-4">
                                <button href="#" class="btn btn-success btn-block" id="procesar-compra">Buy</button>
                            </div>
                        </div>
                    </form>
                    <div class="row text-center" id="h5" >
                </div>
                </div>
            </div>
        </div>
    </main>




    </div>
    <script src="{{ asset('js/store.js') }}" async></script>
  <script src="{{ asset('css/store.css') }}" async></script>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js" integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous"></script>


  <script>
      
      
      $(function(){
        $('button[id="procesar-compra"]').click(function(e){
            
        e.preventDefault(); 
        
        var dataPurchase = (procesarCompra());
        // alert(dataPurchase);
        var dados = dataPurchase;
        
        // var imageSrc = $(this).find('input#imageSrc').val();



        $.ajax({
          url: "{{ route('carrito.invoiceAjax') }}",
          type: 'post',
          data: {data: dados,  _token: '{{csrf_token()}}'},
          success:function(response){              
            //   alert('here') ;              
              console.log(response);
              var idSales = response;
              window.location.replace("/section/carrito/invoice/" + idSales);

          },
          error: function(jqXHR, textStatus, errorThrown) {
            alert(' n deu' + jqXHR + textStatus + errorThrown)
          }
        });
      });
    });

  </script>

    <script src="{{ asset('carrito/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('carrito/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('carrito/js/sweetalert2.min.js') }}"></script>

    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/emailjs-com@2.3.2/dist/email.min.js"></script>

    <script src="{{ asset('carrito/js/carrito.js') }}"></script>
    <script src="{{ asset('carrito/js/compra.js') }}"></script>
    <script src="{{ asset('carrito/js/pedido.js') }}"></script>


</body>

</html>