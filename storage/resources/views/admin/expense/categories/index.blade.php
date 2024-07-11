@extends('layouts.backend')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="">Categories</a></li>
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

   <h2>
        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="green" class="bi bi-tag" viewBox="0 0 16 16">
        <path d="M6 4.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm-1 0a.5.5 0 1 0-1 0 .5.5 0 0 0 1 0z"/>
        <path d="M2 1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 1 6.586V2a1 1 0 0 1 1-1zm0 5.586 7 7L13.586 9l-7-7H2v4.586z"/>
        </svg>Categories
    </h2>

<div class="row ">
    <div class="expense mt-5 col-4">
        <h3>Add Category:</h3>
        
        <form action="{{route('categories.add')}}" method="post" class="mt-4" enctype="multipart/form-data">
         @csrf
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="category" class="form-label">Category</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter Category Name" required>
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-success" ><i class="fa fa-plus"></i> Add</button>
                </div>
            </div>
        </form>
    </div>


    <div class="expense mt-5 col-6 ml-5">
        <h3>Assign Sub Category To The Category:</h3>
        
        <form action="{{route('categories.assign')}}" method="post" class="mt-4" enctype="multipart/form-data">
           @csrf
            <div class="row">
               <div class="mb-3 col-md-6">
                    <label for="add expense" class="form-label">Sub Category</label>
                    <select class="form-control" aria-label="category" name='subCat' required>
                        <option selected>Sub Category</option>
                        @foreach($allCat as $category)
                          <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3 col-md-6">
                    <label for="add expense" class="form-label">Category</label>
                    <select class="form-control" aria-label="category" name='cat' required>
                        <option selected>Category</option>
                        @foreach($allCat as $category)
                          <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5zm14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5z"/>
                        </svg>  Assign
                    </button>
                </div>
            </div>
        </form>
   </div>

</div>

<div class="row expense justify-content-between mt-4">
        <div class="mt-3 mx-auto col-6">
            <h3 class="mb-4">All Categories:</h3> 
            <table class="table table-bordered w-75 text-center">
                <thead>
                    <tr class='bg-light'>
                        <th>#</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td>
                            <button type="button" class="btn btn-secondary " data-toggle="modal" data-target="">
                                <i class="fa fa-edit"></i> Edit
                            </button>
                            <button type="button" class="btn btn-danger " data-toggle="modal" data-target="">
                                <i class="fa fa-trash"></i> Delete
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
               
            </table>
             {!! $categories->links() !!}
        </div>


        <!-- display sub categories -->
        <div class="mt-3 mx-auto col-6">
            <h3 class="mb-4">All Sub Categories:</h3> 
            <table class="table table-bordered w-75 text-center">
                <thead>
                    <tr class='bg-light'>
                        <th>#</th>
                        <th>Sub Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($Subcat as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td>
                            <button type="button" class="btn btn-secondary " data-toggle="modal" data-target="">
                                <i class="fa fa-edit"></i> Edit
                            </button>
                            <button type="button" class="btn btn-danger " data-toggle="modal" data-target="">
                                <i class="fa fa-trash"></i> Delete
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
             {!! $Subcat->links() !!}
        </div>

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