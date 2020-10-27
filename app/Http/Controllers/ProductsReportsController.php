<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\StockPrice;
use App\StockCost;
use App\StockTotalQuantity;
use DB;
use App\productsgeneralbalance;
use App\lowquantity;
use App\costbenefit;
use App\worstcostbenefit;
use App\productsAllinfos;
use App\productsSales;
use App\productsBestSellerByQuantities;
use App\productsBestSellerByCategory;

class ProductsReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // return $products = productsBestSellerByQuantities::all();
        
        $allproducts = productsAllinfos::all();
        // amount in products
        $stockPrice = StockPrice::all()->first()->stocksellPrice;

        // amount spent in products
        $stockCost = StockCost::all()->first()->stockCostPrice;

        // Quantities products
        $StockTotalQuantity = StockTotalQuantity::all()->first()->TOTAL;

        $productsgeneralbalance = productsgeneralbalance::all()->first()->total;

        $allproductsLowQuantity = lowquantity::paginate(10);

        $allcostbenefit = costbenefit::paginate(3);

        $allworstcostbenefit = worstcostbenefit::paginate(3);

        return view('sections.reports.products.index', compact('allproducts', 'stockPrice', 'stockCost', 'StockTotalQuantity', 'productsgeneralbalance', 'allproductsLowQuantity', 'allcostbenefit', 'allworstcostbenefit'));
    }


    public function all(Request $request)
    {

        //  $products = productsSales::all();
        $products = productsBestSellerByQuantities::orderBy('totalNproducts', 'DESC')->get();
        
        $a = 1;


        // $products = \DB::table('products')
        // ->select('products.*')
        // ->orderBy('id','DESC')
        // ->get();
        // $results = DB::select('select * from products_sales where id = ?', [1]);

        /*query de exemplo 
        CREATE VIEW productsBestSellerByQuantities AS 
        SELECT  ProductId , COUNT(*) as totalNproducts, name, SKU, category, sales_price, Cost_Price, sales_discount, sales_vat, SUM(sales_price  + 0) as AmountSalesSell
        from products_sales
        GROUP BY ProductId ;
        */

        // $products = DB::select('select COUNT(*) as totalNproducts, name, SKU, category from  sales');


        // JSON format for Js can read this data
        // 200 means good reponses
        return response(json_encode($products, $a), 200) ;
} 

    public function allbycategories(Request $request)
    {
        
        return "¬oi";

        //  $products = productsSales::all();
        $productsByCategory = productsBestSellerByCategory::orderBy('totalNproducts', 'DESC')->get();

        
        $a = 1;



        // $products = \DB::table('products')
        // ->select('products.*')
        // ->orderBy('id','DESC')
        // ->get();
        // $results = DB::select('select * from products_sales where id = ?', [1]);

        /*query de exemplo 
        CREATE VIEW productsBestSellerByQuantities AS 
        SELECT  ProductId , COUNT(*) as totalNproducts, name, SKU, category, sales_price, Cost_Price, sales_discount, sales_vat, SUM(sales_price  + 0) as AmountSalesSell
        from products_sales
        GROUP BY ProductId ;
        */

        // $products = DB::select('select COUNT(*) as totalNproducts, name, SKU, category from  sales');


        // JSON format for Js can read this data
        // 200 means good reponses
        return response(json_encode($productsByCategory), 200) ;
    } 

}
