<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WorkOrder;
use App\Quote;
use App\Customer;
use App\Machine;
use App\allworkorderinformations;
use App\products_machines_workorders;
use App\Product;
use App\products_machines_quotes;
use App\productsmachinesworkordersallinfos;
use DB;

class WorkOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function OpenWorkOrder(Request $request, $id)
    {
        
        // recupeando os dados dos quotes anteriores
        $ThisQuote = Quote::find($id);
        $ThisQuoteId = $ThisQuote->id;
        $title = $ThisQuote->title;
        $customer_report = $ThisQuote->customer_report;
        $first_observations = $ThisQuote->first_observations;
        $last_observations = $ThisQuote->last_observations;
        $customer = $ThisQuote->customer;
        $machine = $ThisQuote->machine;
        $status = $ThisQuote->status;
        $typeofpayment =  "none";


         $datas = ['title' => $title,
                    'customer_report' => $customer_report,
                    'first_observations' => $first_observations,
                    'last_observations' => $last_observations,
                    'customer' => $customer,
                    'machine' => $machine,
                    'status' => $status,
                    'typeofpayment'  => $typeofpayment,
                    'quoteReference'  => $ThisQuoteId
                ];

        $OpeningWorkOrder = WorkOrder::create($datas);
        $idWorkOrder = $OpeningWorkOrder->id;

        // QUOTE STATUS = 1 MEANS QUOTE  ALREADY IS WORK ORDER
        $ThisQuote->status = "1";
        $updatQuote = $ThisQuote->save();


        if($OpeningWorkOrder){
           // pegando os dados da tabela products_machines_quotes para inseri-los na products_machines_workorders
              $productmachinesquotes = products_machines_quotes::where('quoteReference', 'LIKE', $id)->first();

               if($productmachinesquotes){
                    $machine_id = $productmachinesquotes->machine_id;
                    $product_id = $productmachinesquotes->product_id;
                    $quoteReference = $productmachinesquotes->quoteReference;
                        $datas2 = ['machine_id' => $machine_id,
                        'product_id' => $product_id,
                        'workOrderReference' => $idWorkOrder,
                        'quoteReference' => $quoteReference
                    ];

                    $OpeningWorkOrder = products_machines_workorders::create($datas2);
               }
                
            
              
            return redirect()
                        ->route('workOrder.index')
                        ->with('success',  'The Work Order was successful created !' );
            }

            else
            {
                return redirect()
                            ->back()
                            ->with('error', $response['message']);
            }

        return redirect()->route('workOrder.index');
    }


    public function index()
    {
        $allworkOrders = allworkorderinformations::all();

        return view('sections.workOrder.index', compact('allworkOrders'));    
    }

    public function create()
    {
        $allcustomers = Customer::all();
        $allmachines = Machine::all();
        $allproducts = Product::all();


        return view('sections.workOrder.create', compact('allcustomers', 'allmachines', 'allproducts'));
    }

    public function store(Request $request)
    {
        $machine_id =  $request->machine;
        $allmachines = Machine::find($machine_id);
        $customer_report = $allmachines->customer_report;


        // 'title', 'customer_report', 'first_observations', 'last_observations', 'customer', 'machine', 'status', 'typeofpayment'

        $createWorkOrder = new WorkOrder();
        $createWorkOrder->title = $request->input('title');
        $createWorkOrder->customer_report = $allmachines->customer_report;
        $createWorkOrder->first_observations = $allmachines->first_observations;
        $createWorkOrder->last_observations = $request->input('last_observations');
        $createWorkOrder->customer = $allmachines->owner;
        $createWorkOrder->machine = $request->input('machine');
        $createWorkOrder->status = $request->input('status');
        $createWorkOrder->quoteReference = 0;
        $updateProd = $createWorkOrder->save();


        if($updateProd){
            // machines selected
            $Productsoptions =  $request->Productsoptions;
    
            $machineId = $createWorkOrder->machine;
            // $productId = $createQuote->product;
            $workOrderReference = $createWorkOrder->id;
            $quoteReference = 0;
            $created_at = $createWorkOrder->created_at;
            $updated_at = $createWorkOrder->updated_at;
    
            if($Productsoptions){
                // verificando se algum produto foi selecionado 
                foreach ($Productsoptions as $key => $ProdObj)
                {
                $vals = $request->Productsoptions;
                $product_machine_inster = DB::insert('insert into products_machines_workorders (machine_id, product_id, workOrderReference, quoteReference, created_at, updated_at) values (?, ?, ?, ?, ?, ?)', [$machineId, $ProdObj, $workOrderReference, $quoteReference, $created_at, $updated_at]);
               }
            }

        return redirect()->route('workOrder.index');
    }
}

    public function edit($id)
    {
        $allworkOrders = allworkorderinformations::find($id);
       
        $allcustomers = Customer::all();
        $allmachines = Machine::all();
        $allproducts = Product::all();
        
        
        $opcoesMarcadas = array();
        $todosProdutos = array();
        $lista = DB::table('products')->get();
        $findProducts = products_machines_workorders::where('workOrderReference', 'LIKE', "%{$id}%")->get(); 

        // retorna tudo da nossa view que pega intera;'ao entre tabelas acha nome e etc, passando o id da maquina atual
        $outrasop = productsmachinesworkordersallinfos::where('workOrderReference', 'LIKE', $id)->get();
        


        // todos os produtos referenciados à essa maquina 
        foreach($findProducts as $item){
            $opcoesMarcadas[] =  $item->product_id;
        }
        // todos produtos existentes na tabela products
        foreach($lista as $item){
            $todosProdutos[] =  $item->id;
        }   

        // array com as respostas diferentes entre ambos outros arrays
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

     
        
        return view('sections.workOrder.edit', compact('allworkOrders','allcustomers', 'allmachines', 'allproducts', 'statusNulo', 'respostaProducts', 'outrasop'));
    }


    public function destroy($id)
    {
        $deleteworkOrder = WorkOrder::find($id)->delete();
        {$deleteproducts = products_machines_workorders::where('workOrderReference', 'LIKE', "%{$id}%")->delete();}

        if($deleteworkOrder){
            return redirect()
                        ->route('workOrder.index')
                        ->with('success',  'The Work Order was successful removed !' );
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

        // 'name', 'customer_report', 'first_observations', 'previous_observations', 'customer', 'vehicle', 'status', 'typeofpayment'

            $workOrder = WorkOrder::find($id);
            if(isset($workOrder)){
            $workOrder->title = $request->input('title');
            $workOrder->customer_report = $request->input('customer_report');
            $workOrder->first_observations = $request->input('first_observations');
            $workOrder->last_observations = $request->input('last_observations');
            $workOrder->customer = $request->input('customer');
            $workOrder->machine = $request->input('machine');
            $workOrder->status = "1";
            $workOrder->typeofpayment = "none";
            $updateworkOrder = $workOrder->save();

            if($updateworkOrder){

                $workOrderReference = $id;
                $quoteReference = 0;
                $Productsoptions =  $request->Productsoptions;
                $MachineId = $workOrder->machine;
                $created_at = $workOrder->created_at;
                $updated_at = $workOrder->updated_at;
    
                $findDatasonRelationTable = products_machines_workorders::where('workOrderReference', 'LIKE', "%{$id}%")->first();
    
                if(!isset($Productsoptions)){
                    //se nenhum producto for selecionada, seja removida ou nao 
                    if($findDatasonRelationTable){$deleteproducts = products_machines_workorders::where('workOrderReference', 'LIKE', "%{$id}%")->delete();}
                    
                    return redirect()
                        ->route('workOrder.index')
                        ->with('success',  'The product was successfull created!' );
                }
                
    
                if($findDatasonRelationTable == null || $findDatasonRelationTable == ""){
                    // create
                    foreach ($Productsoptions as $key => $prodObj){  
                    $vals = $request->Productsoptions;
                    $product_machine = DB::insert('insert into products_machines_workorders (workOrderReference, quoteReference, machine_id, product_id, created_at, updated_at) values (?, ?, ?, ?, ?, ?)', [$workOrderReference, $quoteReference, $MachineId, $prodObj, $created_at, $updated_at]);
                    }
                }
    
                else{
                    //update  ->delete and create 
                    $deleteproducts = products_machines_workorders::where('workOrderReference', 'LIKE', "%{$id}%")->delete();
                    if($deleteproducts){
                        foreach ($Productsoptions as $key => $prodObj){  
                            $vals = $request->Machinesoptions;
                            $product_machine = DB::insert('insert into products_machines_workorders (workOrderReference, quoteReference, machine_id, product_id, created_at, updated_at) values (?, ?, ?, ?, ?, ?)', [$workOrderReference, $quoteReference, $MachineId, $prodObj, $created_at, $updated_at]);
                        }
                 }
             }

            return redirect()
                        ->route('workOrder.index')
                        ->with('success',  'The Work Order was successful update' );
            }


            else
            {
                return redirect()
                            ->back()
                            ->with('error', $response['message']);
             }
        }
    }
}