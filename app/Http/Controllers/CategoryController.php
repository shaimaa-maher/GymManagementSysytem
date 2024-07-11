<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use Illuminate\Http\Request; 

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query=Category::orderBy('id','asc')->where('parent_id',null);
        $allCat=Category::all();
        $Subcategory=Category::where('parent_id','>',0)->with('category');

        $total=$query->count();
        $categories=$query->latest()->paginate(5,['*'],'categories');

        $totalSub=$Subcategory->count();
        $Subcat=$Subcategory->latest()->paginate(5,['*'],'Subcat');

        return view('admin.expense.categories.index',compact('total','totalSub','categories','allCat','Subcat'))->with('i', (request()->input('page', 1) - 1) * 5);
       
    }

    /**
     * Show the form for creating a new resource.
     * Store a newly created resource in storage.
     */
    public function create(Request $request)
    {
        $request->only(['name']);

        $request->validate([
            'name' => 'required', 
        ]);

        // return $request;
        

        Category::create([
            'name'=>$request->name,
            'parent_id'=>null,
        ]);

        return redirect('categories')->with('success', 'Category Added Successfully');
        
    }

     /**
     * Show the form for creating a new resource.
     */
    public function assignCategory(Request $request)
    {
        $request->only(['cat','subCat']);

        $request->validate([
            'cat' => 'required', 
            'subCat'=>'required'
        ]);

        // return $request;
        
        $subCat=Category::findOrFail($request->subCat);
        $subCat->parent_id=$request->cat;
        $subCat->save();

        return redirect('categories')->with('success', 'Assignment Added Successfully');
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->only(['id','name','cat']);

        $category = Category::findOrFail($request->id);
        $category->name=$request->name;

        //check if it has a parent id
        if($request->cat){
        $category->parent_id=$request->cat;
        }
        $category->save();
        return redirect()->back()->with('success', 'Category updated Successfully'); 
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id=$request->id;

        $expense=Expense::where('cat_id',$id)->orWhere('sub_cat_id',$id);
        if ($expense) {
            $expense->delete();
        }
        

        $subCat=Category::Where('parent_id',$id);
        $subCat->delete();

        $cat=Category::findOrFail($id);
        $cat->delete(); 
        return redirect()->back()->with('success', 'Category Deleted Successfully');

    }
}
