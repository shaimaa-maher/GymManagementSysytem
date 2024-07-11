@extends('layouts.backend')

@section('breadcrumb')
<li class="breadcrumb-item"><a href="">All Members</a></li>
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

<!-- Shaimaa -->
    <div>
        <h2>
        <i class="fas fa-user-tie"></i> MEMBERS</h2>
    </div>
    
    <div class="row m-2 member"> 
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default"> <i class="fa fa-plus"> </i> Add New Member </button>

           <div class="ml-5">
                <form class="form-inline" action="{{route('members.index')}}" method="get">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
                    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
                </form>
           </div>
            
            <table class="table table-hover table-bordered mt-2">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Barcode</th>
                            <th>Status</th>
                            <th>Sessions no.</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Payment</th>
                            <th>Membership cost</th>
                            <th>Membership period</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($members as $member)
                        <tr>
                            <td>{{$member->name}}</td>
                            <td>{{$member->barcode_number}}</td>
                            <td> 
                                    @if($member->sessionsNumber === 0)
                                        <span class="badge rounded-pill bg-danger">Expired Sessions</span></p> 
                                    @elseif($member->sessionsNumber > 0 && Carbon\Carbon::now()->toDateString() < $member->end_subscription)
                                        <span class="badge rounded-pill bg-success">Valid Sessions</span></p>
                                    @else
                                        @if( Carbon\Carbon::now()->toDateString() < $member->end_subscription)    
                                            <span class="badge rounded-pill bg-success">Valid Subscription</span></p>
                                        @else   
                                            <span class="badge rounded-pill bg-danger">Expired Subscription</span></p>  
                                        @endif
                                    @endif
                            </td>
                            <td>{{$member->sessionsNumber}}</td>
                            <td>{{$member->email}}</td>
                            <td>{{$member->phone}}</td>
                            <td>{{$member->payment}}</td>
                            <td>{{$member->membership_cost}}</td>
                            <td>{{$member->membership_period}}</td>
                            <td>
                                <!--  -->
                                <a class="btn btn-primary btn-sm"  href="{{route('profile',$member->id)}}"><i class="fa fa-eye"></i> Show</a>
                                    
                                <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#editModal{{$member->id}}">
                                    <i class="fa fa-edit"></i>Edit
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{$member->id}}">
                                    <i class="fa fa-trash"></i>Delete
                                </button>
                            </td>
                        </tr>

                        

                        <!--EDIT MODAL-->
                        <div class="modal fade" id="editModal{{$member->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Update</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <form method="POST" action="{{ route('admin.editMember') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <input type="text" name="id" value="{{$member->id}}" hidden="true">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input type="text" class="form-control @error('name') is-invalid @enderror " name="name" value="{{$member->name}}">
                                                        @error('name')
                                                        <div class="alert alert-danger">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <input type="text" class="form-control @error('email') is-invalid @enderror " name="email" value="{{$member->email}}">
                                                        @error('email')
                                                    <div class="alert alert-danger">{{$message}}</div>
                                                    @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                    <label>Phone Number</label>
                                                
                                                    <input type="phone" class="form-control @error('phone') is-invalid @enderror " name="phone" value="{{$member->phone}}">
                                                    @error('phone')
                                                    <div class="alert alert-danger">{{$message}}</div>
                                                    @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Membership Cost</label>
                                                    
                                                        <input type="number" class="form-control @error('membership_cost') is-invalid @enderror " name="membership_cost" value="{{$member->membership_cost}}">
                                                        @error('membership_cost')
                                                        <div class="alert alert-danger">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Membership Period</label>                                               
                                                        <input type="text" class="form-control @error('membership_period') is-invalid @enderror " name="membership_period" value="{{$member->membership_period}}">
                                                        @error('membership_period')
                                                        <div class="alert alert-danger">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Payment</label>
                                                        <input type="text" class="form-control @error('payment') is-invalid @enderror " name="payment" value="{{$member->payment}}">
                                                        @error('payment')
                                                        <div class="alert alert-danger">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Start Subscription</label>
                                                        <input type="date" class="form-control @error('start_subscription') is-invalid @enderror " name="start_subscription" value="{{$member->start_subscription}}">
                                                        @error('start_subscription')
                                                        <div class="alert alert-danger">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>End Subscription</label>
                                                        <input type="date" class="form-control @error('end_subscription') is-invalid @enderror " name="end_subscription" value="{{$member->end_subscription}}">
                                                        @error('end_subscription')
                                                        <div class="alert alert-danger">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Sessions no.</label>
                                                        <input type="number" class="form-control @error('sessionsNumber') is-invalid @enderror " name="sessionsNumber" value="{{$member->sessionsNumber}}">
                                                        @error('sessionsNumber')
                                                        <div class="alert alert-danger">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Barcode</label>
                                                        <input type="text" class="form-control @error('barcode') is-invalid @enderror " name="barcode" value="{{$member->barcode_number}}">
                                                        @error('barcode')
                                                        <div class="alert alert-danger">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="modal-footer justify-content-between">
                                            <button class="btn btn-danger" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--END OF EDIT MODAL-->

                        
                        <!--DELETE MODAL-->
                        <div class="modal fade" id="deleteModal{{$member->id}}">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Delete: {{$member->name}}</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <form method="POST" action="{{ route('admin.deleteMembers') }}">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                            <input type="text" name="id" value="{{$member->id}}" hidden>
                                                <div class="col-md-12">
                                                    <p>Are you sure you want to delete this record ?</p>
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
            {!! $members->links() !!}
    </div>
          
        <!--ADD STAFF IMAGES MODAL-->
            <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Member</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form method="POST" action="{{route('admin.addMemeber')}}" enctype="multipart/form-data">
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
                                        <input type="email" class="form-control @error('email') is-invalid @enderror " name="email" value="">
                                        @error('email')
                                        <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <label>Phone Number</label>
                                        <input type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="">
                                        @error('phone')
                                        <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <label>Membership Cost</label>
                                    
                                        <input type="number" class="form-control @error('membership_cost') is-invalid @enderror " name="membership_cost" value="">
                                        @error('membership_cost')
                                        <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <label>Membership Period</label>
                                    
                                        <input type="text" class="form-control @error('membership_period') is-invalid @enderror " name="membership_period" value="">
                                        @error('membership_period')
                                        <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Payment</label>
                                            <input type="text" class="form-control @error('payment') is-invalid @enderror " name="payment" value="">
                                            @error('payment')
                                            <div class="alert alert-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Start Subscription</label>
                                                <input type="date" class="form-control @error('start_subscription') is-invalid @enderror " name="start_subscription" value="">
                                                @error('start_subscription')
                                                <div class="alert alert-danger">{{$message}}</div>
                                                @enderror
                                            </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>End Subscription</label>
                                            <input type="date" class="form-control @error('end_subscription') is-invalid @enderror " name="end_subscription" value="">
                                            @error('end_subscription')
                                            <div class="alert alert-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Sessions no.</label>
                                            <input type="number" class="form-control @error('sessionsNumber') is-invalid @enderror " name="sessionsNumber">
                                            @error('sessionsNumber')
                                            <div class="alert alert-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>barcode</label>
                                            <input type="text" class="form-control @error('barcode') is-invalid @enderror " name="barcode" value="">
                                            @error('payment')
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


