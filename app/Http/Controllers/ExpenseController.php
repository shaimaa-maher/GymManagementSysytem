<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Category;
use Illuminate\Http\Request; 

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Cat=Category::where('parent_id',null)->get();
        $Subcategory=Category::where('parent_id','>',0)->get();

        

        $query = Expense::orderBy('id','Asc');
        $total = $query->count();
        $expenses = $query->latest()->paginate(5);

       return view('admin.expense.index',compact('total','Subcategory','Cat','expenses'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->only('amount','cat','subCat','note');
       
        $expense=Expense::create([
            'amount'=>$request->amount,
            'cat_id'=>$request->cat,
            'sub_cat_id'=>$request->subCat,
            'note'=>$request->note
        ]);
 
        return redirect()->back()->with('success', 'Expense Added Successfully');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->only(['id','amount','cat','subCat','note']);

       $expense=Expense::findOrFail($request->id);

       $expense->amount = $request->amount;
       $expense->note = $request->note? $request->note: '';
       $expense->cat_id = $request->cat;
       $expense->sub_cat_id = $request->subCat;
       $expense->save();
       return redirect()->back()->with('success', 'Expense updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $expense=Expense::findOrFail($id);
        $expense->delete();
        return redirect()->back()->with('success', 'Expense Deleted Successfully');
    }
}
