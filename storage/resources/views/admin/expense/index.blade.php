@extends('layouts.backend')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="">Expense</a></li>
<li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
@endsection
@section('content')

@if(session('success'))
  <div class="alert alert-success" id="successMessage">
    {{session('success')}}
  </div>
@endif

@if(session('failed'))
<div class="alert alert-danger" id="failedMessage">
  {{session('failed')}}
</div>
@endif

<script>

 setTimeout(
    function(){
      $("#successMessage").delay(3000).fadeOut('fast');
    },1000
  );
  
 setTimeout(
    function(){
      $("#failedMessage").delay(3000).fadeOut('fast');
    },1000

  );
</script>

<h2><i class="fas fa-money-bill-wave"></i><span> Expenses</span></h2>

<div class="expense ">
    <h3>Add Expense:</h3>
    
    <form action="{{route('expense.add')}}" method="post" class="mt-3" enctype="multipart/form-data">
      @csrf
        <div class="row">
            <div class="mb-3 col-md-3">
                <label for="amount" class="form-label">Amount <i class="fa fa-money-bill"></i></label>
                <input type="number" class="form-control" name="amount" placeholder="0.00">
            </div>

            <div class="mb-3 col-md-3">
                <label for="add expense" class="form-label">Category</label>
                <select class="form-control" aria-label="category" name='cat'>
                    <option selected>Category</option>
                    <option value="1">Basic</option>
                    <option value="2">Personal</option>
                    <option value="3">Subsidiary</option>
                </select>
            </div>

            <div class="mb-3 col-md-3">
                <label for="add expense" class="form-label">Sub Category</label>
                <select class="form-control" aria-label="category" name='subCat'>
                    <option selected>Sub Category</option>
                    <option value="1">Internet</option>
                    <option value="2">Electricity</option>
                    <option value="3">Water</option>
                </select>
            </div>

            <div class="mb-3 col-md-3">
                <label for="note" class="form-label">Note <i class="fa fa-pen"></i></label>
                <input type="text" class="form-control" name="note" placeholder="note">
            </div>

            <div class="mb-3 col-md-4">
                <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Add</button>
            </div>
        </div>
    </form>
</div>

<div class="expense mt-3">
    <h3>All Expense:</h3>

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <form action="{{route('categories')}}" method="get">
            <button type="submit" class="btn btn-primary btn-lg mb-2">All Categories</button>
        </form>
    </div>
    
    
    <table class="table table-bordered">
        <thead>
            <tr class='bg-light'>
                <th>#</th>
                <th>Category</th>
                <th>Sub Category</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Basic</td>
                <td>Internet</td>
                <td>250 L.E</td>
                <td>12/10/2023</td>
                <td>
                    <button type="button" class="btn btn-secondary " data-toggle="modal" data-target="">
                        <i class="fa fa-edit"></i> Edit
                    </button>
                    <button type="button" class="btn btn-danger " data-toggle="modal" data-target="">
                        <i class="fa fa-trash"></i> Delete
                    </button>
                </td>
            </tr>



            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th class='bg-success '> Total = 250 E.L</th>
            </tr>
        </tbody>
        
    </table>
</div>


<style type="text/css">
 .expense{
      background-color:white;
      width:100%;
      padding:1.5rem;
      border-radius:15px;
    }

</style>




@endsection