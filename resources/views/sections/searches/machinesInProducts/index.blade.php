    <!DOCTYPE html>
    <html lang="en">

    <head>

      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <meta name="author" content="">

      <title>DIROXA SOFTWARE</title>

      <!-- Custom fonts for this template -->
      <link href="{{ asset('admlyt/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
      <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

      <!-- Custom styles for this template -->
      <link href="{{ asset('admlyt/css/sb-admin-2.min.css') }}" rel="stylesheet">

      <!-- Custom styles for this page -->
      <link href="{{ asset('admlyt/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    </head>


    <style>


    body,html{
        height: 100%;
        width: 100%;
        margin: 0;
        padding: 0;
        background: #e74c3c !important;
        }

        .searchbar{
        margin-bottom: auto;
        margin-top: auto;
        height: 60px;
        background-color: #353b48;
        border-radius: 30px;
        padding: 10px;
        }

        .search_input{
        color: white;
        border: 0;
        outline: 0;
        background: none;
        width: 0;
        caret-color:transparent;
        line-height: 40px;
        transition: width 0.4s linear;
        }

        .searchbar:hover > .search_input{
        padding: 0 10px;
        width: 450px;
        caret-color:red;
        transition: width 0.4s linear;
        }

        .searchbar:hover > .search_icon{
        background: white;
        color: #e74c3c;
        }

        .search_icon{
        height: 40px;
        width: 40px;
        float: right;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        color:white;
        text-decoration:none;
        }

    </style>

          <span>
                @include('sections.components.topnavbar')
          </span>

          <!-- Begin Page Content -->
      <div class="container-fluid">

      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Searching Products in Machines</h1>
        <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
      </div>

      <div class="alert alert-info">
        <p>Type the Machine mode/name and we we'll show you all products in this Machine</p>

      </div>
      <!-- Content Row -->

      <div class="row">
      <div class="container h-100">
      <div class="d-flex justify-content-center h-100">
    <form method="POST" action="{{route('machinesinproducts.search')}}">
      @csrf
        <div class="searchbar">
          <input class="search_input" type="text" name="name" placeholder="Search by a machine's name">
          <!-- <a href="/function/dashboardPageSearch" class="search_icon"><i class="fas fa-search"></i></a> -->
          <a href="{{route('machinesinproducts.search')}}" class="search_icon"><i class="fas fa-search"></i></a>
    </form>
        </div>
      </div>
    </div>
    </div>
    <br>
    <div class="container-fluid">

     <!-- Page Heading -->
     <h1 class="h3 mb-2 text-gray-800">PRODUCTS</h1>
          <p class="mb-4">HERE YOU SEE ALL PRODUCTS ON YOUR DATABASE. IF YOU PREFERE YOU CAN </a><a href="/section/products/create">CREATE NEW ONE</a></p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Products</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <!-- 'name', 'serial_number', 'categorie', 'situation', 'year', 'brand', 'image', 'price', 'discount', 'about' -->

                      <th>Image</th>
                      <th>Name</th>
                      <th>Category</th>
                      <th>Seling Price</th>
                      <th>Cost Price</th>
                     <th scope="col">Actions</th>

                    </tr>
                  </thead>

                  <tbody>
                    @foreach($allproducts as $product)

                    <tr>
                    <?php

                    $max = 150;
                    $str = " $product->name ";
                    $name=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


                    $max = 10;
                    $str = " $product->about ";
                    $about=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

                    ?>


                    <td>
                    <img src="/storage/{{$product->image}}" class="img-fluid img-thumbnail"
                    style="width: 100px; height:100px;"alt="Sheep">
                    </td>

                    <td>{{$name}}</td>
                    <td>{{$product-> categoryName}}</td>
                    <td>£{{$product-> Sell_Price}}</td>
                    <td>£{{$product-> Cost_Price}}</td>
                    <td>
                        <a href="/section/searches/machinesinproducts/searchIndex/{{$product->id}}" class="btn btn-success" >View Page</a>
                    </td>
                    </tr>
                @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

          <!-- Footer -->
          <footer class="sticky-footer bg-white">
            <div class="container my-auto">
              <div class="copyright text-center my-auto">
                <span>Copyright &copy; Your Website 2020</span>
              </div>
            </div>
          </footer>
          <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

      </div>
      <!-- End of Page Wrapper -->

      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
      </a>

      <!-- Logout Modal-->
      <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
          </div>
        </div>
      </div>


      <script type="text/javascript">


      </script>
      <!-- Bootstrap core JavaScript-->
      <script src="{{ asset('admlyt/vendor/jquery/jquery.min.js') }}"></script>
      <script src="{{ asset('admlyt/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>


      <!-- Core plugin JavaScript-->
      <script src="{{ asset('admlyt/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

      <!-- Custom scripts for all pages-->
      <script src="{{ asset('admlyt/js/sb-admin-2.min.js') }}"></script>

      <!-- Page level plugins -->

      <script src="{{ asset('admlyt/vendor/datatables/jquery.dataTables.min.js') }}"></script>
      <script src="{{ asset('admlyt/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>


      <!-- Page level custom scripts -->
      <script src="{{ asset('admlyt/js/demo/datatables-demo.js') }}"></script>

    </body>

    </html>
