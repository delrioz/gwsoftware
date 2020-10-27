<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WorkOrder;
use App\Customer;
use App\Machine;
use App\viewProductsinMachines;
use DB;
use App\ShowMachinesByProducts;
use App\ShowProductsByMachines;
use App\allworkorderinformations;
use App\workorder_payments;

class PaymentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function processing($id)
    {


        $allworkOrders = allworkorderinformations::find($id);
  

        // $machineId = Machine::find($id);
        // $ownerId = $machineId->owner;
        // $machineswithowner = machineswithowner::where('idCustomer', 'LIKE', "%{$ownerId}%")->first();
        // $nameOwner = $machineswithowner->nameCustomer;

        $allcustomers = Customer::all();
        $allmachines = Machine::all();
        return view('sections.payments.processing', compact('allworkOrders','allcustomers', 'allmachines','id'));

    }

    public function confirmPayment(Request $request)
    {   

        //  FAZENDO O UPDATE NO STATUS DA WORK ORDER, ATUALIZANDO TAMBEM OS OUTROS VALORES E REALIZANDO A INSERÇÃO NA TABELA WORKORDER_PAYMENTS
         $findWorkOrder = WorkOrder::find($request->id);
        if($findWorkOrder) {
            $findWorkOrder->title = $request->input('title');
            $findWorkOrder->customer_report = $request->input('customer_report');
            $findWorkOrder->first_observations = $request->input('first_observations');
            $findWorkOrder->last_observations = $request->input('last_observations');
            $findWorkOrder->customer = $request->input('customer');
            $findWorkOrder->machine = $request->input('machine');
            $findWorkOrder->status = 1;
            $findWorkOrder->typeofpayment = $request->input('typeofpayment');
            $findWorkOrder->price = $request->input('amount');
            $findWorkOrder->discount = $request->input('DISCOUNT');
            $findWorkOrder->worklabor = $request->input('workLabor');
            $updatemachines = $findWorkOrder->save();
        }


        if($updatemachines){
             $amount = $findWorkOrder->price;
             $machineId = $findWorkOrder->machine;
             $typeofpayment = $findWorkOrder->typeofpayment;
             $discount = $findWorkOrder->discount;
             $workOrderReference = $findWorkOrder->id;
             $worklabor = $findWorkOrder->worklabor;
             $total = (($amount - $discount) +$worklabor);
             $totalWithVAT = ($total * 0.20) + $total;

            // workorder_payments;
            $newWorkOrderPayments = DB::insert('insert into workorder_payments (amount, machineId, typeofpayment, discount, workOrderReference, worklabor, total, totalWithVAT ) values (?, ?, ?, ?, ?, ?, ?, ?)', [$amount, $machineId, $typeofpayment, $discount, $workOrderReference, $worklabor, $total, $totalWithVAT]);
        }


        // SELECT * from showmachinesbyproducts where 14 = idDaMaquina
        $Machine_Id =  $request->machine;
        $machine_info = ( DB::select('SELECT * from machines where  id =' . $Machine_Id )[0]);
        $machine_name = ($machine_info->model);

        // acha as peças na maquina where o id da work order for a mesma q a workorder atual
         $ProductsInfo = ShowProductsByMachines::whereRaw('workOrderReference = ' . $workOrderReference)->get();
          
        // infomações das work orders
         $allworkOrders = allworkorderinformations::whereRaw('machineId= ' . $Machine_Id)->first();
         

        
        $typeofpayment =  $request->typeofpayment;
        $nameCustomer =  $request->customer;
        $dataConfirmPay = $request;
        $product = $dataConfirmPay->title;
        return view('sections.payments.paymentsConfirmed', compact('dataConfirmPay', 'nameCustomer', 'typeofpayment', 'machine_name' ,'ProductsInfo', 'allworkOrders'));
    }
}
