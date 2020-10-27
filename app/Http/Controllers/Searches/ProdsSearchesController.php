<?php

namespace App\Http\Controllers\Searches;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
USE App\ShowMachinesByProducts;
use App\Machine;

class ProdsSearchesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $productsSearch = Product::paginate(10);
        return view ('sections.searches.products.index', compact('productsSearch'));
    }
    public function edit($id)
    {
        $allproducts = Product::find($id);
        $img = $allproducts->image;

         $machinesByProducts = ShowMachinesByProducts::where('ProductId', 'LIKE', "%{$id}%")->get();

         $MoreInfos = ShowMachinesByProducts::where('ProductId', 'LIKE', "%{$id}%")->first();

        return view('sections.searches.products.edit', compact('allproducts','machinesByProducts', 'img'));
    }

    public function search(Request $request)
    {
        // return json_encode($request->searchOption);
        
        //taking the informations from the request
        $dataForm = $request->except('_token');
        $nameText = $request->nameText;
        $searchOption = $request->searchOption;

        if($nameText == "" && $searchOption == ""){
                $nameText = 0 ;
                $searchOption = 0;
                return view('sections.searches.index', compact('nameText','searchOption', 'dataForm'));
        }
        else{
            // Will check which database we'll search in 
            
            if(($dataForm['searchOption'] == "machines")){
                $machinesSearch =  Machine::where(function ($query) use 
                ($dataForm, $nameText, $searchOption) {  
                if(isset($dataForm['nameText']))  // vericamos se este valor existe (se esta inserido)
                $machinesSearch = $query->where('model', 'LIKE', "%{$nameText}%");      
              })->paginate(100);
              return json_encode($machinesSearch);
            }  
            
            if(($dataForm['searchOption'] == "products")){
                $productsSearch =  Product::where(function ($query) use 
                ($dataForm, $nameText, $searchOption) {  

                if(isset($dataForm['nameText']))  // vericamos se este valor existe (se esta inserido)
                $productsSearch = $query->where('name', 'LIKE', "%{$nameText}%");      
              })->paginate(100);
              return json_encode($productsSearch);
            }  


            if(($dataForm['searchOption'] == "general")){
                $nameText = 0 ;
                $searchOption = 0;
                return view('sections.searches.index', compact('nameText','searchOption'));
            }  


            // if(isset($dataForm['searchOption']))
            // $musicaspost = $query->where('searchOption', 'LIKE', "%{$categoria}%");

        }
    }
}
