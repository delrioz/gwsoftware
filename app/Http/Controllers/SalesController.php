<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sales;
use App\invoicetable;

class SalesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function confirmPayment(Request $request)
    {
        //  return "here mate";
        // supondo que a venda que desejamos ver seja o de id 
        $id = 11;
        $thisSales = sales::find($id);

        // recuperando os dados da venda, vamos criar uma tabela invoice onde ira armazenar todos os invoices
        // uma tabela que só linkara esse invoice atual com o id da venda em questão
                $createInvoice = new invoicetable();
                $createInvoice->sales_id =  $thisSales->id;
                $storeInvoice = $createInvoice->save();
                $Invoiceid =  $createInvoice->id;

                if($storeInvoice)
                {
                    return view('sections.sales.paymentsConfirmed', compact('thisSales', 'Invoiceid'));
                 
                }
                else{
                    return "no created";
                }


    }
}
