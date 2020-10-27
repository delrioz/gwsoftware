<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Quote;
use App\Customer;
use App\Machine;
use App\allquotesinformations;
use App\products_machines_workorders;
use App\Product;
use App\products_machines_quotes;
use App\productsclientsmachinesallinfos;
use DB;

class QuoteController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // status 0 means active

        $allQuotes = allquotesinformations::where('status' , 'LIKE', '0')
        ->get();


        return view('sections.quote.index', compact('allQuotes'));
    }

    public function create()
    {
        $allcustomers = Customer::all();
        $allmachines = Machine::all();
        $allproducts = Product::all();

        return view('sections.quote.create', compact('allcustomers', 'allmachines', 'allproducts'));

    }

    public function store(Request $request)
    {
        // return $request;
        $machine_id =  $request->machine;
        $allmachines = Machine::find($machine_id);
        $customer_report = $allmachines->customer_report;


        // 'title', 'customer_report', 'first_observations', 'last_observations', 'customer', 'machine', 'status', 'typeofpayment'

        $createQuote = new Quote();
        $createQuote->title = $request->input('title');
        $createQuote->customer_report = $allmachines->customer_report;
        $createQuote->first_observations = $allmachines->first_observations;
        $createQuote->last_observations = $request->input('last_observations');
        $createQuote->customer = $allmachines->owner;
        $createQuote->machine = $request->input('machine');
        $createQuote->status = $request->input('status');
        $updateProd = $createQuote->save();



        if($updateProd){
        // machines selected
        $Productsoptions =  $request->Productsoptions;
        $machineId = $createQuote->machine;
        // $productId = $createQuote->product;
        $quoteReference = $createQuote->id;
        $created_at = $createQuote->created_at;
        $updated_at = $createQuote->updated_at;

        if($Productsoptions){
            // verificando se tem algum produto selecionado
            foreach ($Productsoptions as $key => $ProdObj)
            {
            $vals = $request->Productsoptions;
            $product_machine_inster = DB::insert('insert into products_machines_quotes (machine_id, product_id, quoteReference, created_at, updated_at) values (?, ?, ?, ?, ?)', [$machineId, $ProdObj, $quoteReference, $created_at, $updated_at]);
           }
        }
    }

    else{
        return redirect()
        ->back()
        ->with('error', $response['message']);

    }
        return redirect()->route('quote.index');

    }

    public function edit($id)
    {
        $allQuotes = allquotesinformations::find($id);
        // name of the customer
        $name = $allQuotes->customerId;

        // name of the machine

        $allcustomers = Customer::all();
        $allmachines = Machine::all();
        $allproducts = Product::all();

        // all products
        $lista = DB::table('products')->get();
        // this actual quote
        $findProducts = products_machines_quotes::where('quoteReference', 'LIKE', "%{$id}%")->get(); 

        // retorna tudo da nossa view que pega intera;'ao entre tabelas acha nome e etc, passando o id do quote atual
        $outrasop = productsclientsmachinesallinfos::where('quoteReference', 'LIKE', $id)->get();

        $opcoesMarcadas = array();

         // todos os produtos referenciados à essa quote 
         foreach($findProducts as $item){
            $opcoesMarcadas[] =  $item->product_id;
        }
        // todos produtos existentes na tabela products
        foreach($lista as $item){
            $todosProdutos[] =  $item->id;
        }   

        // array  de resposta que ira pegar quais produtos sao diferentes entre o que voce tem na quote e os que ja existem na tabela products
        $array3 = array();
        foreach($todosProdutos as $produtos){
            // se o valor NAO ESTIVER NO ARRAY isto é, os valores que nao forem iguais, que se repetirem em ambas variaveis de arrays
            if(!in_array($produtos, $opcoesMarcadas)){
                $array3[] =  $produtos;
            }
        }

        $max2 = sizeof($array3);
        if($max2 != 0)
        {
            for($i =0; $i < $max2; $i++){
                // return $uniao[$i];
                $allproducts2 = Product::find($array3[$i]);
                $respostaProducts[] =  $allproducts2;
                $statusNulo = false;
            }
        }
        else{
            $respostaProducts =0;
            $statusNulo = true;
        }



        return view('sections.quote.edit', compact('allQuotes', 'allcustomers', 'allmachines','name', 'allproducts', 'statusNulo', 'respostaProducts', 'outrasop' ));
    }


    public function destroy($id)
    {
        $deletequote = Quote::find($id)->delete();
       {$deleteproducts = products_machines_quotes::where('quoteReference', 'LIKE', "%{$id}%")->delete();}
       
        if($deletequote){
            return redirect()
                        ->route('quote.index')
                        ->with('success',  'The Quote was successful removed !' );
            }


            else
            {
                return redirect()
                            ->back()
                            ->with('error', $response['message']);

            }

    }



    public function update(Request $request, $id)
    {


        // 'title', 'customer_report', 'first_observations', 'last_observations', 'customer', 'machine', 'status', 'typeofpayment'

            $quote = Quote::find($id);
            if(isset($quote)){
            $quote->title = $request->input('title');
            $quote->customer_report = $request->input('customer_report');
            $quote->first_observations = $request->input('first_observations');
            $quote->last_observations = $request->input('last_observations');
            $quote->customer = $request->input('customer');
            $quote->machine = $request->input('machine');
            $quote->status = 0;
            $updatequote = $quote->save();

            if($updatequote){

                $quoteReference = $id;
                $Productsoptions =  $request->Productsoptions;
                $MachineId = $quote->machine;
                $created_at = $quote->created_at;
                $updated_at = $quote->updated_at;
    
                 $findDatasonRelationTable = products_machines_quotes::where('quoteReference', 'LIKE', "%{$id}%")->first();
    
                if(!isset($Productsoptions)){
                    //se nenhum producto for selecionada, seja removida ou nao 
                    if($findDatasonRelationTable){$deleteproducts = products_machines_quotes::where('quoteReference', 'LIKE', "%{$id}%")->delete();}
                    
                    return redirect()
                        ->route('quote.index')
                        ->with('success',  'The product was successfull created!' );
                }
                
    
                if($findDatasonRelationTable == null || $findDatasonRelationTable == ""){
                    // create
                    foreach ($Productsoptions as $key => $prodObj){  
                    $vals = $request->Productsoptions;
                    $product_machine = DB::insert('insert into products_machines_quotes (quoteReference, machine_id, product_id, created_at, updated_at) values (?, ?, ?, ?, ?)', [$quoteReference, $MachineId, $prodObj, $created_at, $updated_at]);
                    }
                }
    
                else{
                    //update  ->delete and create 
                    $deleteproducts = products_machines_quotes::where('quoteReference', 'LIKE', "%{$id}%")->delete();
                    if($deleteproducts){
                        foreach ($Productsoptions as $key => $prodObj){  
                            $vals = $request->Machinesoptions;
                            $product_machine = DB::insert('insert into products_machines_quotes (quoteReference, machine_id, product_id, created_at, updated_at) values (?, ?, ?, ?, ?)', [$quoteReference, $MachineId, $prodObj, $created_at, $updated_at]);
                        }
                 }
             }

            return redirect()
                        ->route('quote.index')
                        ->with('success',  'The Quote was successful update' );
            }


            else
            {
                return redirect()
                            ->back()
                            ->with('error', $response['message']);
             }
        }
    }


    public function quotesAlreadyDone()
    {

        $allQuotes = allquotesinformations::where('status' , 'LIKE', '1')
        ->get();


        return view('sections.quote.quotesAlreadyDone.index', compact('allQuotes'));
    }

    public function ViewquotesAlreadyDone($id)
    {

        $allQuotes = Quote::find($id);
        // name of the customer
        $name = $allQuotes->customer;

        // name of the machine
        $machine = $allQuotes->machine;

        $allcustomers = Customer::all();
        $allmachines = Machine::all();

        return view('sections.quote.quotesAlreadyDone.view', compact('allQuotes', 'allcustomers', 'allmachines', 'name', 'machine'));

    }
}
