<?php

namespace App\Http\Controllers\Searches;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Machine;
use App\ShowProductsByMachines;
use App\Product;
use App\machinesallinfos;
use App\customer;

class MachinesSearchesController extends Controller
{
 
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $machinesSearch = Machine::paginate(10);
        return view ('sections.searches.machines.index', compact('machinesSearch'));
    }
    public function edit($id)
    {
        
        $allmachines = machinesallinfos::find($id);

        $ownerId = $allmachines->owner;
        
        $nameOwner = $allmachines->customerName;
  
  
        $ProductsByMachines = ShowProductsByMachines::where('machineIdinMachine', 'LIKE', "%{$id}%")->get();
  
        $MoreInfos = ShowProductsByMachines::where('machineIdinMachine', 'LIKE', "%{$id}%")->first();
  
        // return view('sections.machines.view', compact('allmachines','ProductsByMachines', 'nameOwner'));

        return view('sections.searches.machines.edit', compact('allmachines','ProductsByMachines', 'nameOwner'));
    }

    public function search(Request $request)
    {
          //taking the informations from the request
          $dataForm = $request->except('_token');
          $nameText = $request->nameText;
          $searchOption = $request->searchOption;
  
          if($nameText == "" && $searchOption == ""){
                  $nameText = "" ;
                  $searchOption = "";
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
                return view('sections.searches.machines.index', compact('nameText','searchOption', 'machinesSearch', 'dataForm'));
              }  
              
              if(($dataForm['searchOption'] == "products")){
                  $productsSearch =  Product::where(function ($query) use 
                  ($dataForm, $nameText, $searchOption) {  
  
                  if(isset($dataForm['nameText']))  // vericamos se este valor existe (se esta inserido)
                  $productsSearch = $query->where('name', 'LIKE', "%{$nameText}%");      
                })->paginate(100);
                return view('sections.searches.products.index', compact('nameText','searchOption', 'productsSearch', 'dataForm'));
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

    public function Ajaxsearch(Request $request)
    {
        //taking the informations from the request
        $dataForm = $request->except('_token');
        $nameText = $request->nameText;
        $searchOption = $request->searchOption;

        if($nameText == "" && $searchOption == ""){
                $nameText = "" ;
                $searchOption = "";
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