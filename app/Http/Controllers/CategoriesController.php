<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product; 

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {   
        $allcategories = Category::all();
        return view('sections.categories.index', compact('allcategories'));
        
    }

    public function create()
    {
        return view('sections.categories.create');
    }

    public function store(Request $request)
    {
        Category::create($request->all());
        return redirect()->route('category.index');
    }

    public function edit($id)
    {
        $allcategories = Category::find($id);

        return view('sections.categories.edit', compact('allcategories'));
    }


    public function destroy($id)
    {
        $deleteCategories = Category::find($id)->delete();

        if($deleteCategories){
            return redirect()
                        ->route('category.index')
                        ->with('success',  'The category was successful removed !' );
            }


            else
            {
                return redirect()
                            ->back()
                            ->with('error', $response['message']);

            }

    }


    public function view($id)
    {
         $idCategory = $id;
         $findCategory = Category::find($id);
         $categoryName = $findCategory->name;
         $findProducts = Product::where('category', 'LIKE', "%{$idCategory}%")->get();

         return view('sections.categories.view', compact('idCategory', 'findProducts', 'categoryName'));

    }

    public function update(Request $request, $id)
    {

        // 'name', 'nationality', 'address', 'about', 'nameofbusiness', 'email'
        
        $category = Category::find($id);
            if(isset($category)){
            $category->name = $request->input('name');
            $category->about = $request->input('about');
            $updatecategories = $category->save();

            if($updatecategories){
            return redirect()
                        ->route('category.index')
                        ->with('success',  'The category was successful update' );
            }

            {
                return redirect()
                            ->back()
                            ->with('error', $response['message']);
             }
        }
    }


}

