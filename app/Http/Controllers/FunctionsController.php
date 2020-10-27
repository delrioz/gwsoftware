<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WorkOrder;
use DB;

class FunctionsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboardPageSearch(Request $request)
    {
        $name = $request -> name;

        // $result = WorkOrder::where('customer',$name );
        // return ($result);
        
        // return $SearchResult = WorkOrder::Where('customer',$name);
        // return view('sections.functions.searchDashboard', compact('SearchResult'));


        $SearchResult = WorkOrder::where('customer', 'LIKE', "%{$name}%")->get();
        return view('sections.functions.searchDashboard',compact('SearchResult','name'));
    }
}
