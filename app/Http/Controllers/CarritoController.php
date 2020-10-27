<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\tabelaTeste;
use App\sales;
use App\productsSales;

class CarritoController extends Controller
{
    public function index()
    {   
        $allproducts = Product::all();
        return view('sections.carrito.index', compact('allproducts'));
    }

    public function processarCompra()
    {
        return view('sections.carrito.compra');

    }

    public function generatingInvoice(Request $request)
    {
        return json_encode($request);

    }

  
        public function generatingInvoiceAjax(Request $request)
    {   

        //isso é considerado array:
        //  $newVar = ["{nome:giovani, idade:30, sexo:masculino}, {nome:gui, idade:15, sexo:masculino},"];
        // return gettype($newVar);

        $dataArray =  $request["data"];


        if(isset($dataArray)){
        // $newDataArray =    json_decode($dataArray);
        // return gettype($newDataArray );

        // pegando os daods gerais para cadastro na tabela sales 
            $totalvalue = $request["data"][0]["totalvalue"];
            $subtotalvalue = $request["data"][0]["subtotalvalue"];
            $vat = $request["data"][0]["vat"];
            $paymentMethod = $request["data"][0]["paymentMethod"];

            $createSales = new sales();
            $createSales->sales_price = $totalvalue;
            $createSales->sales_subtotal = $subtotalvalue;
            $createSales->sales_discount =  0;
            $createSales->sales_vat = $vat;
            $createSales->methodPayment = $paymentMethod;
            $storeProductsSales = $createSales->save();
            $SalesID= $createSales->id;
        
        
        // cadastrando na tabela sales


        foreach($dataArray as $dA){
            $id = $dA["id"];
            $image = $dA["imagen"];
            $price = $dA["precio"];
            $pricewithvat = $dA["precioconVAT"];
            $name = $dA["titulo"];
            $cantidad = $dA["cantidad"];
            
            $achadoProduct = $findProduct = Product::find($id);

            if($achadoProduct)
            $IdProduct = $achadoProduct->id;
            $nameProduct = $achadoProduct->name;
            $SKU = $achadoProduct->SKU;
            $category = $achadoProduct->category;
            $brand = $achadoProduct->brand;
            $image = $achadoProduct->image;
            $Sell_Price = $achadoProduct->Sell_Price;
            $Cost_Price = $achadoProduct->Cost_Price;
            $quantity = $achadoProduct->quantity;
            $about = $achadoProduct->about;
            $machines = $achadoProduct->machines;
            
            
            if($achadoProduct){
                $prod = Product::find($id);
                $prod->quantity = $prod->quantity-=$cantidad;
                 $updateProd = $prod->save();

            if($updateProd){

                /// Estamos apenas fazendo a inserção dos produtos vendidos em si
                $createProductsSales = new productsSales();
                $createProductsSales->name = $nameProduct;
                $createProductsSales->SKU = $SKU;
                $createProductsSales->category =  $category;
                $createProductsSales->brand =   $brand;
                $createProductsSales->image = $image;
                $createProductsSales->Sell_Price = $Sell_Price;
                $createProductsSales->Cost_Price = $Cost_Price;
                $createProductsSales->quantity = $cantidad;
                $createProductsSales->about = $about;
                $createProductsSales->machines = $machines;
                $createProductsSales->sales_price = $price;
                $createProductsSales->sales_discount =  0;
                $createProductsSales->sales_vat =  ($price *0.20);
                $createProductsSales->methodPayment = $paymentMethod;
                $createProductsSales->salesId =$SalesID;
                $createProductsSales->ProductId =$IdProduct;
                $storeProductsSales = $createProductsSales->save();

            }
            else{
                return 'updateProduct == danger';
            }
        }
    }

    return $SalesID;


}

    }

    public function invoice($id)
    {   


            $salesId = $id;
             // products in this sale
            $ProductsInfos = productsSales::where('salesId', 'LIKE', "%{$salesId}%")->get();

          $salesInfos = sales::find($salesId);
           $sales_price = $salesInfos->sales_price;
           $sales_subtotal  = $salesInfos->sales_subtotal ;
           $sales_discount = $salesInfos->sales_discount;
         $sales_vat = $salesInfos->sales_vat;
           $methodPayment = $salesInfos->methodPayment;
           return view('sections.carrito.invoice', compact('salesId', 'ProductsInfos', 'salesInfos', 'sales_price', 'sales_discount',
                   'sales_vat', 'methodPayment', 'sales_subtotal'));
    }

}