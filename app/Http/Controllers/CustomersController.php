<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Machine;
use App\machinesallinfos;
use App\WorkOrder;
use App\Quote;
use Image;

class CustomersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {

        $allcustomers = Customer::all();

        return view('sections.customers.index', compact('allcustomers'));
        
    }

    public function create()
    {
        return view('sections.customers.create');
    }

    public function store(Request $request)
    { 


        // /com ajax 
         
    //     $addCustomer = Customer::create($request->all());

    //     if($addCustomer){
    //         return "adicionou!!";
            
    //     }
    //     else{
    //         return "tan tan tan";
    //     }

    //     return redirect()->route('customer.index');
    // }


        Customer::create($request->all());
        return redirect()->route('customer.create');
    }


    public function createMachineAjax(Request $request){
            Machine::create($request->all());
            return "criooou";
    }

    public function storeandnewmachine(Request $request)
    { 
        $Receivedimage = $request->image;

        if($Receivedimage){
            $path =  $request->file('image')->store('images','public');
            $input['image'] = $path;
            $img = Image::make('storage/'. $path);
            $img->resize(2, 2);
        }

        else{
            $path = "default.png";
        }

        $createCustomer = new Customer();
        $createCustomer->image = $path;
        $createCustomer->name = $request->name;
        $createCustomer->telephone =  $request->telephone;
        $createCustomer->email =  $request->email;
        $createCustomer->address =  $request->address;
        $storeCustomers = $createCustomer->save();
        $thisCustomerId= $createCustomer->id;

        if($storeCustomers){
             return redirect()->route('customer.createmachine', ['id' => $thisCustomerId]);
        }

        return redirect()->route('customer.create');
    }

    public function createmachine (Request $request){
        $allcustomers = Customer::all();
        $idThisCustomer =  $request["id"];
        $thisCustomer = Customer::find($idThisCustomer);
        $allmachines = Machine::all();

        return view('sections.customers.subpathmachine.createmachine', compact('thisCustomer','allcustomers', 'allmachines'));
    }       

    public function createmachineonviewpage ($id){
        // create machine on viewpage
        $allcustomers = Customer::all();
        $idThisCustomer =  $id;
        $thisCustomer = Customer::find($idThisCustomer);
        $allmachines = Machine::all();

        return view('sections.customers.subpathmachine.createmachine', compact('thisCustomer','allcustomers', 'allmachines'));
    }       


    public function createmachinestore(Request $request){
        Machine::create($request->all());
        return redirect()->route('machine.index');
    }

    public function createAjaxandAddmachine (Request $request)
    {
        Customer::create($request->all());
        return redirect()->route('customer.create');
    }

    public function edit($id)
    {
        $allcustomers = Customer::find($id);
        return view('sections.customers.edit', compact('allcustomers'));
    }

    public function viewPage($id){
        $thisCustomer = Customer::find($id);
        $allmachines = Machine::where('owner', 'LIKE', "%{$id}%")->get();
        $allmachineswithowner = machinesallinfos::where('owner', 'LIKE', "%{$id}%")->get();
        return view('sections.customers.viewPage.index', compact('thisCustomer','allmachines','allmachineswithowner',));
    }
    public function update(Request $request, $id)
    {

            // 'name', 'nationality', 'address', 'about', 'nameofbusiness', 'email'
            $customer = Customer::find($id);

            if ($path = $request->file('image')== null)
            $path = $customer->image;

            else
            $path = $request->file('image')->store('images','public') ;

            if(isset($customer)){
            $customer->image = $path;
            $customer->name = $request->input('name');
            $customer->telephone = $request->input('telephone');
            $customer->email = $request->input('email');
            $customer->address = $request->input('address');
            $updatecustomers = $customer->save();

            if($updatecustomers){
            return redirect()
                        ->route('customer.index')
                        ->with('success',  'The customer was successful update' );
            }


            else
            {
                return redirect()
                            ->back()
                            ->with('error', $response['message']);
             }
        }
    }

    public function destroy($id)
    {
        // deletando tudo que tenha de referencia aos clientes
        //cliente
        $deletecustomer = Customer::find($id)->delete();
        $findWorkOrder = WorkOrder::where('customer', 'LIKE', "%{$id}%")->get();
        $findQuote = Quote::where('customer', 'LIKE', "%{$id}%")->get();
        $findMachine = Machine::where('owner', 'LIKE', "%{$id}%")->get();
        // $attCustomers = Customer::all();
        // return response()->json($statusSearch);

        if($deletecustomer){
            
            if($findWorkOrder){
                //workorder
                {$delteworkOrder = WorkOrder::where('customer', 'LIKE', "%{$id}%")->delete();}
            }

            if($findMachine){
                //workorder
                {$delteworkOrder = Machine::where('owner', 'LIKE', "%{$id}%")->delete();}
            }
            
            if($findQuote){
                //quotes
                {$delteQuote = Quote::where('customer', 'LIKE', "%{$id}%")->delete();}
            }

            return redirect()
                        ->route('customer.index')
                        ->with('success',  'The Customer was successful removed !' );
            }


            else
            {
                return redirect()
                            ->back()
                            ->with('error', $response['message']);

            }

    }

}
