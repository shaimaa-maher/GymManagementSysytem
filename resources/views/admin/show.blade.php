@extends('layouts.backend')
@section('breadcrumb')
<li class="breadcrumb-item"><a href="">Profile</a></li>
<li class="breadcrumb-item"><a href="{{route('members.index')}}">All Members</a></li>
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
 

<h1>Profile</h1>

<div id="exTab1">	
     <div class=" col-md-12 mx-auto mb-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#subscribeModal{{$output['id']}}">
              <i class="fa fa-dollar-sign"></i> Add Subscription
            </button>

            <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#editModal{{$output['id']}}">
              <i class="fa fa-edit"></i>Edit
            </button>
          </div>
     </div>

     <ul  class="nav nav-tabs">
        <li class="nav-item">
            <a  href="#info" data-toggle="tab" class="nav-link active">Details</a>
                </li>
                <li class="nav-item"><a href="#attendance" data-toggle="tab" class="nav-link">Attendance</a>
     </ul>
      
    <div class="panel-body bio-graph-info tab-content clearfix" >
        <div class="row tab-pane active" id="info">
            <div class="bio-row">
                <p><span> <b>Name</b> </span>: {{$output['name']}}</p>
            </div>
            
            <div class="bio-row">
                <p><span><b>Email</b> </span>: {{$output['email']}}</p>
            </div>

            <div class="bio-row">
                <p><span><b>Phone</b></span>: {{$output['phone']}}</p>
            </div>

            <div class="bio-row">
                <p><span><b>Card Number</b></span>: {{$output['barcode_number']}}</p>
            </div>

            <div class="bio-row">
                <p><span><b>Membership Period</b></span>: {{$output['membership_period']}}</p>
            </div>

            <div class="bio-row">
                <p><span><b>Membership Cost</b></span>: {{$output['membership_cost']}}</p>
            </div>

                
            <div class="bio-row">
                <p><span><b>Sessions no.</b></span>: {{$output['sessionsNumber']}}</p>
            </div>

            <div class="bio-row">
                <p><span><b>Start Subscription</b></span>: {{$output['start_subscription']}}</p>
            </div>

            <div class="bio-row">
                <p><span><b>End Subscription</b></span>: {{$output['end_subscription']}}</p>
            </div>

            <div class="bio-row">
                <p><span><b>Status</b></span>: 
                @if($output['sessionsNumber'] === 0)
                    <span class="badge rounded-pill bg-danger">Expired Sessions</span></p> 
                @elseif($output['sessionsNumber'] > 0 && Carbon\Carbon::now()->toDateString() < $output['end_subscription'])
                    <span class="badge rounded-pill bg-success">Valid Sessions</span></p>
                @else
                    @if( Carbon\Carbon::now()->toDateString() < $output['end_subscription'])    
                        <span class="badge rounded-pill bg-success">Valid Subscription</span></p>
                    @else   
                        <span class="badge rounded-pill bg-danger">Expired Subscription</span></p>  
                    @endif
                @endif
            </div>
        </div>

        <div class="panel-body tab-pane" id="attendance">
            <table class="table table-hover table-bordered">
                <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Time</th>
                </tr>
                </thead>

                <tbody>
                @foreach($members as $member)
                    <tr>
                        <td>
                            {{$member->created_at->toDateString()}}
                        </td>
                        <td>
                            {{$member->created_at->format('g:i A')}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! $members->links() !!}
        </div>

        <!--EDIT MODAL-->
            <div class="modal fade" id="editModal{{$output['id']}}">
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
                                    <input type="text" name="id" value="{{$output['id']}}" hidden="true">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror " name="name" value="{{$output['name']}}">
                                            @error('name')
                                            <div class="alert alert-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control @error('email') is-invalid @enderror " name="email" value="{{$output['email']}}">
                                            @error('email')
                                        <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <label>Phone Number</label>
                                    
                                        <input type="phone" class="form-control @error('phone') is-invalid @enderror " name="phone" value="{{$output['phone']}}">
                                        @error('phone')
                                        <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <label>Membership Cost</label>
                                    
                                        <input type="number" class="form-control @error('membership_cost') is-invalid @enderror " name="membership_cost" value="{{$output['membership_cost']}}">
                                        @error('membership_cost')
                                        <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                        </div>
                                    </div>
 
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <label>Membership Period</label>
                                    
                                        <input type="text" class="form-control @error('membership_period') is-invalid @enderror " name="membership_period" value="{{$output['membership_period']}}">
                                        @error('membership_period')
                                        <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Payment</label>
                                            <input type="text" class="form-control @error('payment') is-invalid @enderror " name="payment" value="{{$output['payment']}}">
                                            @error('payment')
                                            <div class="alert alert-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Start Subscription</label>
                                            <input type="date" class="form-control @error('start_subscription') is-invalid @enderror " name="start_subscription" value="{{$output['start_subscription']}}">
                                            @error('start_subscription')
                                            <div class="alert alert-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>End Subscription</label>
                                            <input type="date" class="form-control @error('end_subscription') is-invalid @enderror " name="end_subscription" value="{{$output['end_subscription']}}">
                                            @error('end_subscription')
                                            <div class="alert alert-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Sessions no.</label>
                                            <input type="number" class="form-control @error('sessionsNumber') is-invalid @enderror " name="sessionsNumber" value="{{$output['sessionsNumber']}}">
                                            @error('barcode')
                                            <div class="alert alert-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Barcode</label>
                                            <input type="text" class="form-control @error('barcode') is-invalid @enderror " name="barcode" value="{{$output['barcode_number']}}">
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

        <!--Subscription MODAL-->
            <div class="modal fade" id="subscribeModal{{$output['id']}}">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Subscription</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form method="POST" action="{{route('profile.subscription')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <input type="text" name="id" value="{{$output['id']}}" hidden="true">
                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <label>Subscription Cost</label>
                                    
                                        <input type="number" class="form-control @error('subscription_cost') is-invalid @enderror " name="subscription_cost" value="" required>
                                        @error('subscription_cost')
                                        <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <label>Number of Sessions</label>
                                        <input type="number" class="form-control @error('sessionsNumber') is-invalid @enderror " name="sessionsNumber" value="">
                                        @error('sessionsNumber')
                                        <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                        <label>Start Subscription</label>
                                    
                                        <input type="date" class="form-control @error('start_subscription') is-invalid @enderror " name="start_subscription" value="" required>
                                        @error('start_subscription')
                                        <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>End Subscription</label>
                                            <input type="date" class="form-control @error('end_subscription') is-invalid @enderror " name="end_subscription" value="" required>
                                            @error('end_subscription')
                                            <div class="alert alert-danger">{{$message}}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer justify-content-between">
                                <button class="btn btn-danger" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <!--END OF EDIT MODAL-->
    </div>    
</div>

<style type="text/css">

    .panel-body{
        background-color:white;
        width:100%;
        padding:1.5rem;
        border-radius: 0  0 15px 15px;
    }

    .bio-graph-heading {
        background: #fbc02d;
        color: #fff;
        text-align: center;
        font-style: italic;
        padding: 40px 110px;
        border-radius: 4px 4px 0 0;
        -webkit-border-radius: 4px 4px 0 0;
        font-size: 16px;
        font-weight: 300;
    }

    .bio-graph-info {
        color: #89817e;
    }

    .bio-graph-info h1 {
        font-size: 30px;
        font-weight: 5x 00;
        margin: 0 0 20px;
    }

    .bio-row {
        width: 50%;
        float: left;
        margin-bottom: 10px;
        padding:0 15px;
    }
    .bio-row p span {
        width: 200px;
        display: inline-block;
    
    }
</style>

@endsection