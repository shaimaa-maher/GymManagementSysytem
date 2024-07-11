@extends('layouts.backend')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="">All Members</a></li>
<li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
<li class="breadcrumb-item"><a href="{{route('trainers')}}">Trainers</a></li>
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

<div>
    <h2>
    <i class="fas fa-user-tie"></i> TRAINERS</h2>
</div>

<div class="row m-2 member"> 
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default"> <i class="fa fa-plus"> </i> Add New Member </button>

           <div class="ml-5">
                <form class="form-inline" action="{{route('trainers')}}" method="get">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
                </form>
           </div>
            
            <table class="table table-hover table-bordered mt-2">
                    <thead>
                        <tr>
                            <th>Card ID</th>
                            <th>Name</th>
                            <th>Class</th>
                            <th>Working Hours</th>
                            <th>Salary</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($trainers as $trainer)
                        <tr>
                            <td>{{ $trainer->card_id}}</td>
                            <td>{{ $trainer->name}}</td>
                            <td>{{ $trainer->class}}</td>
                            <td>{{ $trainer->working_hours}}</td>
                            <td>{{ $trainer->salary}}</td>
                            <td>{{ $trainer->email}}</td>
                            <td>{{ $trainer->phone}}</td>
                            <td>
                                <!--  -->
                                <a class="btn btn-primary btn-sm"  href="{{route('trainer.profile',$trainer->id)}}"><i class="fa fa-eye"></i> Show</a>
                                    
                                <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#editModal{{$trainer->id}}">
                                    <i class="fa fa-edit"></i>Edit
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{$trainer->id}}">
                                    <i class="fa fa-trash"></i>Delete
                                </button>
                            </td>
                        </tr>

                        <!--EDIT MODAL-->
                        <div class="modal fade" id="editModal{{$trainer->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Update</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <form method="POST" action="{{route('trainers.update')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">          
                                                <input type="text" name="id" value="{{$trainer->id}}" hidden="true">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{$trainer->name}}" name="name">
                                                        @error('name')
                                                        <div class="alert alert-danger">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <label>Email</label>
                                                    <input type="email" class="form-control @error('email') is-invalid @enderror " value="{{$trainer->email}}" name="email">
                                                    @error('email')
                                                    <div class="alert alert-danger">{{$message}}</div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-12">
                                                    <label>Phone Number</label>
                                                    <input type="phone" class="form-control @error('phone') is-invalid @enderror" value="{{$trainer->phone}}" name="phone">
                                                    @error('phone')
                                                    <div class="alert alert-danger">{{$message}}</div>
                                                    @enderror
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Salary</label>
                                                        <input type="number" class="form-control @error('salary') is-invalid @enderror " value="{{$trainer->salary}}" name="salary">
                                                        @error('salary')
                                                        <div class="alert alert-danger">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Class</label>
                                                        <input type="text" class="form-control @error('class') is-invalid @enderror " value="{{$trainer->class}}" name="class">
                                                        @error('class')
                                                        <div class="alert alert-danger">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Working Hours</label>
                                                        <input type="text" class="form-control @error('working_hours') is-invalid @enderror " value="{{$trainer->working_hours}}" name="working_hours">
                                                        @error('working_hours')
                                                        <div class="alert alert-danger">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <input type="text" class="form-control @error('address') is-invalid @enderror " value="{{$trainer->address}}" name="address">
                                                        @error('address')
                                                        <div class="alert alert-danger">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Card ID</label>
                                                        <input type="text" class="form-control @error('card_id') is-invalid @enderror " value="{{$trainer->card_id}}" name="card_id">
                                                        @error('card_id')
                                                        <div class="alert alert-danger">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--END OF EDIT MODAL-->
                        
                        <!--DELETE MODAL-->
                        <div class="modal fade" id="deleteModal{{$trainer->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Delete {{$trainer->name}}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <form method="POST" action="{{ route('trainers.delete') }}">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                            <input type="text" name="id" value="{{$trainer->id}}" hidden>
                                                <div class="col-md-12">
                                                    <p>Are you sure you want to delete {{$trainer->name}} ?</p>
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
                        <!--END OF DELETE MODAL-->

                        @endforeach
                        
                    </tbody>
            </table>
            {!! $trainers->links() !!}
    </div>
          
        <!--ADD STAFF IMAGES MODAL-->
            <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Trainer</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form method="POST" action="{{route('trainers.add')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name">
                                            @error('name')
                                            <div class="alert alert-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <label>Email</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror " name="email">
                                        @error('email')
                                        <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <label>Phone Number</label>
                                        <input type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone">
                                        @error('phone')
                                        <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Salary</label>
                                            <input type="number" class="form-control @error('salary') is-invalid @enderror " name="salary" >
                                            @error('salary')
                                            <div class="alert alert-danger">{{$message}}</div>
                                            @enderror 
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Class</label>
                                            <input type="text" class="form-control @error('class') is-invalid @enderror " name="class" >
                                            @error('class')
                                            <div class="alert alert-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Working Hours</label>
                                            <input type="text" class="form-control @error('working_hours') is-invalid @enderror " name="working_hours" >
                                            @error('working_hours')
                                            <div class="alert alert-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" class="form-control @error('address') is-invalid @enderror " name="address" >
                                            @error('address')
                                            <div class="alert alert-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Card ID</label>
                                            <input type="text" class="form-control @error('card_id') is-invalid @enderror " name="card_id" value="">
                                            @error('card_id')
                                            <div class="alert alert-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        <!--END OF ADD STAFF IMAGES MODAL-->
         
<!-- /.row -->
<style type="text/css">
  .member{
    background-color:white;
    width:100%;
    padding:1.5rem;
    border-radius:15px;
  }
</style>


@endsection