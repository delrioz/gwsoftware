<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Machine;
use App\Customer;
use App\ShowProductsByMachines;
use App\machinesallinfos;
use App\Product;
use App\allquotesinformations;
use App\allworkorderinformations;

class MachinesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $allmachines = Machine::all();
        $allmachineswithowner = machinesallinfos::all();
        return view('sections.machines.index', compact('allmachines', 'allmachineswithowner'));
    }

    public function create()
    {
        $allcustomers = Customer::all();
        return view('sections.machines.create', compact('allcustomers'));

    }

    public function store(Request $request)
    {
        Machine::create($request->all());
        // to where will redirect when the machine is created
        // return redirect()->route('machine.index');
        return redirect()->route('customer.index');
    }

    public function edit($id)
    {
        
        $allmachines = machinesallinfos::find($id);
        $allcustomers = Customer::all();

        $nameOwnerMachine = $allmachines->customerName;
        $IdOwnerMachine = $allmachines->customerId;
        
        
        return view('sections.machines.edit', compact('allmachines', 'allcustomers', 'nameOwnerMachine', 'IdOwnerMachine'));
    }


    public function view($id)
    {
      
      $allmachines = machinesallinfos::find($id);

      $ownerId = $allmachines->owner;
      
      $nameOwner = $allmachines->customerName;


      $ProductsByMachines = ShowProductsByMachines::where('machineIdinMachine', 'LIKE', "%{$id}%")->get();

      $MoreInfos = ShowProductsByMachines::where('machineIdinMachine', 'LIKE', "%{$id}%")->first();

      return view('sections.machines.view', compact('allmachines','ProductsByMachines', 'nameOwner'));
    }

    public function viewPage($id){
        // infos to show in the header 
        $thisCustomer = Customer::find($id);
        // $allmachines = Machine::where('owner', 'LIKE', "%{$id}%")->get();
        $allmachines = Machine::find($id);
        $allmachineswithowner = machinesallinfos::where('id', 'LIKE', "%{$id}%")->get();


        // products in this machine 
        $ProductsByMachines = ShowProductsByMachines::where('machineIdinMachine', 'LIKE', "%{$id}%")->get();

        // quotes
         $allQuotes = allquotesinformations::where('machine' , 'LIKE',  "%{$id}%")
        ->get();

        // work orders 
        $allworkOrders = allworkorderinformations::where('machineId' , 'LIKE',  "%{$id}%")->get();
        

        $allproducts = Product::all();
        return view('sections.machines.viewPage.index', compact('allworkOrders', 'allQuotes', 'ProductsByMachines', 'thisCustomer', 'allmachines', 'allmachineswithowner','allproducts'));
    }

    public function destroy($id)
    {
        $deletemachine = Machine::find($id)->delete();

        if($deletemachine){
            return redirect()
                        ->route('machine.index')
                        ->with('success',  'The Machine was successful removed !' );
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

        // 'plate', 'brand',  'model', 'colour', 'year', 'owner'
        $machine = Machine::find($id);
            if(isset($machine)){
            $machine->serial_number = $request->input('serial_number');
            $machine->brand = $request->input('brand');
            $machine->model = $request->input('model');
            $machine->owner = $request->input('owner');
            $machine->customer_report = $request->input('customer_report');
            $machine->first_observations = $request->input('first_observations');
            $updatemachines = $machine->save();

            if($updatemachines){

            return redirect()
                        ->route('machine.index')
                        ->with('success',  'The Machine was successful update' );
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
