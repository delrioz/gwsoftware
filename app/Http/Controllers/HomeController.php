<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Customer;
use App\WorkOrder;
use App\Machine;
use App\Quote;
use App\QuoteStatus0;
use DB;

class HomeController extends Controller 
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function welcome()
     {
         $searchProd = Product::select(DB::raw('COUNT(*) AS total'))
         ->first();
         $Nprod = $searchProd-> total;
            

         $searchWorkOrder = WorkOrder::select(DB::raw('COUNT(*) AS total'))
         ->first();
         $NworkOrder = $searchWorkOrder-> total;

          $searchQuote = QuoteStatus0::select(DB::raw('COUNT(*) AS total '))
         ->first();
         $Nquote = $searchQuote-> total;


         $Nmachine = Machine::select(DB::raw('COUNT(*) AS total'))
         ->first();
         $Nmachine = $Nmachine-> total;


         
         $searchCustomer = Customer::select(DB::raw('COUNT(*) AS total'))
         ->first();
         $Ncustomer = $searchCustomer-> total;

        return view('welcome', compact('Nprod', 'NworkOrder', 'Nmachine', 'Ncustomer', 'Nquote'));

     }

    public function index()
    {
        $searchProd = Product::select(DB::raw('COUNT(*) AS total'))
        ->first();
        $Nprod = $searchProd-> total;
           

        $searchWorkOrder = WorkOrder::select(DB::raw('COUNT(*) AS total'))
        ->first();
        $NworkOrder = $searchWorkOrder-> total;

        $Nmachine = Machine::select(DB::raw('COUNT(*) AS total'))
        ->first();
        $Nmachine = $Nmachine-> total;


        
        $searchCustomer = Customer::select(DB::raw('COUNT(*) AS total'))
        ->first();
        $Ncustomer = $searchCustomer-> total;

       return view('welcome', compact('Nprod', 'NworkOrder', 'Nmachine', 'Ncustomer'));
    }

    public function testecombobox()
    {
        return view ('teste');
    }

}
