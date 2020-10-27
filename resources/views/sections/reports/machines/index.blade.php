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

        <span>
              @include('sections.components.topnavbar')
        </span>


          <!-- Begin Page Content -->
          <div class="container-fluid">
          <!-- Begin Page Content -->

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-black-800"><strong style="color:black;">MACHINES REPORTS</strong><br>
              <strong style="color:#050d80;">Here you'll sell all informations about your products: prices, quantities and will be 
              <br> warned about the STOCK</strong>
              </h1>
              <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
            </div>

            <!-- Content Row -->
            <div class="row">

              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                        <a href="/section/products"> REGISTERED MACHINES </a>
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><strong style="color:green;">{{$Nmachines}}</strong></div>
                        number of machines on our database
                      </div>
                      <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        <a href="/section/machines " style="color:green"> OPEN SERVICES</a>
                        </div>
                        @foreach($seeopenworks as $NopenWorks)
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><strong style="color:blue;">{{$NopenWorks->TOTAL}}</strong></div>
                        number of services still open
                        @endforeach
                      </div>
                      <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                        <a href="/section/customers" style="color:blue"> CLOSED SERVICES</a>
                        </div>
                        <div class="row no-gutters align-items-center">
                          <div class="col-auto">
                          @foreach($NumberClosedServices as $NclosedServices)
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><strong style="color:orange;">{{$NclosedServices->TOTAL}}</strong></div
                            > Number of jobs already done
                          @endforeach
                          </div>
                          <div class="col">
                          </div>
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Pending Requests Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                        <a href="/section/quote" style="color:orange"> GENERAL BALANCE</a>
                        </div>
                        @foreach($WorkOrderTotalAmount as $totalAmount)
                        <div class="h5 mb-0 font-weight-bold"><strong style="color:green;">£{{$totalAmount->total}}</strong></div>Money earned on all services performed
                        @endforeach
                      </div>
                      <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
              </div>
              </div>
            </div>



  <!-- Page Heading -->
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Machines DataTables</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
            <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->

                <th>Serial Number</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Owner</th>
                <th scope="col">Actions</th>

            </tr>
            </thead>

            <tbody>
            @foreach($allmachines as $machine)

            <tr>
            <?php

            $max = 26;
            $str = " $machine->customerName";
            $owner=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);


            $max = 26;
            $str = " $machine->brand";
            $brand=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

            $max = 26;
            $str = " $machine->serial_number";
            $serial_number=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

            $max = 26;
            $str = " $machine->model";
            $model=  substr_replace($str, (strlen($str) > $max ? '...' : ''), $max);

            ?>

            <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->

            <td>{{$serial_number}}</td>
            <td>{{$brand}}</td>
            <td>{{$model}}</td>
            <td>{{$owner}}</td>
            
            <td>
                <a href="/section/machines/edit/{{$machine->id}}" class="btn btn-primary btn-group">Edit</a>
                <a href="/section/machines/destroy/{{$machine->id}}"  class="btn btn-danger btn-group"
                onclick="return confirm('Are you sure that you want delete this Machine?');">
                        Remove</a>
            </td>
            </tr>
        @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>



      <!-- Content Row -->
      <div class="row">

  <!-- Content Column -->
  <div class="col-lg-6 mb-4">

    <!-- Project Card Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><h5 style = "color:orange"><strong>NUMBER OF PRODUCTS USED IN OUR MACHINES</strong></h5 style="color:orange;"></h6>
      </div>
      <div class="card-body">
      @foreach($NprodsInMachines as $Nprods)
        <div class="h5 mb-0 font-weight-bold text-gray-800"> We have <strong style="color:blue;">{{$Nprods->total}}</strong> product BEIGN USED IN OUR MACHINES
        </div>
      @endforeach
        </div>
      </div>
    </div>

  <div class="col-lg-6 mb-4">

    <!-- Illustrations -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">ABOUT THE DASHBOARD</h6>
      </div>
      <div class="card-body">
        <div class="text-center">
        </div>
        <p style="color:black;x">Here, you will see all about your Machines. Open and closed services, money earned in all services</p>
      </div>
    </div>
    </div>
    
    <div class="row">
    <div class="col-lg-6 mb-4">
    <!-- Approach -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-success">Customers with more Machines</h6>
      </div>
      <div class="card-body">
         GUILHERME 3 MAQUINAS
         GIOVANI 2 MAQUINAS
      </div>
    </div>
    </div>
    <div class="col-lg-6 mb-4">
    <!-- Approach -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-danger">Customer</h6>
      </div>
      <div class="card-body">
          <h5>
          <p style="color:black;">Which product gives you the <strong style="color:red">worst return</strong> regarding the <strong style="color:green">Sell price</strong> and the <strong style="color:red">Cost price</strong>. This will help you to know which products you can <strong style="color:orange">earn more money</strong> and which one <strong style="color:red;">doesn't worth sell</strong><br></p></h5>
        
      </div>
    </div>
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

  <!-- end of container fluid  -->
  </div>



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
