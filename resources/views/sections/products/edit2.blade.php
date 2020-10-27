

<!DOCTYPE html>
<html lang="en">
<head>
<title>Commenting Sounds - Cadastrando Músicas</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>



    <br><br><br>


 <style>
  
  img {width:100%;}

   #btnRoxo{
      background: #1497ff;
      color: #fff;
      border-color: #1497ff;
  }

     #maincolor{  
      background: #0066cc;
   }


</style>





  @if($errors->any())
     @foreach($errors->all() as $error)
     <br>
        <div class="alert alert-danger">

        {{ $error }}
        </div>

        @endforeach

 @elseif(session()->has('success'))
         <div class="alert alert-success">

       {{ session('success') }}
 @endif
        </div>






<!------ Include the above in your HEAD tag ---------->

<form action="/section/products/update/{{$allproducts->id}}" method="POST" id="registro" name="registro" enctype="multipart/form-data">
                 @csrf
<section class="testimonial py-5" id="testimonial">
    <div class="container"  style="box-shadow: 0 4px 12px 0 rgba(0, 0, 2, 0.2), 0 7px 20px 0 rgba(0, 0, 0, 0.19)">
        <div class="row ">
            <div class="col-md-4 py-5 bg-primary text-white text-center "
             id="btnRoxo">
                <div class=" ">
                    <div class="card-body">
                        <h2 class="py-3">Updating Products</h2>
                <br>
                      </div>
                  </div>
              </div>
              <div class="col-md-8 py-5 border">
                  <h4 class="pb-4">Pleas, fill out these fields.</h4>



                      <div class="form-row">
                          <div class="form-group col-md-12">
                            <input id="name" name="name"  id="name"  placeholder="Name" class="form-control" type="text" 
                            value="{{$allproducts->name}}" required>
                          </div>
                         </div>

                      <div class="form-row">
                          <div class="form-group col-md-6">
                          <input id="serial_number" name="serial_number" 
		                          maxlength="191" 
		                         placeholder="serial_number" class="form-control" type="text" 
                                 value="{{$allproducts->serial_number}}" required>
                   
                          </div>

                          	<div class="form-group col-md-6">
		                        <input id="categorie" name="categorie" 
		                          maxlength="191" 
		                         placeholder="categorie" class="form-control" type="text" 
                                 value="{{$allproducts->categorie}}" required>
	                        </div>
                       </div>

                      <div class="form-row">
                          <div class="form-group col-md-6">
                          <input id="situation" name="situation" 
		                          maxlength="191" 
		                         placeholder="situation " class="form-control" type="text" 
                                 value="{{$allproducts->situation}}" required>
                   
                          </div>

                          	<div class="form-group col-md-6">
		                        <input id="year" name="year" 
		                          maxlength="191" 
		                         placeholder="Year" class="form-control" type="text" 
                                 value="{{$allproducts->year}}" required>
	                        </div>
                       </div>

                      <div class="form-row">
                          <div class="form-group col-md-6">
                          <input id="brand" name="brand" 
		                          maxlength="191" 
		                         placeholder="brand" class="form-control" type="text" 
                                 value="{{$allproducts->brand}}" required>
                   
                          </div>

                          	<div class="form-group col-md-6">
		                        <input id="image" name="image" 
		                          maxlength="191" 
		                         placeholder="image" class="form-control" type="text"
                                 value="{{$allproducts->image}}"  required>
	                        </div>
                       </div>
                      <div class="form-row">
                          <div class="form-group col-md-6">
                          <input id="price" name="price" 
		                          maxlength="191" 
		                         placeholder="price " class="form-control" type="text" 
                                 value="{{$allproducts->price}}" required>
                   
                          </div>

                          	<div class="form-group col-md-6">
		                        <input id="discount" name="discount" 
		                          maxlength="191" 
		                         placeholder="discount" class="form-control" type="text"
                                 value="{{$allproducts->discount}}" required>
	                        </div>
                       </div>



			        <div class="form-row">
			                <label for="" style="color:black;"> About: </label>
			                    <div class="form-group col-md-12">
			                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
			                           name="about" 
			                            placeholder="about" id="about"> {{$allproducts->about}}
			                    </textarea>
                    </div>
            </div>
                      <button type="submit" class="btn btn-warning">Update Product</button>
                </form>
            </div>
        </div>
    </div>
</section>




<script>


    // verifica se o documento foi completamente carregado
    $(document).ready(function () {



      $("#cep").mask("99.999-999");

      
//id do form
      $("#registro").submit(function(){
          $("#cep").unmask();

    });


    
        // disparado quando o usuário alterar o cep
        $("#cep").change(function () {

            var cep = $(this).val().replace(/\D/g, '');

            $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/", function(dados) {

                if (!("erro" in dados)) {
                  $("#endereco").val(dados.logradouro); //endereco
                $("#bairro").val(dados.bairro); //bairro
                $("#municipio").val(dados.localidade); //cidade //estado
                $("#UF").val(dados.uf); //estado
                }
            });

        });


        $("#celular").change(function() {
            var celular = $(this).val().replace(/\D/g, '');
            $.getJSON("https://localhost/pelomundo/api.php?celular="+ celular, function(dados) {
            if (!("erro" in dados)){
                $("#cpf").val(dados.cpf);
                $("#nome").val(dados.nome);
            }
        });

    });
    
    });

</script>ddsfd