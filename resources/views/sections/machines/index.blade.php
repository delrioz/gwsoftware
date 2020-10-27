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

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">MACHINES</h1>
          <p class="mb-4">HERE YOU SEE ALL MACHINES ON YOUR DATABASE. IF YOU PREFERE YOU CAN </a><a href="/section/machines/create">CREATE NEW ONE</a></p>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Machines</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->

                      <th>Serial Number</th>
                      <th>Model</th>
                      <th>Brand</th>
                      <th>Owner</th>
                     <th scope="col">Actions</th>

                    </tr>
                  </thead>

                  <tbody>
                    @foreach($allmachineswithowner as $machine)

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
                    <td>{{$model}}</td>
                    <td>{{$brand}}</td>
                    <td>{{$owner}}</td>

                    <td>
                        <a href="/section/machines/view/{{ $machine->id }}" class="btn btn-primary" style="background-color:#050d80">View</a>
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
