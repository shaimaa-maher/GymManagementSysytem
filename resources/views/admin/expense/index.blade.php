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
                <input type="number" class="form-control" name="amount" placeholder="0.00" required>
            </div>

            <div class="mb-3 col-md-3">
                <label for="add expense" class="form-label">Category</label>
                <select class="form-control" aria-label="category" name='cat' required>
                    <option selected>Category</option>
                    @foreach($Cat as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3 col-md-3">
                <label for="add expense" class="form-label">Sub Category</label>
                <select class="form-control" aria-label="category" name='subCat' required>
                    <option selected>Sub Category</option>
                    @foreach($Subcategory as $sub)
                        <option value="{{$sub->id}}">{{$sub->name}}</option>
                    @endforeach
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

    <table class="table table-bordered">
        <thead>
            <tr class='bg-light'>
                <th>#</th>
                <th>Category</th>
                <th>Sub Category</th>
                <th>Amount</th>
                <th>Note</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($expenses as $expense)
            <tr>
                <td>{{$expense->id}}</td>
               
                <td>{{$expense->category->name}}</td>
                <td>{{$expense->subCategory->name}}</td>
                <td>{{$expense->amount}} L.E</td>
                <td>{{$expense->note}}</td>
                <td>{{$expense->created_at}}</td>
                <td>
                    <button type="button" class="btn btn-secondary " data-toggle="modal" data-target="#editExpense{{$expense->id}}">
                        <i class="fa fa-edit"></i> Edit
                    </button>
                    <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#deleteExpense{{$expense->id}}">
                        <i class="fa fa-trash"></i> Delete
                    </button>
                </td>
            </tr>

                    <!--EDIT MODAL-->
                    <div class="modal fade" id="editExpense{{$expense->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Update Expense</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('expense.update')}}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <input type="hidden" name="id" value="{{$expense->id}}">
                                                <div class="col-lg-6">
                                                    <label for="amount" class="form-label">Amount <i class="fa fa-money-bill"></i></label>
                                                    <input type="number" class="form-control" name="amount" value='{{$expense->amount}}'>
                                                </div>

                                                <div class="col-lg-6">
                                                    <label for="add expense" class="form-label">Category</label>
                                                    <select class="form-control" aria-label="category" name='cat'>
                                                        <option selected>Category</option>
                                                        @foreach($Cat as $category)
                                                            <option {{$category->id == $expense->category->id ? 'selected': ''}} value="{{$category->id}}">{{$category->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-lg-6">
                                                    <label for="add expense" class="form-label">Sub Category</label>
                                                    <select class="form-control" aria-label="category" name='subCat' >
                                                        <option selected>Sub Category</option>
                                                        @foreach($Subcategory as $sub)
                                                            <option {{$sub->id == $expense->subCategory->id ? 'selected': ''}} value="{{$sub->id}}">{{$sub->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-lg-6">
                                                    <label for="note" class="form-label">Note <i class="fa fa-pen"></i></label>
                                                    <input type="text" class="form-control" name="note" value='{{$expense->note}}'>
                                                </div>

                                        </div>

                                            <div class="modal-footer justify-content-between">
                                                <button class="btn btn-danger" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                     </div>
                    <!--END OF EDIT MODAL-->

                        
                    <!--DELETE MODAL-->
                    <div class="modal fade" id="deleteExpense{{$expense->id}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Delete This Expense</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('expense.delete') }}">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                            <input type="text" name="id" value="{{$expense->id}}" hidden>
                                                <div class="col-md-12">
                                                    <p>Are you sure you want to delete this expense?</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success">Delete</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--END OF DELETE MODAL-->

        @endforeach
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