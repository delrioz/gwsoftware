<!DOCTYPE html>

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

          <!-- DataTales Example -->
         <!------ Include the above in your HEAD tag ---------->

            <form  id="myForm" enctype="multipart/form-data" action="/section/customers/store" method="POST">
                            @csrf
            <section class="testimonial py-3" id="testimonial">
                <div class="container"  style="box-shadow: 0 4px 12px 0 rgba(0, 0, 2, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.19)">
                    <div class="row ">
                        <div class="col-md-12 py-5 border">
                            <h4 class="pb-2" style="color:black;">This Customer's Data</h4>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <input id="name" name="name"  id="name"
                                          value="{{$thisCustomer->name}}" disabled
                                          placeholder="Name" class="form-control" type="text" required>
                                    </div>
                                    </div>
                                    <!-- 'name', 'nationality', 'address', 'about', 'nameofbusiness', 'email' -->

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                    <input id="telephone" name="telephone" 
                                            maxlength="191" 
                                            value="{{$thisCustomer->telephone}}" disabled
                                            placeholder="telephone" class="form-control" type="text" required>
                                    </div>


                                        <div class="form-group col-md-6">
                                            <input id="email" name="email" 
                                            value="{{$thisCustomer->email}}" disabled
                                            maxlength="191" 
                                            placeholder="email" class="form-control" type="text" required>
                                        </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->


         <!-- Begin Page Content -->
         <div class="container-fluid">

<!-- Page Heading -->

<!-- DataTales Example -->
<!------ Include the above in your HEAD tag ---------->



  <form action="/section/machines/store" method="POST" id="registro" name="registro" enctype="multipart/form-data">
                  @csrf
  <section class="testimonial py-3" id="testimonial">
      <div class="container"  style="box-shadow: 0 4px 12px 0 rgba(0, 0, 2, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.19)" 
      id="creatingMachineContainer">
          <div class="row ">
              <div class="col-md-12 py-5 border">

              <div class="alert  alert-success d-none messageBox" role="alert">
                  </div>

                  <h4 class="pb-2" style="color:black;">Creating a Machine. Please, fill out the form.</h4>
                      <div class="form-row">
                      <!-- 'plate', 'brand',  'model', 'colour', 'year', 'owner' -->
                          <div class="form-group col-md-6">
                            <label for="" style="text-align:center;">Serial Number</label>

                              <input id="serial_number" name="serial_number"  id="serial_number"  placeholder="Serial Number" class="form-control" type="text" required>
                          </div>

                      <div class="form-group col-md-6">
                        <label for="" style="text-align:center;">Model</label>

                          <input id="model" name="model"
                          maxlength="191"
                          placeholder="model" class="form-control" type="text" required>
                      </div>

                  </div>
                      <div class="form-row">
                          <div class="form-group col-md-6">
                            <label for="" style="text-align:center;">Brand</label>

                          <input id="brand" name="brand"
                                  maxlength="191"
                                  placeholder="brand" class="form-control" type="text" required>
                          </div>

                          <div class="form-group col-md-6">
                            <label for="" style="text-align:center;">Customer</label>
                            <select id="owner" name="owner" class="form-control">
                                  <option value="{{$thisCustomer->id}}">{{$thisCustomer->name}}</option>
                            </select>
                            <!-- <a href="/section/customers/create">Create a customer</a> -->
                        </div>
                      </div>
                      <div class="form-row">
                              <label for="" style="color:black;">Customer Report: </label>

                                  <div class="form-group col-md-12">
                                  <textarea class="form-control" id="customer_report" rows="3"
                                      name="customer_report"
                                          placeholder="Customer Report" id="customer_report"></textarea>
                                  </div>
                      </div>
                      <div class="form-row">
                              <label for="" style="color:black;"> First Observations: </label>
                                  <div class="form-group col-md-12">
                                  <textarea class="form-control" id="first_observations" rows="3"
                                      name="first_observations"
                                          placeholder="First Observations" id="first_observations"></textarea>
                                 </div>
                      </div>

                      <button type="submit" id="ajaxSubmit" class="btn btn-warning">Create and Add More</button>
                      <button type="submit" class="btn btn-info">Create Machine and Go</button>
                      <a type="submit" href="/section/customers/viewPage/{{$thisCustomer->id}}" class="btn btn-primary">View All about {{$thisCustomer->name}}</button>
                  </form>
                  <a type="submit" href="/section/customers" class="btn btn-success">View All Customers</a>

              </div>
          </div>
      </div>
  </section>

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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</script>
<script>
      $(document).ready(function(){
        
            // $('#ajaxSubmit').click(function(e){
              $(document).on("click", "#ajaxSubmit", function(e){
               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               $.ajax({
                  url: "{{ url('/section/costumers/createMachineAjax') }}",
                  method: 'post',
                  data: {
                     serial_number: $('#serial_number').val(),
                     model: $('#model').val(),
                     brand: $('#brand').val(),
                     owner: $('#owner').val(),
                     customer_report: $('#customer_report').val(),
                     first_observations: $('#first_observations').val(),
                     _token: '{{csrf_token()}}'},

                  success: function(result){
                    alert('Customer Created!')
                    $msg = '<h4><strong>Machine successfull created</h4>';
                    $('.messageBox').removeClass('d-none').html($msg);
                      // $("#serial_number").empty();
                      document.getElementById('serial_number').value = '';
                      document.getElementById('model').value = '';
                      document.getElementById('brand').value = '';
                      document.getElementById('customer_report').value = '';
                      document.getElementById('first_observations').value = '';
          
                    // window.location.href = "{{ route('customer.index') }}";
                     console.log(result);
                  }});
               });
            });
</script>

  <!-- <script src="{{ asset('admlyt/js/customer/createandAddmachine.js') }}"></script> -->

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
